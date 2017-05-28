<?php
/**
 * Created by PhpStorm.
 * User: rioad
 * Date: 15/05/2017
 * Time: 13.51
 */
require 'vendor/autoload.php';
include 'bootstrap.php';

use proyekSoa\Models\Video;
use proyekSoa\Models\User;
use proyekSoa\Models\D_subscribe;
use proyekSoa\Models\D_like_video;
use proyekSoa\Models\H_comment;
use proyekSoa\Middleware\Authentication as soaAuth;

//require_once ("db.php");
$app = new Slim\App();

//$app->add(new soaAuth());
//ndk perlu api key
$app->post('/generateApiKey',function($request,$response,$args){
    
    $users = new User();

    $id_user=$request->getParsedBody()["id_user"];
    $password=$request->getParsedBody()["password"];

    $payload=[];

    if($users->getApiKey($id_user,$password))
    {
        $payload["result"]="scuccess";
        $payload["api_key"]=$users->new_api_key;
    }
    else
    {
        $payload["result"]="fail";
        $payload["error_message"]=$users->error_message;
        
    }

    echo json_encode($payload);


});

//ndk perlu api key
$app->post('/insertUser',function($request,$response,$args){

   
    $users= new User();

    $id_user=$request->getParsedBody()["id_user"];
    $password=md5($request->getParsedBody()["password"]);
    $nama_user = $request->getParsedBody()["nama_user"];
    $email=$request->getParsedBody()["email"];
    $tanggal_lahir=$request->getParsedBody()["tanggal_lahir"];
    $date_created=date("Y-m-d");
    $profile_foto_url=$_FILES['newfile']['name'];
    $status="T";
    $description_channel="";
    $subscriber_count=0;
    $api_key="";

    $payload=[];

    if($users->insertUser($id_user,$password,$nama_user,$email,$tanggal_lahir,$date_created,$profile_foto_url,$status,$description_channel,$subscriber_count,$api_key))
    {

        $uploaddir = __DIR__ .'/upload/profileFoto/';
        $uploadfile = $uploaddir . basename($_FILES['newfile']['name']);

        if (move_uploaded_file($_FILES['newfile']['tmp_name'], $uploadfile)) {
            
            $payload["result"]="success";
        } else {
            $payload["result"]="fail";
            $payload["error_message"]="Photo Not Successfully Upload";
        }
    }
    else
    {
        $payload["result"]="fail";
        $payload["error_message"]=$users->error_message;
    }

    echo json_encode($payload);

    

});



//perlu api key
$app->get('/searchChannel/{name}',function($request,$response,$args){
   
    $users = new User();

    $nama_user=$args["name"];

    $payload=[];

    if($users->searchChannelByLikeNamaUser($nama_user))
    {
        $payload["result"]="success";
        $payload["data"]=$users->data;
    }
    else
    {
        $payload["result"]="fail";
        $payload["error_message"]=$users->error_message;
    }

    echo json_encode($payload);
   
});


//perlu api
$app->get('/searchVideo/{name}',function($request,$response,$args){
    $judul_video=$args["name"];
    $videos=new Video();
    $payload=[];

    if($videos->searchVideoByLikeJudul($judul_video))
    {
        $payload["result"]="success";
        $payload["data"]=$videos->data;

    }
    else
    {
        $payload["result"]="fail";
        $payload["error_message"]=$videos->error_message;
    }

    echo json_encode($payload);
});

//perlu api
$app->post('/subscribeChannel',function($request,$response,$args){
   
   $id_channel=$request->getParsedBody()["id_channel"];
   $id_user=$request->getParsedBody()["id_user"];
   $subscribe=$request->getParsedBody()["subscribe"];
   $payload=[];

   if($subscribe=="T")
   {
        $users = new User();
        if($users->updateSubscriberCount($id_channel,1))
        {
            $dsubscribes = new D_subscribe();
            if($dsubscribes->insertDSubscribe($id_channel,$id_user))
            {
                $payload["result"]="success";
            }
            else
            {
                 $payload["result"]="fail";
                 $payload["error_message"]=$dsubscribes->error_message;
            }
            

        }
        else
        {
            $payload["result"]="fail";
            $payload["error_message"]=$users->error_message;
        }

        


   }
   else
   {
        $users = new User();
        if($users->updateSubscriberCount($id_channel,-1))
        {
            $dsubscribes = new D_subscribe();
            if($dsubscribes->deleteDSubscribe($id_channel,$id_user))
            {
                $payload["result"]="success";
            }
            else
            {
                 $payload["result"]="fail";
                 $payload["error_message"]=$dsubscribes->error_message;
            }

        }
        else
        {
            $payload["result"]="fail";
            $payload["error_message"]=$users->error_message;
        }

        //delete D_subscribe
   }

   echo json_encode($payload);


});

