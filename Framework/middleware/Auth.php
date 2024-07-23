<?php

namespace Framework\middleware;

use Framework\Session;

class Auth
{

    //Check if user is authenticated


    public function isAuthenticated()
    {
        return Session::has('user');
    }

    // Handle the user's request


    public function handle($role)
    {
        if ($role === 'guest' && $this->isAuthenticated()) {
            return redirect('/');
        } else if ($role === 'auth' && !$this->isAuthenticated()) {
            return redirect('/auth/login');
        }
    }
}
