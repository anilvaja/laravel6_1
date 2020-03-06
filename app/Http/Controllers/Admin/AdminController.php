<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return void
     */
    public function index()
    {

        if (Auth::check() && Auth::user()->hasRole('Admin')) {
            return view('admin.dashboard');
        }
        else if(Auth::check() && Auth::user()->hasRole('Employee')){
            return view('employee.dashboard');
        }
        else{
            return view('auth.login');
        }
    }
}
