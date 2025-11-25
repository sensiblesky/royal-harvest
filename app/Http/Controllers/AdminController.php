<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\{Blog, Contact, Promotion, Subscriber, User};
use Mockery\Matcher\Subset;
use \App\Models\Booking;

class AdminController extends Controller
{
    //dashbaord HERE ======================================================================================
    public function dashboard()
    {
        return view('components.admin.dashboard');
    }

    //USER HERE ======================================================================================
 public function users()
    {
        return view('components.admin.users.users');
    }

    public function removeUser(User $user)
    {
        $user->delete();
        return back()->with('message', "user Removed successfully!");
    }

    public function addUser(Request $request)
    {
        $cleanedData = $request->validate([
            'name' => "required|string",
            'email' => "required|string",
            'password' => "required|string"
        ]);
        User::create([
            'name' => $cleanedData['name'],
            'email' => $cleanedData['email'],
            'email_verified_at' => now(),
            'password' => bcrypt($cleanedData['email']),
        ]);

        return back()->with('message', "user created successfully!");
    }


    //Bookings HERE======================================================================================
    public function bookings($status)
    {
        $results=$status==0?Booking::where('isDone',false)->get():Booking::where('isDone',true)->get();
        // dd( $results);
        return view('components.admin.bookings.bookings',["bookings" =>$results ]);
    }
    


    public function removeBooking(Booking $booking)
    {
        $booking->delete();
        return back()->with('message', "Promotion deleted successfully!");
    }
    public function updateBooking(Booking $booking)
    {   
        $booking->fill(['isDone'=>$booking->isDone==0?1:0])->update();
        return back()->with('message', "Booking has been updated successfully!");
    }
    public function clearBookings()
    {
        Booking::truncate();
        return back()->with('message', "Promotion cleared successfully!");
    }

    public function updatePromotion(Request $request,$id)
    {
        $request->validate([
            'large_title' => "required|string",
            'small_title' => "required|string",
        ]);

        $cleanedData = $request->only('large_title', 'small_title');
        if ($request->hasFile('image_path')) {

            $cleanedData['image_path'] = $request->file('image_path');
        }


        // $promotion->fill($cleanedData)->update();

        return back()->with('message', "Promotion updated successfully!");
    }



    //UPDATE HERE======================================================================================
    public function updates()
    {

        return view('components.admin.updates.updates');
    }
    public function storeUpdates(Request $request)
    {
        $request->validate([
            'title' => "required|string",
            'content' => "required|string",
            'image_path' => 'image|mimes:jpeg,png,jpg,gif'
        ]);

        $cleanedData = $request->only('title', 'content');

        if ($request->hasFile('image_path')) {

            $cleanedData['image_path'] = $request->file('image_path')->store('updates', 'public');
        }


        // Blog::create($cleanedData);
        return back()->with('message', "update shared successfully!");
    }

    public function removeUpdate($id)
    {
        // Blog::findOrfail($id)->delete();
        // $update->delete();
        return back()->with('message', "update deleted successfully!");
    }
    public function clearUpdates()
    {

        // Blog::truncate();
        return back()->with('message', "Update cleared successfully!");
    }

    public function showUpdate($id)
    {
        // $blog = Blog::findOrfail($id);
        return view('frontend.showUpdate', ['update' => 1]);
    }

    public function updateUpdate(Request $request, $id)
    {
        $request->validate([
            'title' => "required|string",
            'content' => "required|string",
        ]);


        $cleanedData = $request->only('title', 'content');

        if ($request->hasFile('image_path')) {

            $cleanedData['image_path'] = $request->file('image_path')->store('updates', 'public');
        }

        // Blog::findOrfail($id)->fill($cleanedData)->update();

        return back()->with('message', "updates updates successfully!");
    }



    //SUBSCRIBERS HERE======================================================================================
    public function subscribers()
    {
        return view('components.admin.subscribers.subscribers');
    }


    public function storeSubscriber(Request $request)
    {
        $cleanedData = $request->validate([
            'email' => "required|string",
        ]);
        // if (Subscriber::where('email', $request['email'])->exists()) {

        //     return back()->with('message', "Already Exist,Thank you for subscribing!");
        // } else {
        //     Subscriber::create($cleanedData);
        //     return back()->with('message', "Thank you for subscribing!");
        // }
    }

    public function removeSubscriber(Subscriber $subscriber)
    {
        $subscriber->delete();
        return back()->with('message', "Thank you, unsubsribed successfully");
    }

    public function clearSubscribers()
    {
        Subscriber::truncate();
        return back()->with('message', "Thank you and Goodbye");
    }



    //CONTACT HERE======================================================================================
    public function contacts()
    {
        return view('components.admin.contacts.contacts');
    }


    public function storeContact(Request $request)
    {

        $cleanedData = $request->validate([
            'name' => "required|string",
            'email' => "required|string",
            'subject' => "required|string",
            'body' => "required|string",
            'phone' => "required|string",

        ]);

        Contact::create($cleanedData);
        return back()->with('message', "Thank you for contacting Us!");
    }

    public function removeContact(Contact $contact)
    {
        $contact->delete();
        return back()->with('message', "Thank you and Goodbye");
    }

    public function clearContacts()
    {
        Contact::truncate();
        return back()->with('message', "Cleared successfully!");
    }
   
}
