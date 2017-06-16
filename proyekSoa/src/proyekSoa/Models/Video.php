<?php

namespace proyekSoa\Models;
use proyekSoa\Models\User;
use Illuminate\Database\QueryException;

class Video extends \Illuminate\Database\Eloquent\Model
{
	protected $table = 'video';
	public $timestamps = false;




	function searchVideoByLikeJudul($judul_video)
	{
		$video = Video::select("video.judul_video",'video.description','video.date_publish','video.time_publish','video.like_count','video.dislike_count','video.comment_count','video.video_path','user.nama_user')->where("judul_video","LIKE",'%'.$judul_video.'%')->join('user','user.id_user','=','video.id_user')->get();
		//var_dump($video);
		//echo $judul_video;
		//var_dump($video);
		if($video->first())
		{
			$this->data=$video;
			return true;
		}
		else
		{
			$this->error_message="Video Tidak Ditemukan";
			return false;
		}
	}

	function getVideoViewersByIdVideo($id_video)
	{
		$video = Video::select('viewers_count')->where('id_video','=',$id_video)->first();

		if($video)
		{
			$this->data=$video;
			return true;
		}
		else
		{
			$this->error_message="Video Tidak Ditemukan";
			return false;
		}


	}

	function insertVideo($judul_video,$description,$video_path,$id_user)
	{
		try
		{
			//check id user apakah ada
			$users=new User();
			$users=$users->checkIdUser($id_user);

			if($users)
			{
				$videos=new Video();
				$videos->judul_video=$judul_video;
				$videos->description=$description;
				$videos->date_publish=date("Y-m-d");
				$videos->time_publish=date("h:i:sa");
				$videos->like_count=0;
				$videos->dislike_count=0;
				$videos->viewers_count=0;
				$videos->comment_count=0;
				$videos->video_path=$video_path;
				$videos->id_user=$id_user;
				$videos->save();
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
