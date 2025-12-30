<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function index()
    {
        $messages = Message::with('user')
            ->published()
            ->latest()
            ->paginate(20);

        return view('messages.index', compact('messages'));
    }

    public function rss()
    {
        $messages = Message::with('user')
            ->published()
            ->latest()
            ->limit(50) 
            ->get();
            
        return response()
            ->view('messages.rss', compact('messages'))
            ->header('Content-Type', 'application/rss+xml; charset=utf-8');
    }
}
