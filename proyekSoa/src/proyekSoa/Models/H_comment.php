<?php

namespace proyekSoa\Models;
use Illuminate\Database\QueryException;
use proyekSoa\Models\User;
use proyekSoa\Models\Video;

class H_comment extends \Illuminate\Database\Eloquent\Model
{
	protected $table = 'h_comment';
	public $timestamps = false;

	function insertComment($message,$status_read,$id_video,$id_user)
	{
		try
		{
			
			$hcomments = new H_comment();
			$hcomments->date=date("Y-m-d");
			$hcomments->time=date("h:i:sa");
			$hcomments->message=$message;
			$hcomments->status_read=$status_read;
			$hcomments->id_video=$id_video;
			$hcomments->id_user=$id_user;
			$hcomments->save();

			return true;
			
			
		}
		catch(QueryException $ex)
		{
			$this->error_message=$ex->getMessage();

			return false;
		}
	}

	function getCommentNotRead($id_user)
	{
		try
		{
			$hcomments=H_comment::select("h_comment.id_comment",'h_comment.date','h_comment.time','h_comment.message','h_comment.status_read','h_comment.id_user','video.judul_video')->where("h_comment.status_read",'=','F')->where('video.id_user','=',$id_user)->join('video','video.id_video','=','h_comment.id_video')->get();

			if($hcomments->first())
			{
				$this->data=$hcomments;
				return true;
			}
			else
			{
				$this->error_message="Data Tidak Ditemukan";
				return false;
			}

		}catch(QueryException $ex)
		{
			$this->error_message=$ex->getMessage();
			return false;
		}
	}


}
