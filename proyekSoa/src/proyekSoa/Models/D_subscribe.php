<?php

namespace proyekSoa\Models;
use proyekSoa\Models\User;
use Illuminate\Database\QueryException;

class D_subscribe extends \Illuminate\Database\Eloquent\Model
{
	protected $table = 'd_subscribe';
	public $timestamps = false;


	function insertDSubscribe($id_channel,$id_user)
	{
		$userSubscribed = User::where("id_user",'=',$id_channel)->first();
		$userSubscriber = User::where("id_user",'=',$id_user)->first();

		if($userSubscribed && $userSubscriber)
		{
			try
			{
				$dsubscribes = new D_subscribe();
				$dsubscribes->id_user_subscriber=$id_user;
				$dsubscribes->id_user2_subscribed=$id_channel;
				$dsubscribes->save();
				return true;

			}
			catch(QueryException $ex)
			{
				$this->error_message=$ex->getMessage();

				return false;
			}
			
		}
		else
		{
			$this->error_message="id user tidak ditemukan";

			return false;
		}

	}

	function deleteDSubscribe($id_channel,$id_user)
	{
		try{
			D_subscribe::where(["id_user2_subscribed"=>$id_channel,"id_user_subscriber"=>$id_user])->delete();
			return true;
		}catch (QueryException $ex)
		{
			$this->error_message=$ex->getMessage();

			return false;
		}
	}

	function getSubscriberList($id_channel)
	{
		try
		{
			$dsubscribes = D_subscribe::select('id_user_subscriber')->where("id_user2_subscribed",'=',$id_channel)->get();

			if($dsubscribes->first())
			{
				$this->data=$dsubscribes;
				return true;
			}
			else
			{
				$this->error_message="data tidak ditemukan";
				return false;
			}
		}
		catch(QueryException $ex)
		{
				$this->error_message=$ex->getMessage();
				return false;
		}
		
	}
}
