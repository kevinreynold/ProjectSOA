<?php

namespace proyekSoa\Middleware;

use proyekSoa\Models\User;

class Authentication
{

    public function __invoke($request, $response, $next)
    {
        $auth = $request->getHeader('Authorization');
        //print_r($auth);
        $_apikey = $auth[0];
        $apikey = substr($_apikey, strpos($_apikey, ' '));
        $apikey = trim($apikey);

        $user = new User();



        if (!$user->getUserWithApiKey($apikey)) {
            $response->withStatus(401);

            return $response;
        }

        $request = $request->withAttribute('id_user', $user->details->id);
        $response = $next($request, $response);

        return $response;
    }
}