<?php

namespace App\View\Helper;

use Cake\View\Helper;

class TextBootstrapHelper extends Helper
{

	public function labelBoolean($value, $trueLabel, $falseLabel)
	{
		if ($value) {
			return '<span class="label label-success">'.$trueLabel.'</span>';
		} else {
			return '<span class="label label-success">'.$falseLabel.'</span>';
		}
	}

}