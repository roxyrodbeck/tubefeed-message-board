<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Message;
use Illuminate\Http\Request;

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

        Message::create($validated);

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
}
