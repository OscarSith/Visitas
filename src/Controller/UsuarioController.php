<?php
namespace App\Controller;

use Cake\Auth\DefaultPasswordHasher;
use Cake\Event\Event;

class UsuarioController extends AppController
{
	public function beforeFilter(Event $event)
	{
		parent::beforeFilter($event);
		// Allow users to register and logout.
		// You should not add the "login" action to allow list. Doing so would
		// cause problems with normal functioning of AuthComponent.
		$this->Auth->allow(['logout']);
	}

	public function login()
	{
		if ($this->request->is('post')) {
			$user = $this->Auth->identify();
			if ($user) {
				$this->Auth->setUser($user);
				return $this->redirect($this->Auth->redirectUrl());
			} else {
				$this->Flash->error(__('Username or password is incorrect'));
			}
		}
	}

	public function add()
	{
		$this->loadModel('Persona');
		$this->loadModel('Personal');

		if ($this->request->is('post')) {
			$this->request->data['perfil_id'] = 1;
			$this->request->data['fecha_creacion'] = date('Y-m-d H:i:s');
			$this->request->data['usuario_creador'] = 'Administrador';

			$persona = $this->Persona->newEntity();
			$personal = $this->Personal->newEntity();

			$this->request->data['persona_nombres'] = $this->request->data['persona_nombre'] . ' ' .$this->request->data['persona_apepat'];
			$persona = $this->Persona->patchEntity($persona, $this->request->data);
			if(!$this->Persona->save($persona)) {
				$this->Flash->error(__('Unable to add your enterprice.'));
			}

			$this->request->data['persona_id'] = $persona->id;
			$personal = $this->Personal->patchEntity($personal, $this->request->data);
			if(!$this->Personal->save($personal)) {
				$this->Flash->error(__('Unable to add your enterprice.'));
			}

			$this->request->data['personal_id'] = $personal->id;
			$hasher = new DefaultPasswordHasher();
			$this->request->data['usuario_clave'] = $hasher->hash($this->request->data['usuario_clave']);
			$usuario = $this->Usuario->newEntity($this->request->data);
			if(!$this->Usuario->save($usuario)) {
				$this->Flash->error(__('Unable to add your enterprice.'));
			}

			$this->Flash->success(__('Usuario agregado con exito.'));
            return $this->redirect(['action' => 'login']);
		}
		return $this->redirect(['action' => 'registrar']);
	}

	public function registrar()
	{
		$usuario = $this->Usuario->newEntity();
		$this->loadModel('Tipodocumento');
		$this->loadModel('Cargo');

		$documentos = $this->Tipodocumento->find('list',  [
			'keyField' => 'id',
			'valueField' => 'tipodocumento_nombre'
		]);

		$cargos = $this->Cargo->find('list',  [
			'keyField' => 'id',
			'valueField' => 'cargo_nombre'
		]);

		$cargos = $cargos->toArray();

		$this->set(compact('usuario', 'documentos', 'cargos'));
	}

	public function logout()
    {
        return $this->redirect($this->Auth->logout());
    }
}