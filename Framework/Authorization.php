<?php

namespace Framework;

use Framework\Session;

class Authorization
{
    /**
     * Check if current logged in user own a resource
     * 
     * @param int $resourceId
     * 
     * @return bool
     */
    public static function isOwner($resourceId)
    {
        $sessionUser = Session::get('user');

        if ($sessionUser !== null && isset($sessionUser['id'])) {
            $sessionUderId = (int) $sessionUser['id'];
            return $sessionUderId === (int) $resourceId;
        }

        return false;
    }
}
