<?php

namespace proyekSoa\Middleware;

use proyekSoa\Models\User;

class Authentication
{

    public function __invoke($request, $response, $next)
    {
        $auth = $request->getHeader('Authorization');
        //print_r($auth);
        if($auth)
        {
        $_apikey = $auth[0];
        $apikey = substr($_apikey, strpos($_apikey, ' '));
        $apikey = trim($apikey);

        $user = new User();



        if (!$user->getUserWithApiKey($apikey)) {
            $response->withStatus(401);
            // $response->getBody()->write('BEFORE');
            // $response = $next($request, $response);
            // $response->getBody()->write('AFTER');
            //diatas untuk gabungin

           // $response->getBody()->write("user tidak ditemukan asd");
            $payload["result"]="fail";
            $payload["error_message"]="api key tidak terdaftar";

            return $response->withStatus(401)->withJSON($payload);
            //return $response->withStatus(200)->withJSON($payload);
        }

        //$request = $request->withAttribute('id_user', $user->details->id_user);
        //ambil response dari sebelumnya
        $response = $next($request, $response);

        return $response;
      }
      else {
        # code...
        $response->withStatus(401);

        $payload["result"]="fail";
        $payload["error_message"]="api key tidak diinput!";

        return $response->withStatus(401)->withJSON($payload);
      }
    }
}
