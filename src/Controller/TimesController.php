<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Times Controller
 *
 * @property \App\Model\Table\TimesTable $Times */
class TimesController extends AppController
{
    public function edit($service_id = null)
    {
        $service = $this->Times->Services->get($service_id, ['contain' => 'Times']);
        if ($this->request->is(['patch', 'post', 'put'])) {
            
            $service = $this->Times->Services->patchEntity($service, $this->request->data);

            if ($this->Times->Services->save($service)) {
                $this->Flash->success('Os horários foram salvos com sucesso.');
                return $this->redirect(['controller' => 'Services', 'action' => 'index']);
            } else {
                $this->Flash->error('Os horários não foram salvos, por favor tente novamente.');    
            }
        }
        
        $this->set(compact('service'));
    }
}
