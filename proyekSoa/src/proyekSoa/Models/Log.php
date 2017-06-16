<?php

namespace proyekSoa\Models;
use Illuminate\Database\QueryException;

class Log extends \Illuminate\Database\Eloquent\Model
{
	protected $table = 'log';
	public $timestamps = false;



	function insertLog($keterangan,$id_user)
	{
    $logs = new Log();
    $logs->keterangan=$keterangan;
    $logs->tgl=date("Y-m-d");
    $logs->waktu=date("h:i:sa");
    $logs->id_user=$id_user;
    $logs->save();

  }

}
