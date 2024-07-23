<?php

namespace Framework;

use Framework\Session;

class Authorisation
{
     // check if current user owns a resource
    

    public static function isOwner($resourceId)
    {
        $sessionUser = Session::get('user');

        if ($sessionUser !== null && isset($sessionUser['id'])) {
            $sessionUserId = (int)$sessionUser['id'];
            return $sessionUserId === $resourceId;
        }

        return false;
    }
}