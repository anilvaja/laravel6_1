<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Notification;
use App\Notifications\MyFirstNotification;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }
    
    /**
     * 
     */

    public function sendNotification()
    {
        $user = User::first();
        $details = [
            'greeting' => 'Hi Artisan',
            'body' => 'This is my first notification from Laravel',
            'thanks' => 'Thank you for using Laravel tutorial!',
            'actionText' => 'View My Site',
            'actionURL' => url('/'),
            'sample' => 101
        ];
  
        Notification::send($user, new MyFirstNotification($details));
        dd('done');
    }
}
