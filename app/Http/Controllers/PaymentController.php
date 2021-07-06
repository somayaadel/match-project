<?php

namespace App\Http\Controllers;
use App\Helpers\PayMob;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Package;
use App\Models\Order;



class PaymentController extends Controller
{
    public function fawryPayment(Request $request)
    {
       
        // $user = User::find($request->user()->id);
        $userInfo = User::where('id', $request->user()->id)->first();
        
        $number = str_random(8);
        $package = Package::where('id',$request->package_id)->first();
        $amount = $package->price. '.00';
        $merchantRefNum = "2312465464";
        $fawryUrl = 'https://atfawry.fawrystaging.com/ECommerceWeb/Fawry/payments/charge';
        $items = [];
         $item = new item();
         $item->itemId = $package['id'];
         $item->price = $package['price'];
         $item->quantity = '1';
         array_push($items, $item);
        // Generate Fawry Signature
        // return $items;
        $merchantCode = '1tSa6uxz2nR/XkPxVfOViA==';
        $customerProfileId = $userInfo->id;
        $paymentMethod = 'PAYATFAWRY';
        $secureKey = 'c778f05ed99f4885bb714c727d9de07c';
        $buffer = $merchantCode . $merchantRefNum . $customerProfileId . $paymentMethod . $amount . $secureKey;
        $signature = hash('sha256', $buffer);
        $fawryData = [
            "merchantCode" => $merchantCode,
            "customerMobile" => '01550431149',
            "customerProfileId" => $customerProfileId,
            "customerEmail" => $userInfo->email,
            "language" => "en-gb",
            "merchantRefNum" => $merchantRefNum,
            "amount" => $amount,
            "currencyCode" => "EGP",
            "chargeItems" => $items,
            "signature" => $signature,
            "paymentMethod" => "PAYATFAWRY",
            "description" => "Example Description",
        ];
        // return $fawryData;
        $data_string = json_encode($fawryData);
        $ch = curl_init($fawryUrl);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_FRESH_CONNECT, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen($data_string),
        ));

        $result = curl_exec($ch);
          return $result ;
        $result = json_decode($result, true);
        $order = new Order();
        $order->user_id = $userInfo->id;
        $order->package_id = $request->package_id;
        $order->ref_no = $number;
        $order->amount = $package->price;
        $order->payment_type = 'fawry';
        $order->data = $result->referenceNumber;
        $order->expiration_time =date("d/m/Y H:i:s", $result->expirationTime/1000);

        if($package->price == 0){
        $order->status = 1;
        }else{
            $order->status = 0;
        }
        $order->save();
        return response()->json(['data' => $result]);
    }


    public function aa(Request $request)
    {
        $payMob = new PayMob();
        $userInfo = User::where('id', $request->user()->id)->first();
        $package = Package::where('id',$request->package_id)->first();
        $amount = $package->price. '.00';
        $items = [];
         $item = new item();
         $item->itemId = $package['id'];
         $item->price = $package['price'];
         $item->quantity = '1';
         array_push($items, $item);
        if (strpos($amount, '.') !== false) {
            $amount = round($amount, 2);
        } else {
            $amount = $amount . '.00';
        }
        $refNumber = str_random(8);
        // Step 1
        $payMob->authPaymob();
        // return  $payMob->authPaymob();

        // Step 2
        $paymobOrder = $payMob->makeOrderPaymob(
            $payMob->auth->profile->id, // merchant id.
            $amount * 100, // total amount by cents/piasters.
            $refNumber, // your (merchant) order id.
            $items,
            $request->user()->email, // optional
            $request->user()->name, // optional
            $request->user()->phone ? $request->user()->phone : 'no-phone-found', // optional
        );
        dd(  $paymobOrder);

        // if (!$request->mobileNumber) {
            // Step 3
            $paymentKey = $payMob->getPaymentKeyPaymob(
                $amount * 100, // total amount by cents/piasters.
                $paymobOrder->shipping_data->order_id, // paymob order id from step 2.
                // For billing data
                $request->user()->email, // optional
                $request->user()->name, // optional
                $request->user()->phone ?   $request->user()->phone : 'no-phone-found', // optional
              
            );
        //      if( $request->package )
        // {
        //     $packOrder = $request->package ;
        //     $order->items()->create([
        //         'item_id' => $packOrder['id'],
        //         'item_type' => Package::class,
        //         'price' => $packOrder['value']
        //     ]);
            
        // }
            return response()->json(['paymentKey' => $paymentKey->token, 'url' => 'https://accept.paymob.com/api/acceptance/iframes/128195' . '?payment_token=' . $paymentKey->token], 200);
        // } else {
        //     $vodafonePayment = $payMob->vodafoneCashPayment(
        //         $request->mobileNumber,
        //        $request->user()->name, // optional
        //        $request->user()->email, // optional
        //        $request->user()->phone ? auth()->user()->phone : 'no-phone-found' // optional
        //     );
        //     return response()->json(['payment' => $vodafonePayment]);
        // }
    }
}

class item
{
    public $itemId;
    public $price;
    public $quantity;
}
