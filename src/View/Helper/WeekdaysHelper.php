<?php

namespace App\View\Helper;

use Cake\View\Helper;

class WeekdaysHelper extends Helper
{

	private $weekdays = [
		[
			'id' => 0,
			'name' => 'Domingo',
		],
		[
			'id' => 1,
			'name' => 'Segunda-feira',
		],
		[
			'id' => 2,
			'name' => 'Terça-feira',
		],
		[
			'id' => 3,
			'name' => 'Quarta-feira',
		],
		[
			'id' => 4,
			'name' => 'Quinta-feira',
		],
		[
			'id' => 5,
			'name' => 'Sexta-feira',
		],
		[
			'id' => 6,
			'name' => 'Sábado',
		],
	];

	public function getAll()
	{
		return $this->weekdays;
	}
	public function getById($id)
	{
		foreach ($this->weekdays as $key => $value) {
			if ($key == $id) {
				return $value['name'];
			}
		}
	}

}