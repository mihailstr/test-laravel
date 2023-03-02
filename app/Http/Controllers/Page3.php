<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Patient;

class Page3 extends Controller
{
    public function __invoke(Request $request)
	{
		return view('page2', [
			'pagetitle' => 'Страница создания случая',
			'patient' => Patient::get_list(),
			'di' => Patient::get_di(),
			'ds' => '',
		]);
    }

	public function change($id)
	{
		return view('page2', [
			'pagetitle' => 'Страница изменения случая',
			'patient' => Patient::get_patient($id),
			'di' => Patient::get_di(),
			'ds' => Patient::get_ds($id),
		]);
	}

	public function save($request, $id)
	{
		$request = $request->all();
		$di = $request['di'];
		if ($di == '0' && $request['newdi'] != '') {
			$di = Patient::ins_di(['text' => $request['newdi']]);
		}
		if ($id) {
			$ds = ['uid' => $request['uid'], 'sdate' => $request['sdate'], 'ds' => $di];
			if (isset($request['fio'])) $ds['patient'] = $request['fio'];
			Patient::upd_ds($id, $ds);
			return self::change($id);
		}
		else {
			$id = Patient::ins_ds(['uid' => $request['uid'], 'patient' => $request['fio'], 'sdate' => $request['sdate'], 'ds' => intval($di)]);
			return redirect('/page3/' . $id);
		}
	}

	public function dsdelete($id)
	{
		Patient::del_ds($id);
		return redirect('/page2');
	}

	public function dsclose($id)
	{
		$ds = Patient::get_ds($id);
		return view('close', [
			'pagetitle' => 'Страница закрытия случая',
			'patient' => Patient::get_patient($ds->patient),
			'di' => Patient::get_di(),
			'ds' => $ds,
		]);
	}

	public function dsclosesave($request, $id)
	{
		$request = $request->all();
		$di = $request['di'];
		if ($di == -1) {
			$di = Patient::ins_di(['text' => $request['newdi']]);
		}
		Patient::upd_ds($id, ['ds' => $di, 'fdate' => $request['fdate']]);
		return redirect('/page2');
	}
}
