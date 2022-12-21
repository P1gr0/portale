<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContactController extends Controller

{
    /**
     * Write code on Method
     *
     * @return response()
     */

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'last_name' => 'required',
            'subject' => 'required',
            'message' => 'required'
        ]);

        Contact::create([
            'name' => htmlspecialchars($request->name),
            'email' => Auth::user()->email,
            'to' => $request->to,
            'last_name' => htmlspecialchars($request->last_name),
            'subject' => htmlspecialchars($request->subject),
            'message' => htmlspecialchars($request->message)
        ]);

        return redirect()->back()
            ->with(['success' => 'Grazie per avermi contattato. Riceverai una risposta a breve!']);
    }
}

