<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function index()
    {
        $messages = Message::published()->get();
        return view('messages.index', compact('messages'));
    }

    public function rss()
    {
        $messages = Message::published()->get();
        return response()
            ->view('messages.rss', compact('messages'))
            ->header('Content-Type', 'application/rss+xml; charset=utf-8');
    }
}
