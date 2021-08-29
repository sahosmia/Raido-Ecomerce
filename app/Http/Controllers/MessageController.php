<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Carbon\Carbon;

use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function message_add(Request $req)
    {
        $name = $req->name;
        $email = $req->email;
        $message = $req->message;
        $created_at = Carbon::now();

        $req->validate([
            'name' => 'required',
            'email' => 'required',
            'message' => 'required',
        ]);

        Message::insert([
            "name" => $name,
            "email" => $email,
            "message" => $message,
            "created_at" => $created_at,
        ]);

        return back()->with('success', 'You are success to add a new cupon');
    }
    // message view
    public function message_view($id)
    {
        if (Message::find($id)->action == 1) {
            Message::find($id)->update([

                'action' => 2,
            ]);
        }

        return view('frontend.message', [
            'messages_id' => Message::find($id),
            'messages' => Message::latest()->get(),
            'message_count' => Message::where('action', 1)->count(),
        ]);
    }
}
