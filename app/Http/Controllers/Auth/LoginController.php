<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
   // protected $redirectTo = RouteServiceProvider::HOME;


 public function redirectTo(){
        
    // User role
    $role = Auth::user()->user_type; 
    
    // Check user role
    switch ($role) {
        case 'Admin':
                return '/dashboard';
            break;
        case 'Client':
               return '/dashboard';
        //     break; 
        // case 'Executive':
        //         return '/appoffers';
        //     break; 
        // case 'Partner':
        //         return '/appoffers';
        //     break; 
       

        default:
                return '/home'; 
            break;
    }
}

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
