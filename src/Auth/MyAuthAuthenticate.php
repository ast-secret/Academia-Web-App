<?php

namespace App\Auth;

use Cake\Auth\BaseAuthenticate;
use Cake\Network\Request;
use Cake\Network\response;
use Cake\ORM\TableRegistry;

class MyAuthAuthenticate extends BaseAuthenticate
{
	public function authenticate(Request $request, Response $response)
	{
		$gymId = $this->_getGymId($request->param('gym_slug'));

		$users = TableRegistry::get($this->_config['userModel']);

		$conditions = [];
		$conditions[] = [$users->aliasfield('gym_id') => $gymId];
		$conditions[] = [$users->aliasfield($this->_config['fields']['username']) => $request->data('username')];
		if ($this->_config['scope']) {
			$conditions[] = $this->_config['scope'];
		}

		$contain = [];
		if ($this->_config['contain']) {
			$contain = $this->_config['contain'];
		}

		$user = $users->find('all', [
			'contain' => $contain,
			'conditions' => $conditions
		])
		->first();

		if (!$user) {
			return false;
		}

		$hasher = $this->passwordHasher();

		if (!$hasher->check($request->data($this->_config['fields']['password']), $user->password)) {
			return false;
		}

		return $user->toArray();
	}

	protected function _getGymId($gymSlug)
	{
		$gyms = TableRegistry::get('Gyms');
		$gym = $gyms->find('all', [
			'fields' => ['Gyms.id'],
			'conditions' => [
				'Gyms.slug' => $gymSlug
			]
		])
		->first();

		return (int)$gym->id;
	}

}