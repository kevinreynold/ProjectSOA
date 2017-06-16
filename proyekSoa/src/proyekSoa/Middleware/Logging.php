<?php

namespace proyekSoa\Middleware;

use proyekSoa\Models\User;
use proyekSoa\Models\Log;

Class Logging{

  public $keterangan;

  public function __construct($keterangan)
  {
    $this->keterangan=$keterangan;
  }

  public function __invoke($request, $response, $next)
  {

   $response = $next($request, $response);

   //untuk join json
   $response->getBody()->rewind();
   $object = json_decode($response->getBody(),true);
  //  $object['keterangan'] = $this->keterangan;
  // return $response->withJson($object);
  if($object["result"]!="fail-api")
  {
    $auth = $request->getHeader('Authorization');
    $_apikey = $auth[0];
    $apikey = substr($_apikey, strpos($_apikey, ' '));
    $apikey = trim($apikey);

    $users = new User();
    $tempUser=$users->getDetailUserByApiKey($apikey);

    $tempUser->id_user;

    $logs = new Log();
    $logs->insertLog($this->keterangan." ".$object["result"],$tempUser->id_user);
  }

  return $response;

  }
}
