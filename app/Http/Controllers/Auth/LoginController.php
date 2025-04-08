<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = '/admin';

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function username()
    {
        return 'username'; // Only return the login field name
    }

    public function login(Request $request)
    {
        // Validate input
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        // Check if user exists and is active
        $user = DB::table('users')->where('username', $request->username)->first();

        if (!$user) {
            return back()->with('status', 'error')->with('sms', 'User not found.');
        }

        if ($user->status == 0) {
            return back()->with('status', 'error')->with('sms', 'Your account is inactive! Please contact admin.');
        }

        // Try to login
        if (Auth::attempt(['username' => $request->username, 'password' => $request->password])) {
            return redirect()->intended($this->redirectTo)->with('status', 'success')->with('sms', 'Login successfully!');
        }

        return back()->with('status', 'error')->with('sms', 'Invalid credentials.');
    }
}
