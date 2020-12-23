<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Email;
use App\Models\Number;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ContactController extends Controller
{
    public function index()
    {
        $contacts = Contact::sortable(['name' => 'asc'])->paginate(15);
//        $sortedContacts = $contacts->sortBy('name');
//        $sortedContacts1 =$sortedContacts->values()->all();

        return view('contacts.index', compact('contacts'));
    }

    public function create()
    {
        return view('contacts.create');

    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'number.*' => 'required|numeric|unique:numbers,number',
            'email.*' => 'required|unique:emails,email',
        ]);
        $contact = Contact::add($request);


        return redirect()->route('contacts.index')->with('status', 'The contact'. ' ' . $contact->name . ' ' . 'has been created!');
    }

    public function show(Contact $contact)
    {
        //
    }

    public function edit(Contact $contact)
    {
        $numbers = $contact->numbers->all();
        $emails = $contact->emails->all();
        $lastNumberId = Number::latest()->first()->id;
        $lastEmailId = Email::latest()->first()->id;
        return view('contacts.edit', compact('contact', 'numbers', 'emails','lastNumberId', 'lastEmailId'));
    }



    public function update(Request $request, Contact $contact)
    {
        $id = $contact->id;
        $compare = $contact->checkValues($request);
        if (!$compare) {
            return back()->with('status', 'The values must be different');
        }

        $this->validate($request, [
            'name' => 'required',
            'number.*' => [
                'required',
                'numeric',
                Rule::unique('numbers', 'number')->ignore($id, "contact_id")
            ],
            'email.*' => [
            'required',
                Rule::unique('emails', 'email')->ignore($id, "contact_id")
            ],
        ]);

        $contact->edit($request, $contact);
        return redirect()->route('contacts.index')->with('status', 'The contact'. ' ' . $contact->name . ' ' . 'has been edited!');
    }

    public function destroy(Contact $contact)
    {
        $contact->delete();
        return redirect()->route('contacts.index')->with('status', 'The contact'. ' ' . $contact->name . ' ' . 'has been deleted!');
    }
}
