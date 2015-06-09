<?php
namespace App\Controller;
use Cake\Event\Event;

class MotivoController extends AppController
{
	
	public $paginate = [
		'limit' => 5
	];

    public function initialize()
    {
        parent::initialize();
        $this->loadComponent('Paginator');
    }

	public function beforeFilter(Event $event)
	{
		parent::beforeFilter($event);
	}

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

		$titleP = 'Mantenimiento';
		$title = 'Motivo';
		$authUser = $this->Auth->user('usuario_login');

		$this->set(compact('motivo','title','titleP','authUser'));
	}

	public function add()
	{
		if ($this->request->is('post')) {

			$this->request->data['usuario_creador'] = $this->Auth->user('usuario_login');
			
			$motivo = $this->Motivo->newEntity($this->request->data);
			$this->Motivo->save($motivo);

			return $this->redirect(['action' => 'index']);
		}	
	}

	public function editar()
	{
		$this->loadModel('Motivo');
		
		
		$this->request->data['usuario_actualiza'] = $this->Auth->user('usuario_login');
		
		$this->Motivo->query()->update()
					->set(['usuario_actualiza' => $this->request->data['usuario_actualiza']])
					->set(['motivo_descripcion' => $this->request->data['motivo_descripcion']])
					->set(['motivo_color' => $this->request->data['motivo_color']])
					->where(['id' => $this->request->data['id']])
					->execute();

		return $this->redirect($this->referer());
			
	}	

}