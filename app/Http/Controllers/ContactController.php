<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        return view('components.admin.contacts.contacts');
    }
    public function store(Request $request)
    {
       
       $cleaned= $request->validate([
            "name" => "required|string",
            "email" => "required|string",
            "subject" =>"required|string",
            "body" =>"required|string"
        ]);

        $contact = Contact::create($cleaned);
        return redirect()->back()->with("message", "Hello .$contact->name.,Thank you for contacting us!");
    }
    public function remove(Contact $contact)
    {
        $contact->delete();
        return redirect()->back()->with("message", "Contact Removed successfully!");
    }
    public function clear()
    {
        Contact::truncate();
        return redirect()->back()->with("message", "all Contacts Cleared successfully!");
    }
}
