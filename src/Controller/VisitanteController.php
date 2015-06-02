<?php namespace App\Controller;

use Cake\Event\Event;
use Cake\ORM\TableRegistry;

class VisitanteController extends AppController
{
	public function beforeFilter(Event $event)
	{
		parent::beforeFilter($event);
	}

	public function removeVisitante()
	{
		if($this->request->is('put'))
		{
			$this->loadModel('Visitavisitante');
			$this->Visitavisitante->query()->update()->set(['estado' => 'A'])->where(['id' => $this->request->data['id']])->execute();
			$this->Flash->success(__('Visitante eliminado'));
			return $this->redirect($this->referer());
		}

		$this->redirect($this->referer());
	}
}