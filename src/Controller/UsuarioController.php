<?php
namespace App\Controller;

use Cake\Event\Event;
use Cake\Auth\DefaultPasswordHasher;

class UsuarioController extends AppController
{
	public function beforeFilter(Event $event)
	{
		parent::beforeFilter($event);
		$this->Auth->allow(['logout']);
	}

	public function login()
	{
		$this->layout = 'signin';

		if ($this->request->is('post')) {

			$data = $this->Usuario->find()
    					->where(['usuario_login' => $this->request->data['usuario_login']])
    					->first();
    		if (is_null($data)) {
    			$this->Flash->error(__('Usuario o password incorrecto.'));
    			return $this->redirect($this->referer());
    		}

    		if ($data->tipo_usuario=='I'){

			} else if ($data->tipo_usuario=='E') {
        		$user = $this->Auth->identify();
        		if ($user) {

					$this->loadModel('Personal');

					$personal = $this->Personal->find()
									->where(['id' => $data->personal_id])
	    							->first();
	    			$this->request->session()->write('usuario.perfil', $data->perfil_id);
	    			$this->request->session()->write('usuario.sede',   $personal->sede_id);
	    			$this->request->session()->write('usuario.organigrama', $personal->organigrama_id);

	    			$this->Auth->setUser($user);
	    			return $this->redirect('/persona');

				}else{
					$this->Flash->error(__('Clave incorrecta.'));
				}

			}else{
				$this->Flash->error(__('Usted no posee cuenta de usuario.'));
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
			$this->request->data['usuario_creador'] = 'admin';
			$this->request->data['usuario_clave']=(new DefaultPasswordHasher)->hash($this->request->data['usuario_clave']);
			$usuario = $this->Usuario->newEntity($this->request->data);
			
			$hasher = new DefaultPasswordHasher();

			debug($usuario->usuario_clave);
			die();
			$persona = $this->Persona->newEntity();
			$personal = $this->Personal->newEntity();

			$this->request->data['persona_nombres'] = $this->request->data['persona_nombre'] . ' ' .$this->request->data['persona_apepat']. ' ' .$this->request->data['persona_apemat'];
			$persona = $this->Persona->patchEntity($persona, $this->request->data);

			if(!$this->Persona->save($persona)) {
				$this->Flash->error(__('Unable to add your enterprice.'));
			}

			$this->request->data['persona_id'] = $persona->id;
			$personal = $this->Personal->patchEntity($personal, $this->request->data);

			
			if(!$this->Personal->save($personal)) {
				$this->Flash->error(__('Unable to add your enterprice.'));
			}
			$this->request->data['tipo_usuario'] = 'E';
			$this->request->data['personal_id'] = $personal->id;
			

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
		$this->layout = 'signin';

		$usuario = $this->Usuario->newEntity();
		$this->loadModel('Tipodocumento');
		$this->loadModel('Cargo');
		$this->loadModel('Sede');
		$this->loadModel('Organigrama');

		$documentos = $this->Tipodocumento->find('list',  [
			'keyField' => 'id',
			'valueField' => 'tipodocumento_nombre'
		]);

		$cargos = $this->Cargo->find('list',  [
			'keyField' => 'id',
			'valueField' => 'cargo_nombre'
		]);

		$sedes = $this->Sede->find('list',  [
			'keyField' => 'id',
			'valueField' => 'sede_nombre'
		]);

		$organigramas = $this->Organigrama->find('list',  [
			'keyField' => 'id',
			'valueField' => 'organigrama_nombre'
		]);

		$cargos = $cargos->toArray();
		$sedes 	= $sedes->toArray();
		$organigramas = $organigramas->toArray();

		$this->set(compact('usuario', 'documentos', 'cargos','sedes','organigramas'));
	}

	public function logout()
    {
        return $this->redirect($this->Auth->logout());
    }
}