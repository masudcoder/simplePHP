<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\User;

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
    protected $redirectTo = '/manageBids';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }

    

    public function login(Request $request)
    {
    
        $request->validate([
            'pin' => 'required|string'
        ]);

        $user = User::where('pin', $request->pin)->first();
        if ($user) {
            Auth::login($user); // login without password
            return redirect()->intended('home'); // or your desired route
        }
        
        return back()->withErrors([
            'pin' => 'Invalid PIN.',
        ])->onlyInput('pin');
    }
    

}
