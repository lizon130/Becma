<?php

namespace App\Http\Controllers\backend;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

class AdminMailController extends Controller
{
    public function showMailForm()
    {
        // Get all users who have the 'seller' role
        $sellers = User::whereHas('roles', function($query) {
            $query->where('name', 'seller'); // Adjust the role name if needed
        })->get();

        return view('backend.pages.mail.adminMail', compact('sellers'));
    }

    public function sendMail(Request $request)
    {
        $request->validate([
            'subject' => 'required',
            'message' => 'required',
            'recipient' => 'required'
        ]);

        $subject = $request->input('subject');
        $message = $request->input('message');
        $recipient = $request->input('recipient');

        if ($recipient === 'all') {
            // Get all sellers with the 'seller' role
            $sellers = User::whereHas('roles', function($query) {
                $query->where('name', 'seller');
            })->get();

            foreach ($sellers as $seller) {
                Mail::raw($message, function ($mail) use ($seller, $subject) {
                    $mail->to($seller->email)
                         ->subject($subject);
                });
            }
        } else {
            Mail::raw($message, function ($mail) use ($recipient, $subject) {
                $mail->to($recipient)
                     ->subject($subject);
            });
        }

        return redirect()->back()->with('success', 'Mail sent successfully!');
    }
}
