<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Email;
use App\Models\Number;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    function show(Request $request)
    {
        $content = $request->get('content');
        $contact = '';
        if ($number = Number::where('number', $content)->first()) {
            $contact = $number->contact;
        } elseif ($email = Email::where('email', $content)->first()) {
            $contact = $email->contact;
        } elseif ($search = Contact::where('name', $content)->first()) {
            $contact = $search;
        } else {

        }
        return view('contacts.show', compact('contact'));

    }
}
