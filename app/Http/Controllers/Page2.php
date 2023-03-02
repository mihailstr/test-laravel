<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Patient;

class Page2 extends Controller
{
    public function __invoke(Request $request)
    {
		return view('page1', [
			'pagetitle' => 'Страница со списком случаев',
			'menuitems' => array('', 'UID', 'Пациент', 'Диагноз', 'Дата открытия', 'Дата закрытия', '', '', ''),
			'items' => Patient::get_ds_di(),
			'view' => true,
		]);
    }
}
