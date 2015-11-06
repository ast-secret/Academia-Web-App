<?php

namespace App\Model\Behavior;

use Cake\ORM\Behavior;
use Cake\ORM\Entity;
use Cake\Event\Event;

class NormalizeFullnameBehavior extends Behavior
{
	public function normalize($value)
	{
        $names = explode(' ', trim($value));
        $name = [];

        foreach ($names as $value) {
            if (strtolower($value) != 'de' && strtolower($value) != 'da') {
                $name[] = ucfirst(strtolower($value));
            } else {
                $name[] = strtolower($value);
            }
        }
        return join($name, ' ');
	}
	public function beforeSave(Event $event, Entity $entity)
    {
    	foreach ($this->_config['fields'] as $field) {
    		$value = $entity->get($field);
    		if ($value) {
    			$entity->set($field, $this->normalize($value));
    		}
    	}
    }
}