<?php

namespace proyekSoa\Models;
use proyekSoa\Models\Video;
use Illuminate\Database\QueryException;

class User extends \Illuminate\Database\Eloquent\Model
{
	protected $table = 'user';
	public $timestamps = false;


	function getDetailUserByApiKey($apikey)
	{
		$user = User::where('api_key', '=', $apikey)->first();
		return $user;
	}

	function getUserWithApiKey($apikey)
	{
		$user = User::where('api_key', '=', $apikey)->first();
        $this->details = $user;

        if($user)
        {
        	return true;
        }
        else
        {
        	return false;
        }
	}

	function insertUser($id_user,$password,$nama_user,$email,$tanggal_lahir,$date_created,$profile_foto_url,$status,$description_channel,$subscriber_count,$api_key)
	{

		try
	    {
	    	 //check id_user kembar
	    	 $userFromDatabase = User::where('id_user',"=",$id_user)->first();

	    	 if($userFromDatabase)
	    	 {
	    	 	$this->error_message="id user sudah terdaftar!";
	    	 	return false;
	    	 }
	    	 else
	    	 {
	    	 	 $tempUser = new User();
			     $tempUser->id_user = $id_user;
			     $tempUser->password = $password;
			     $tempUser->nama_user = $nama_user;
			     $tempUser->email=$email;
			     $tempUser->tanggal_lahir=$tanggal_lahir;
			     $tempUser->date_created=$date_created;
			     $tempUser->profile_foto_url=$profile_foto_url;
			     $tempUser->status=$status;
			     $tempUser->description_channel=$description_channel;
			     $tempUser->subscriber_count=$subscriber_count;
			     $tempUser->api_key=$api_key;
			     $tempUser->save();
		     	 return true;
	    	 }


	    }
	    catch (QueryException $e)
	    {
	        $this->error_message = $e->getMessage();
	        return false;
	    }
	}

	function getApiKey($id_user,$password)
	{

		try
		{
			//public $primaryKey  = '_id';

			$tempUserSelect=User::where("id_user",'=',$id_user)->first();
			if(md5($password)==$tempUserSelect->password)
			{
				User::where(["id_user"=>$id_user])->update(["api_key"=>md5($id_user)]);
				$this->new_api_key=md5($tempUserSelect->id_user);
				return true;
			}
			else
			{
				$this->error_message = "password tidak sesuai";
				return false;
			}

		}
		catch(QueryException $ex)
		{
			$this->error_message = $e->getMessage();
	        return false;
		}

	}

	function searchChannelByLikeNamaUser($nama_user)
	{

			$channel = User::select('id_user','nama_user','profile_foto_url')->where('nama_user','LIKE', '%'.$nama_user.'%')->where('status','=','T')->get();

		//var_dump();
		if($channel->first())
		{
			$this->data=$channel;
			return true;
		}
		else
		{
			$this->error_message="Data Tidak Ditemukan";
			return false;
		}

	}

	function getInfoChannel($id_user)
	{
		$channel=User::select('id_user','nama_user','email','tanggal_lahir','date_created','profile_foto_url','status','description_channel','subscriber_count')->where('id_user','=',$id_user)->first();

		if($channel)
		{
			$this->data=$channel;
			return true;
		}
		else
		{
			$this->error_message="Data Tidak Ditemukan";
			return false;
		}

	}

	function getTotalSubscriber($id_user)
	{
		$channel=User::select('subscriber_count')->where('id_user','=',$id_user)->first();

		if($channel)
		{
			$this->data=$channel;
			return true;
		}
		else
		{
			$this->error_message="Data Tidak Ditemukan";
			return false;
		}



	}

	function checkIdUser($id_user)
	{
		$users=User::where('id_user','=',$id_user)->first();

		return $users;
	}

	function updateSubscriberCount($id_user,$count)
	{
		try
		{
			//public $primaryKey  = '_id';

			$tempUserSelect=User::where("id_user",'=',$id_user)->first();
			if($tempUserSelect)
			{
				$countNow = $tempUserSelect->subscriber_count;
				$countNow +=$count;
				User::where(["id_user"=>$id_user])->update(["subscriber_count"=>$countNow]);

				return true;
			}
			else
			{
				$this->error_message = "id user tidak ditemukan";
				return false;
			}

		}
		catch(QueryException $ex)
		{
			$this->error_message = $e->getMessage();
	        return false;
		}
	}

}
