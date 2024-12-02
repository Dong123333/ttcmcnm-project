<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Events\MessageSent;
use App\Models\User;

class ChatController extends Controller
{
    public function chat()
    {
        $currentUserId = Auth::id();
        // Lấy danh sách user trừ người dùng hiện tại
        $users = User::where('id', '!=', $currentUserId)->get();
        // Truyền danh sách user vào view

        return view('chat', compact('users'));
    }


    public function broadcast(Request $request)
    {
        $request->validate([
            'receiver_id' => 'required|exists:users,id',
            'content' => 'required|string|max:1000',
        ]);

        $message = Message::create([
            'sender_id' => Auth::user()->id,
            'receiver_id' => $request->input('receiver_id'),
            'content' => $request->input('content'),
        ]);

        broadcast(new MessageSent($message))->toOthers();
        return view('broadcast', ['message' => $message]);
    }

    public function fetchMessages($receiverId)
    {
        $messages = Message::where(function ($query) use ($receiverId) {
            $query->where('sender_id', Auth::id())
                ->where('receiver_id', $receiverId);
        })->orWhere(function ($query) use ($receiverId) {
            $query->where('sender_id', $receiverId)
                ->where('receiver_id', Auth::id());
        })->orderBy('created_at', 'asc')->get();

        return response()->json($messages);
    }
}
