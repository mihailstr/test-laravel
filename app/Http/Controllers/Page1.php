<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Patient;

class Page1 extends Controller
{
    public function __invoke(Request $request)
    {
		return view('page1', [
			'pagetitle' => 'Страница со списком пациентов',
			'menuitems' => array('', 'ФИО', 'Пол', 'дата_рождения', 'дата_смерти'),
			'items' => Patient::get_list(),
			'view' => false,
		]);
    }
}
