<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
	public function get_list()
	{
		return DB::table('patient')->get();
	}
	
	public function get_patient($id)
	{
		return DB::table('patient')->select('id', 'fio')->where('id', $id)->get();
	}
	
	public function get_ds_di()
	{
		return DB::table('ds')->leftJoin('patient', 'patient.id', '=', 'ds.patient')->leftJoin('di', 'di.id', '=', 'ds.ds')->select('ds.id', 'ds.uid', 'patient.fio', 'di.text', 'ds.sdate', 'ds.fdate')->get();
	}
	
	public function get_ds($id)
	{
		return DB::table('ds')->where('id', $id)->first();
	}
	
	public function get_di()
	{
		return DB::table('di')->select('id', 'text')->get();
	}
	
	public function ins_ds($data)
	{
		return DB::table('ds')->insertGetId($data);
	}

	public function ins_di($data)
	{
		return DB::table('di')->insertGetId($data);
	}
	
	public function upd_ds($id, $data)
	{
		DB::table('ds')->where('id', $id)->update($data);
	}
	
	public function del_ds($id)
	{
		DB::table('ds')->where('id', $id)->delete();
	}
}

