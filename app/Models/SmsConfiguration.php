<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use GuzzleHttp\Client;
class SmsConfiguration extends Model
{
    use HasFactory;

    protected static function buildHttpClient()
    {
        return new Client([
            'base_uri' => "https://smsvas.vlserv.com/KannelSending/service.asmx/SendSMS",
        ]);
    
    }
    /**
     * @param string $message
     * @param string $to
     * @param string|null $from
     * @return \Psr\Http\Message\ResponseInterface
     */




 
    public static function send(string $message ,string  $to , string $username ,string $password , string $sms_provider)
    {
        $httpClient = new \GuzzleHttp\Client(); // guzzle 6.3

            //  dd( $httpClient);

        $response = $httpClient->request('GET',  "https://smsvas.vlserv.com/KannelSending/service.asmx/SendSMS" , [
            'headers' => [
                'Content-Type' => 'application/x-www-form-urlencoded',
            ],
            'query' => [
                'UserName' => $username,
                'Password' => $password,
                'SMSSender' => $sms_provider,
                'SMSLang' => "E",
                'SMSText' => $message,
                'SMSReceiver' => $to,
            ]
        ]);
            
        $xmlResponse = new \SimpleXMLElement($response->getBody()->getContents());
        
        $arrayResponse = (array)$xmlResponse ; 
        $statusNumber = $arrayResponse[0] ; 
        
        $messages = [
            '0' => 'Message Sent Succesfully',
            '-1' => 'User is not subscribed',
            '-2' => 'invalid number' , 
            '-5' => 'Out of credit.',
            '-10' => 'Queued Message, no need to send it again.',
            '-11' => 'Invalid language.',
            '-12' => 'SMS is empty.',
            '-13' => 'Invalid fake sender exceeded 12 chars or empty.',
            '-25' => 'Sending rate greater than receiving rate (only for send/receive accounts).',
            '-100' => 'Other error',
        ];

        
        return($messages[$statusNumber]) ; 

   
    }
    
    public static function checkCredit($username , $password){
        $httpClient = new \GuzzleHttp\Client(); // guzzle 6.3
        $response = $httpClient->request('GET',  "https://smsvas.vlserv.com/KannelSending/service.asmx/CheckCredit" , [
            'headers' => [
                // 'Content-Type' => 'application/x-www-form-urlencoded',
            ],
            'query' => [
                'UserName' => $username,
                'Password' => $password,
            ]
        ]);
        $xmlResponse = new \SimpleXMLElement($response->getBody()->getContents());
        $arrayResponse = (array)$xmlResponse ; 
        return $arrayResponse[0]  ; 
    }
}
