<?php

namespace Framework\Middleware;

use Framework\Session;

class Authorize
{
    /**
     * Check to see if user is logged in
     * 
     * @return bool
     */
    public function isAuthenticated()
    {
        return Session::has('user');
    }

    /**
     * Handle the user's request
     * 
     * @param string $role
     * 
     * @return bool 
     */
    public function handle($role)
    {
        if ($role == 'guest' && $this->isAuthenticated()) {
            redirect('/');
        } else if ($role == 'auth' && !$this->isAuthenticated()) {
            redirect('/auth/login');
        }
    }
}
