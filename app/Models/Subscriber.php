<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subscriber extends Model
{
    private function sendSMS($messageContent)
{
    $sid = env('TWILIO_SID');
    $token = env('TWILIO_AUTH_TOKEN');
    $twilioNumber = env('TWILIO_PHONE_NUMBER');
    
    $twilio = new Client($sid, $token);
    
    // Get ALL subscribers from database
    $subscribers = \App\Models\Subscriber::all();
    
    // Send SMS to each subscriber
    foreach ($subscribers as $subscriber) {
        try {
            $twilio->messages->create(
                $subscriber->phone_number,
                [
                    'from' => $twilioNumber,
                    'body' => "New Tube Feed update: " . $messageContent
                ]
            );
        } catch (Exception $e) {
            \Log::error('SMS failed for ' . $subscriber->phone_number . ': ' . $e->getMessage());
        }
    }
}
}
