<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{

    use AuthenticatesUsers;

    protected $redirectTo = '/panel';

    public function __construct()
    {
        $this->middleware('guest:panel')->except('logout');
        $this->middleware('auth:panel')->only('logout');
    }

    protected function guard()
    {
        return Auth::guard('panel');
    }
}
