<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Driver;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

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
    protected function authenticated(Request $request, $user)
    {
        // Driver rekordja a 'driver_id' alapján
        $driver = Driver::where('id', $user->id)->first();

        // Ha nincs hozzárendelt driver, akkor hibaüzenet
        if (!$driver) {
            return redirect()->route('login')->withErrors(['msg' => 'Nincs hozzárendelt fuvarozó']);
        }

        // Ha admin felhasználó (is_admin = 1), /jobs oldalra
        if ($driver->is_admin) {
            return redirect()->route('jobs.index');
        }

        // Ha fuvarozó felhasználó (is_admin = 0), /djobs oldalra
        return redirect()->route('drivers.index');
    }

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

}