///perlu api
$app->get('/getChannelSubscribed/{id_user}',function($request,$response,$args){
   
    $dsubscribes = new D_subscribe();
    $id_channel = $args["id_user"];
    $payload=[];

    if($dsubscribes->getSubscriberList($id_channel))
    {
        $payload["result"]="success";
        $payload["data"]=$dsubscribes->data;
    }
    else
    {
        $payload["result"]="fail";
        $payload["error_message"]=$dsubscribes->error_message;
    }

    echo json_encode($payload);


});

//perlu api
$app->get('/getTotalSubscriber/{id_user}',function($request,$response,$args){
    //echo "hello world";
    //cara kedua
    //return $response->write("Hello ".$args['name'].$args["last"]);
    $id_user = $args["id_user"];
    $users = new User();
    $payload=[];
    if($users->getTotalSubscriber($id_user))
    {
        $payload["result"]="success";
        $payload["data"]=$users->data;
    }
    else
    {
        $payload["result"]="fail";
        $payload["error_message"]=$users->error_message;
    }

    echo json_encode($payload);
});

//perlu api
$app->get('/getVideoViewers/{id_video}',function($request,$response,$args){
    
    $id_video=$args["id_video"];
    $videos = new Video();
    $payload=[];


    if($videos->getVideoViewersByIdVideo($id_video))
    {
        $payload["result"]="success";
        $payload["data"]=$videos->data;
    }
    else
    {
        $payload["result"]="fail";
        $payload["error_message"]=$videos->error_message;
    }

    echo json_encode($payload);
});

//perlu api
$app->get('/getInfoChannel/{id_user}',function($request,$response,$args){
    
    $id_user=$args["id_user"];

    $users = new User();
    $payload=[];

    if($users->getInfoChannel($id_user))
    {
        $payload["result"]="success";
        $payload["data"]=$users->data;
    }
    else
    {
        $payload["result"]="fail";
        $payload["error_message"]=$users->error_message;
    }

    echo json_encode($payload);
});

$app->get('/getNewCommentOnVideos/{id_user}',function($request,$response,$args){
  $id_user=$args["id_user"];

  $hcomments = new H_comment();
  $payload=[];

  if($hcomments->getCommentNotRead($id_user))
  {
    $payload["result"]="success";
    $payload["data"]=$hcomments->data;
  }
  else
  {
    $payload["result"]="fail";
    $payload["error_message"]=$hcomments->error_message;
  }

  echo json_encode($payload);
});

$app->post('/insertComment',function($request,$response,$args){
   
    $message = $request->getParsedBody()["message"];
    $status_read="F";
    $id_video = $request->getParsedBody()["id_video"];
    $id_user = $request->getParsedBody()["id_user"];


   $hcomments = new H_comment();
   $payload=[];

   if($hcomments->insertComment($message,$status_read,$id_video,$id_user))
   {
     $payload["result"]="success";

   }
   else
   {
    $payload["result"]="fail";
    $payload["error_message"]=$hcomments->error_message;
   }
   echo json_encode($payload);
});

$app->post('/uploadVideo',function($request,$response,$args){
    

    $videos=new Video();
    $payload=[];
    $judul_video=$request->getParsedBody()["judul_video"];
    $description=$request->getParsedBody()["description"];
    $video_path=$_FILES['newfile']['name'];
    $id_user=$request->getParsedBody()["id_user"];

    if($videos->insertVideo($judul_video,$description,$video_path,$id_user))
    {
        
        $uploaddir = __DIR__ .'/upload/video/';
        $uploadfile = $uploaddir . basename($_FILES['newfile']['name']);

        if (move_uploaded_file($_FILES['newfile']['tmp_name'], $uploadfile)) {
            
            $payload["result"]="success";
        } else {
            $payload["result"]="fail";
            $payload["error_message"]="Video Not Successfully Upload";
        }

        //print_r($_FILES);
    }
    else
    {
        $payload["result"]="fail";
        $payload["error_message"]=$videos->error_message;
    }

    echo json_encode($payload);

});

$app->run();