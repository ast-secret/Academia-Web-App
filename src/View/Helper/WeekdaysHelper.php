<?php

namespace App\View\Helper;

use Cake\View\Helper;

class WeekdaysHelper extends Helper
{

	// private $values = [
	// 	[
	// 		'id' => 1,
	// 		'name' => 'Domingo',
	// 		'short' => 'Seg'
	// 	],
	// 	[
	// 		'id' => 2,
	// 		'name' => 'Segunda-feira',
	// 		'short' => 'Seg'
	// 	],
	// 	[
	// 		'id' => 3,
	// 		'name' => 'Terça-feira',
	// 		'short' => 'Ter'
	// 	],
	// 	[
	// 		'id' => 4,
	// 		'name' => 'Quarta-feira',
	// 		'short' => 'Qua'
	// 	],
	// 	[
	// 		'id' => 5,
	// 		'name' => 'Quinta-feira',
	// 		'short' => 'Qui'
	// 	],
	// 	[
	// 		'id' => 6,
	// 		'name' => 'Sexta-feira',
	// 		'short' => 'Sex'
	// 	],
	// 	[
	// 		'id' => 7,
	// 		'name' => 'Sabado',
	// 		'short' => 'Sab'
	// 	],
	// ];

	public function getById($id, $weekdays)
	{
		foreach ($weekdays->toArray() as $key => $value) {
			if ($key == $id) {
				return $value;
			}
		}
	}

}