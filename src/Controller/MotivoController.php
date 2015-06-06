<?php
namespace App\Controller;
use Cake\Event\Event;

class MotivoController extends AppController
{
	public function index()
	{
		$title = 'Motivos';
		$titleP = 'Mantenimientos';
		$authUser = $this->Auth->user('usuario_login');

		$estados = $this->getDefaultCombosMantenimiento();
		$motivos = $this->Motivo->find();

		if (!empty($this->request->data['nombre_motivo'])) {			
			$motivos=$motivos->where( ['upper(motivo_descripcion) LIKE' => '%'.strtoupper($this->request->data['nombre_motivo']).'%' ] );
		}else{
			$this->request->data['nombre_motivo']='';
		}

		if (!empty($this->request->data['estado'])) {			
			$motivos=$motivos->where( ['estado' => $this->request->data['estado'] ] );
		}else{
			$this->request->data['estado']='';
		}

		$this->set('motivos', $this->paginate($motivos));	
		$motivos = $this->paginate($motivos);

		$valores=$this->request->data;
		
		$this->set(compact('motivos', 'authUser', 'title', 'titleP','valores','estados'));
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