<?php
namespace App\Controller;

use Cake\Event\Event;
use Cake\Auth\DefaultPasswordHasher;
use Cake\Routing\Router;
use Cake\Validation\Validator;

class UsuarioController extends AppController
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
		$this->Auth->allow(['logout']);
	}

	public function index()
	{
		$title = 'Usuarios';

		$titleP = 'Mantenimientos';

		$authUser = $this->Auth->user('usuario_login');
		$estados = $this->getDefaultCombosMantenimiento();

		$usuarios = $this->Usuario->find()
					->select(['id', 'usuario_creador', 'usuario_login', 'p.persona_nombres', 'p.documento_numero', 'estado', 'tipo_usuario'])
					->join([
						'table' => 'Persona',
						'alias' => 'p',
						'type' => 'inner',
						'conditions' => 'p.id = usuario.persona_id'
					])
					->innerJoin(
						['pl' => 'Personal'], ['p.id = pl.persona_id']
					);

		if (!empty($this->request->data['login_usuario'])) {
			$usuarios=$usuarios->where( ['usuario.usuario_login LIKE' => '%'.$this->request->data['login_usuario'].'%' ] );
		}else{
			$this->request->data['login_usuario']='';
		}

		if (!empty($this->request->data['nombre_usuario'])) {
			$usuarios=$usuarios->where( ['upper(p.persona_nombres) LIKE' => '%'.strtoupper($this->request->data['nombre_usuario']).'%' ] );
		}else{
			$this->request->data['nombre_usuario']='';
		}

		if (!empty($this->request->data['estado'])) {
			$usuarios=$usuarios->where( ['usuario.estado' => $this->request->data['estado'] ] );
		}else{
			$this->request->data['estado']='';
		}

		$usuarios = $this->paginate($usuarios);
		$valores=$this->request->data;

		$this->set(compact('usuarios', 'title','titleP', 'authUser','valores','estados'));
	}

	public function login()
	{
		$this->layout = 'signin';

		if ($this->request->is('post')) {

			if (empty($this->request->data['usuario_login']) || empty($this->request->data['usuario_clave'])) {
				$this->Flash->error('El nombre usuario y la contraseña son requeridos');
				return $this->redirect($this->referer());
			}

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
									->where(['persona_id' => $data->persona_id])
	    							->first();
	    			$this->request->session()->write('usuario.perfil', $data->perfil_id);
	    			$this->request->session()->write('usuario.sede',   $personal->sede_id);
	    			
	    			$this->Auth->setUser($user);
	    			if ( $data->perfil_id != 2) {
	    				
	    				$this->request->session()->write('usuario.organigrama', $personal->organigrama_id);
	    				return $this->redirect('/dashboard');
	    			}else {

	    				$this->request->session()->write('usuario.organigrama', 1);
	    				return $this->redirect('/persona');
	    			}
	    			
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
			$validator = new Validator();

			$validator
			    ->notEmpty('persona_nombre', 'Mensaje personalizado')
			    ->notEmpty('persona_apepat')
		        ->notEmpty('persona_apemat')
		        ->notEmpty('tipodocumento_id')
		        ->notEmpty('documento_numero')
		        ->notEmpty('organigrama_id')
		        ->notEmpty('perfil_id')
		        ->notEmpty('cargo_id')
		        ->notEmpty('sede_id')
		        ->notEmpty('usuario_login')
		        // no funciona
		  		//	->add('usuario_login', [
				//     'unique' => ['rule' => 'validateUnique', 'provider' => 'usuario']
				// ])
				->notEmpty('usuario_clave');

			$errors = $validator->errors($this->request->data());

			if (!empty($errors)) {
				$this->set('registrar', compact('errors'));
				$this->Flash->error($errors);
				return $this->redirect($this->referer());
			} else {
				$this->request->data['perfil_id'] = 1;
				$this->request->data['usuario_creador'] = $this->Auth->user('usuario_login');

				$persona = $this->Persona->newEntity();

				$this->request->data['persona_nombres'] = $this->request->data['persona_nombre'] . ' ' .$this->request->data['persona_apepat']. ' ' .$this->request->data['persona_apemat'];
				$persona = $this->Persona->patchEntity($persona, $this->request->data);

				if(!$this->Persona->save($persona)) {
					$this->Flash->error(__('Unable to add your enterprice.'));
				}

				$personal = $this->Personal->newEntity();
				$this->request->data['persona_id'] = $persona->id;
				$personal = $this->Personal->patchEntity($personal, $this->request->data);

				if(!$this->Personal->save($personal)) {
					$this->Flash->error(__('Unable to add your enterprice.'));
				}

				$this->Flash->success(__('Usuario agregado con exito.'));
	            return $this->redirect(['action' => 'index']);
			}
		}
		// return $this->redirect(['action' => 'registrar']);
	}

	public function registrar()
	{

		$usuario = $this->Usuario->newEntity();
		list($documentos, $cargos, $sedes, $organigramas) = $this->getDefaultCombosUsuario();
		$perfiles = $this->getDefaultComboPerfil();

		$title = 'Nuevo Usuario';

		$titleP = 'Mantenimientos';
		$authUser = $this->Auth->user('usuario_login');
		$route = Router::getRequest()->params['action'];

		$this->set(compact('usuario', 'documentos', 'cargos', 'sedes', 'organigramas', 'perfiles','title','titleP','authUser', 'route'));
	}

	public function edit($id)
	{
		$usuario = $this->Usuario->find()
					->select(['id', 'usuario_login', 'personal_id', 'p.persona_nombre', 'p.persona_apepat', 'p.persona_apemat', 'p.documento_numero', 'p.tipodocumento_id', 'pl.cargo_id', 'pl.sede_id', 'pl.organigrama_id','perfil_id'])
					->join([
						'table' => 'Personal',
						'alias' => 'pl',
						'type' => 'inner',
						'conditions' => 'pl.id = usuario.personal_id'
					])
					->innerJoin(
						['p' => 'Persona'], ['p.id = pl.persona_id']
					)
					->where(['usuario.id' => $id])
					->first();

		// Para llenar el form usando solo la entidad
		$usuario->set('persona_nombre', $usuario->p['persona_nombre']);
		$usuario->set('persona_apepat', $usuario->p['persona_apepat']);
		$usuario->set('persona_apemat', $usuario->p['persona_apemat']);
		$usuario->set('documento_numero', $usuario->p['documento_numero']);
		$usuario->set('tipodocumento_id', $usuario->p['tipodocumento_id']);
		$usuario->set('perfil_id', $usuario->perfil_id);
		$usuario->set('cargo_id', $usuario->pl['cargo_id']);
		$usuario->set('sede_id', $usuario->pl['sede_id']);
		$usuario->set('organigrama_id', $usuario->pl['organigrama_id']);

		$title = 'Editar Usuario';

		$titleP = 'Mantenimientos';
		$authUser = $this->Auth->user('usuario_login');
		$route = Router::getRequest()->params['action'];

		list($documentos, $cargos, $sedes, $organigramas) = $this->getDefaultCombosUsuario();
		$perfiles = $this->getDefaultComboPerfil();

		$this->set(compact('usuario', 'documentos', 'cargos', 'sedes', 'organigramas', 'perfiles','usuario', 'title', 'titleP','authUser', 'route'));
	}

	public function update($id)
	{
		$this->request->data['usuario_actualiza'] = $this->Auth->user('usuario_login');

		$this->loadModel('Personal');
		$this->loadModel('Persona');
		// Obtengo el id de personal y la persona_id
		$personalData = $this->Personal->find()->select(['id', 'persona_id'])->where(['id' => $this->request->data['personal_id']])->first();

		// Actualiza Tabla Usuario
		$this->Usuario->query()->update()
			->set(['usuario_login' => $this->request->data['usuario_login']])
			->set(['perfil_id' => $this->request->data['perfil_id']])
			->where(['id' => $id])
			->execute();

		// Actualiza tabla personal
		$this->Personal->query()->update()
			->set(['cargo_id' => $this->request->data['cargo_id']])
			->set(['sede_id' => $this->request->data['sede_id']])
			->set(['organigrama_id' => $this->request->data['organigrama_id']])
			->set(['usuario_actualiza' => $this->request->data['usuario_actualiza']])
			->where(['id' => $personalData->id])
			->execute();

		// Actualiza tabla persona
		$this->Persona->query()->update()
			->set(['persona_nombre' => $this->request->data['persona_nombre']])
			->set(['persona_apepat' => $this->request->data['persona_apepat']])
			->set(['persona_apemat' => $this->request->data['persona_apemat']])
			->set(['persona_nombres' => $this->request->data['persona_nombre'] . ' ' . $this->request->data['persona_apepat'] . ' ' . $this->request->data['persona_apemat']])
			->set(['tipodocumento_id' => $this->request->data['tipodocumento_id']])
			->set(['documento_numero' => $this->request->data['documento_numero']])
			->set(['usuario_actualiza' => $this->request->data['usuario_actualiza']])
			->where(['id' => $personalData->persona_id])
			->execute();

		$this->Flash->success('Usuario Editado exitosamente.');
		return $this->redirect(['action' => 'index']);
	}

	public function addUserCredentials()
	{
		$this->request->data['tipo_usuario'] = 'E';
		$this->request->data['perfil_id'] = 1;
		$this->request->data['usuario_creador'] = $this->Auth->user('usuario_login');
		$this->request->data['usuario_clave'] = ( new DefaultPasswordHasher )->hash($this->request->data['usuario_clave']);
		$usuario = $this->Usuario->newEntity($this->request->data);
		if(!$this->Usuario->save($usuario)) {
			$this->Flash->error(__('Unable to add your enterprice.'));
		} else {
			$this->Flash->success('Credenciales agregadas al usuario');
		}

		return $this->redirect($this->referer());
	}

	public function logout()
    {
        return $this->redirect($this->Auth->logout());
    }
}