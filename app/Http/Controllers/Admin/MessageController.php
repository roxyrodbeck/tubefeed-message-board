<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Message;
use Illuminate\Http\Request;
use Twilio\Rest\Client;

class MessageController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }
    public function index()
    {
        $messages = Message::orderBy('created_at', 'desc')->get();
        return view('admin.messages.index', compact('messages'));
    }

    public function create()
    {
        return view('admin.messages.create');
    }
    
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'message' => 'required|string',
            'type' => 'required|in:feature,tip,update,maintenance',
            'published_at' => 'nullable|date',
        ]);

        //if no pub date provided, pub immediately
        if(!$validated['published_at']) {
            $validated['published_at'] = now();
        }

        $message = Message::create($validated);

        // Send SMS notifications
        $this->sendSMS($message->title, $message->message);

        return redirect()->route('admin.messages.index')
            ->with('success', 'Message created successfully.');
    }

    public function edit(Message $message)
    {
        return view('admin.messages.edit', compact('message'));
    }

    public function update(Request $request, Message $message)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'message' => 'required|string',
            'type' => 'required|in:feature,tip,update,maintenance',
            'published_at' => 'nullable|date',
        ]);

        $message->update($validated);

        return redirect()->route('admin.messages.index')
            ->with('success', 'Message updated successfully.');
    }

    public function destroy(Message $message)
    {
        $message->delete();

        return redirect()->route('admin.messages.index')
            ->with('success', 'Message deleted successfully.');
    }
    
    private function sendSMS($title, $messageContent)
{
    \Log::info('sendSMS called with title: ' . $title);
    
    $sid = env('TWILIO_SID');
    $token = env('TWILIO_AUTH_TOKEN');
    $twilioNumber = env('TWILIO_PHONE_NUMBER');
    
    \Log::info('Twilio credentials - SID: ' . ($sid ? 'SET' : 'NOT SET') . ', Phone: ' . $twilioNumber);
    
    $twilio = new Client($sid, $token);
    
    // Get ALL subscribers from database
    $subscribers = \App\Models\Subscriber::all();
    
    \Log::info('Found ' . $subscribers->count() . ' subscribers');
    
    // Send SMS to each subscriber
    foreach ($subscribers as $subscriber) {
        \Log::info('Attempting to send SMS to: ' . $subscriber->phone_number);
        try {
            $twilio->messages->create(
                $subscriber->phone_number,
                [
                    'from' => $twilioNumber,
                    'body' => "New Tube Feed Update - " . $title . ": " . $messageContent
                ]
            );
            \Log::info('SMS sent successfully to: ' . $subscriber->phone_number);
        } catch (\Exception $e) {
            \Log::error('SMS failed for ' . $subscriber->phone_number . ': ' . $e->getMessage());
        }
    }
}