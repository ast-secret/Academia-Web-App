<?php

namespace App\Controller;

use App\Controller\AppController;
use Cake\Exceptions\NotFoundException;
use Cake\Event\Event;
use Cake\Core\Configure;

use Sly\NotificationPusher\PushManager,
    Sly\NotificationPusher\Adapter\Gcm as GcmAdapter,
    Sly\NotificationPusher\Collection\DeviceCollection,
    Sly\NotificationPusher\Model\Device,
    Sly\NotificationPusher\Model\Message,
    Sly\NotificationPusher\Model\Push
;

class PushNotificationController extends AppController
{

	protected $_pushManager;
	protected $_gcmAdapter;

	public function beforeFilter(Event $event)
	{
		parent::beforeFilter($event);

		$gcmConfig = Configure::read('GoogleGCM');

		$this->_pushManager = new PushManager(PushManager::ENVIRONMENT_DEV);

		$this->_gcmAdapter = new GcmAdapter(array(
		    'apiKey' => $gcmConfig['apiKey'],
		));
	}

	public function releases()
	{
		$response = ['message' => 'ok', 'code' => 200];

		$this->loadModel('Releases');
		$id = $this->request->data('id');

		if (!$id) {
			throw new NotFoundException();
		}

		$release = $this->Releases->get($id);

		$devices = $this->_getAllDevices();

		$message = new Message($release->title, [
			'title' => 'Novo comunicado'
		]);
		
		if ($devices['android']) {
			$push = new Push($this->_gcmAdapter, $devices['android'], $message);
			$this->_pushManager->add($push);
			try {
				$this->_pushManager->push();	
			} catch (Exception $e) {
				$response = ['message' => $e->getMessage(), 'code' => 400];
			}
		}

		
		$this->set(compact('response'));
		$this->set('_serialize', ['response']);
	}
	protected function _getAllDevices()
	{
		$this->loadModel('RegIds');

		$gymId = $this->Auth->user('gym_id');

		$regIds = $this->RegIds->getAllByGymId($gymId);

		$devices = [];
		$devices['android'] = [];
		$devices ['ios'] = [];
		$android = [];
		$ios = [];

		foreach ($regIds as $regId) {
			if (strtolower($regId->platform) == 'android') {
				$android[] = new Device($regId->device_regid);
			} elseif(strtolower($regId->platform) == 'ios') {
				$ios[] = new Device($regId->device_regid);
			}
		}

		$regIdsByPlatform['android'] = new DeviceCollection($android);
		$regIdsByPlatform['ios'] = new DeviceCollection($ios);

		return $regIdsByPlatform;

	}

}