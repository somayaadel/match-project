<?php
namespace App\Helpers;

use App\Models\User;
use FCM;
use LaravelFCM\Message\OptionsBuilder;
use LaravelFCM\Message\PayloadDataBuilder;
use LaravelFCM\Message\PayloadNotificationBuilder;

class Notification
{
    public function sendFcmMessage($data, $user_token = null)
    {
        $optionBuilder = new OptionsBuilder();
        $optionBuilder->setTimeToLive(60 * 20);

        $notificationBuilder = new PayloadNotificationBuilder($data->en_title);
        $notificationBuilder->setBody($data->en_body)
            ->setSound('default');
        $dataBuilder = new PayloadDataBuilder();
        $dataBuilder->addData(['a_data' => $data]);

        $option = $optionBuilder->build();
        $notification = $notificationBuilder->build();
        $data = $dataBuilder->build();
        if ($user_token == null) {
            $token = auth()->user()->fcm_token;
            if (!$token) {
                return 'webUser';
            }

        } else {
            $token = $user_token;
        }

        $downstreamResponse = FCM::sendTo($token, $option, $notification, $data);

        return $downstreamResponse->numberSuccess();
    }

    public function saveUserNotification($notification_id, $user_id = null, $data = null)
    {
        if ($user_id == null) {
            $user = User::where('id', auth()->user()->id)->first();
        } else {
            $user = User::where('id', $user_id)->first();
        }
        if ($user != null) {
            $user->notifications()->attach([$notification_id => ['data' => $data]]);
        }
    }
}
