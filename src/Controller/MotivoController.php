<?php
namespace App\Controller;
use Cake\Event\Event;

class MotivoController extends AppController
{
	public function index()
	{
		
		$motivos = $this->Motivo
						->find();

		$this->set('motivos', $this->paginate($motivos));	
		
		$authUser = $this->Auth->user('usuario_login');
		$motivos = $this->paginate($motivos);
		$title = 'Listado de motivos';

		$this->set(compact('motivos', 'authUser', 'title'));
	}

	public function registrar(){
		$motivo = $this->Motivo->newEntity();

		$title = 'Mantenimiento de Visitas';
		$authUser = $this->Auth->user('usuario_login');

		$this->set(compact('motivo','title','authUser'));
	}

	public function add()
	{
		if ($this->request->is('post')) {

			$this->request->data['usuario_creador'] = 'admin';
			
			$motivo = $this->Motivo->newEntity($this->request->data);
			$this->Motivo->save($motivo);

			return $this->redirect(['action' => 'index']);
		}	
	}	

}