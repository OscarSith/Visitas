<?php
namespace App\Controller;

use Cake\Event\Event;

class PersonaController extends AppController
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
		$this->loadModel('Visitante');
		list($lugares, $motivos, $documentos, $cargos, $organigramas) = $this->getDefaultCombos();

		$persona = $this->Persona->newEntity();

		$title = 'Registro de Visitas';
		$titleP = 'Visitas';
		$authUser = $this->Auth->user('usuario_login');

		$this->set(compact('persona', 'lugares', 'motivos', 'documentos', 'cargos', 'title','titleP', 'authUser', 'organigramas'));
	}

	public function registrarVisita()
	{
		$this->loadModel('Personal');
		$this->loadModel('Visita');
		$this->loadModel('Visitavisitante');

		debug($this->request->data);

		if ($this->request->is('post')) {

			if (empty($this->request->data['visitante_id'])) {
				$this->Flash->error(__('Debe agregar al menos un visitante.'));
				return $this->redirect(['action' => 'index']);
			}

			$this->request->data['fecha_creacion'] = date('Y-m-d');
			$this->request->data['usuario_creador'] = $this->Auth->user('usuario_login');
			$this->request->data['visita_fecha'] = $this->request->data['visita_fecha'];
			$this->request->data['visita_horaprogramada'] = date('H:i:s');
			$this->request->data['persona_nombres'] = $this->request->data['persona_nombre'] . ' ' . $this->request->data['persona_apepat'];

			if (empty($this->request->data['personal_id']) || $this->request->data['personal_id'] == '') {
				$this->request->data['sede_id'] = 1;
				$persona = $this->Persona->newEntity($this->request->data);
				$this->Persona->save($persona);

				$this->request->data['persona_id'] = $persona->id;
				$personal = $this->Personal->newEntity($this->request->data);
				$this->Personal->save($personal);
				$this->request->data['personal_id'] = $personal->id;
			}
			$visita = $this->Visita->newEntity($this->request->data);

			$this->Visita->save($visita);
			$this->request->data['visita_id'] = $visita->id;
			$visitantes_id = $this->request->data['visitante_id'];
			foreach ($visitantes_id as $key) {
				$this->request->data['visitante_id'] = $key;
				$visitavisitante = $this->Visitavisitante->newEntity($this->request->data);
				$this->Visitavisitante->save($visitavisitante);
			}
			$this->Flash->success(__('Visita agregada con exito.'));
		} else {
			$this->Flash->error(__('Petición no encontrada'));
		}
        return $this->redirect(['action' => 'index']);
	}

	public function registrarVisitante()
	{
		if ($this->request->is('ajax')) {
			
			$this->loadComponent('RequestHandler');
			$this->loadModel('Visitante');
			$this->request->data['usuario_creador'] = 'Admin';
			$nombre=$this->request->data['persona_nombre'];
			$apellido=$this->request->data['persona_apepat']. ' ' . $this->request->data['persona_apemat'];


			if (empty($this->request->data['persona_id'])) {
			
				$this->request->data['persona_nombres'] = $nombre;
				$this->request->data['tipo_persona'] = 'N';
				$persona = $this->Persona->newEntity($this->request->data);
				$this->Persona->save($persona);

				$this->request->data['persona_id'] = $persona->id;
			}	

			if (empty($this->request->data['visitante_id']) ) {

				$visitante = $this->Visitante->newEntity($this->request->data);
				$this->Visitante->save($visitante);

				$this->request->data['visitante_id'] = $visitante->id;				
			}
			
			if ( empty($this->request->data['empresa_id']) ){
				if ( !empty($this->request->data['empresa_nombre']) && !empty($this->request->data['ruc_numero']) ){
						$this->loadModel('Empresa');						
						$this->request->data['tipodocumento_id'] = 3;
						$this->request->data['persona_nombres'] = $this->request->data['empresa_nombre'];
						$this->request->data['documento_numero'] = $this->request->data['ruc_numero'];
						$this->request->data['tipo_persona'] = 'J';

						$this->request->data['persona_apepat'] = null;
						$this->request->data['persona_apemat'] = null;
						$this->request->data['persona_nombre'] = null;

						$persona = $this->Persona->newEntity($this->request->data);
						$this->Persona->save($persona);
						$this->request->data['persona_id'] = $persona->id;

						$empresa = $this->Empresa->newEntity($this->request->data);
						$this->Empresa->save($empresa);

						$this->request->data['empresa_id'] = $empresa->id;
				}

			}
			
			if( empty($this->request->data['empresavisitante_id']) ){
				if(!empty( $this->request->data['empresa_id']) ){
					$this->loadModel('Empresavisitantes');
					$empresavisitantes = $this->Empresavisitantes->newEntity($this->request->data);
					$this->Empresavisitantes->save($empresavisitantes);		
				} 				
			}


			
			$data = json_encode([
				'id' => $this->request->data['visitante_id'],
				'documento_numero' => $this->request->data['documento_numero'],
				'persona_nombre' => $nombre,
				'persona_apellidos' => $apellido
			]);

			$this->autoRender = false;
			echo $data;
		}else {
			throw new BadRequestException();
		}
	}

	public function visitas()
	{
		$this->loadModel('Personal');
		$this->loadModel('Visitavisitante');
		$this->loadModel('Visita');
		$this->loadModel('Visitante');
		$visitas = $this->Visita->find()
			->select(['id', 'vv.id', 'pr.persona_nombres', 'pe.persona_nombres', 'visita_fecha', 'visita_horaprogramada','vv.estado','vv.visita_horaingreso','vv.visita_horasalida'])
			->innerJoin(
				['vv' => 'Visitavisitante'],
				['visita.id = vv.visita_id']
			)
			->innerJoin(
				['vi' => 'Visitante'],
				['vv.visitante_id = vi.id']
			)
			->innerJoin(
				['pe' => 'Persona'],
				['vi.persona_id = pe.id']
			)
			->innerJoin(
				['pl' => 'Personal'],
				['visita.personal_id = pl.id']
			)
			->innerJoin(
				['pr' => 'Persona'],
				['pl.persona_id = pr.id']
			);

		if (!empty($this->request->data['visita_fecha']) && !empty($this->request->data['visita_fechaF'])) {
			
			$visitas=$visitas->where(function ($exp, $q) {
        		return $exp->between('visita_date',$this->request->data['visita_fecha'],$this->request->data['visita_fechaF']);
    		});
		}else{
			$this->request->data['visita_fecha']="";
			$this->request->data['visita_fechaF']="";
		}

		if (!empty($this->request->data['visita_personal'])) {
			$visitas=$visitas->where(['pr.persona_nombres LIKE' => '%'.$this->request->data['visita_personal'].'%']);
		}else{
			$this->request->data['visita_personal']="";
		}

		$this->set('visitas', $this->paginate($visitas));
		
		$authUser = $this->Auth->user('usuario_login');
		$visitas = $this->paginate($visitas);
		$title = 'Listado de visitas';
		$titleP = 'Visitas';

		$visitavisitante = $this->Visitavisitante->newEntity();
		$valores=$this->request->data;

		$this->set(compact('visitas', 'authUser', 'title','titleP','visitavisitante','valores'));
	}

	public function search()
	{
		$data = $this->Persona
				->find()
				->select(['data' => 'p.id', 'value' => 'persona_nombres'])
				->join([
					'p' => [
						'table' => 'personal',
						'type' => 'inner',
						'conditions' => 'persona.id = p.persona_id'
					]
				])
				->where(['upper(persona_nombres) LIKE' => '%'. strtoupper($this->request->query['query']) .'%']);

		$this->toJson($data, true);
	}

	public function show($id)
	{
		$data = $this->Persona
				->find()
				->select(['p.id', 'persona_nombre', 'persona_apepat', 'persona_apemat', 'persona_nombres', 'tipodocumento_id', 'documento_numero', 'p.cargo_id','p.organigrama_id'])
				->join([
					'p' => [
						'table' => 'personal',
						'type' => 'inner',
						'conditions' => 'persona.id = p.persona_id'
					]
				])
				->where(['p.id = ' => $id])
				->first();

		$this->toJson($data);
	}

	public function showByVisitanteId($id)
	{
		$this->loadModel('Empresavisitantes');
		$data = $this->Persona
				->find()
				->select(['v.id', 'id', 'persona_nombre', 'persona_apepat', 'persona_apemat', 'persona_nombres', 'tipodocumento_id', 'documento_numero'])
				->leftJoin(
					['v' => 'visitante'],
					['persona.id = v.persona_id']
				)
				->where(['persona.id = ' => $id])
				->first();

		if( !empty( $data->v['id'] ) ){

			$data2 = $this->Empresavisitantes
				->find()
				->select(['id', 'empresa_id', 'p.persona_nombres', 'p.documento_numero'])
				->innerJoin(
					['e' => 'empresa'],
					['empresavisitantes.empresa_id = e.id']
				)
				->innerJoin(
					['p' => 'persona'],
					['p.id = e.persona_id']
				)
				->where(['visitante_id =' => $data->v['id'] ])
				->first();
		}else{
			$data2 = $this->Empresavisitantes;
		}
		$this->toJson($data, false, $data2, true);
	}

	public function showByEmpresaID($id)
	{
		$this->loadModel('Empresa');
		$data = $this->Empresa->find()
			->select(['id','p.persona_nombres','p.documento_numero'])
			->innerJoin(
				['p' => 'persona'],
				['empresa.persona_id = p.id']
			)
			->where(['empresa.id' => $id])
			->first();

		$this->toJson($data, false, null, true);

	}

	public function searchByDni()
	{
		$data = $this->Persona
				->find()
				->select(['data' => 'id', 'value' => 'persona_nombres'])
				->where(['documento_numero LIKE' => '%'.$this->request->query['query'].'%']);
			// debug($data);
		$this->toJson($data, true);
	}

	public function searchByRuc()
	{
		$this->loadModel('Empresa');
		$data = $this->Empresa->find()
			->select(['data' => 'empresa.id', 'value' => 'p.persona_nombres'])
			->innerJoin(
				['p' => 'persona'],
				['empresa.persona_id = p.id']
			)
			->where(['p.documento_numero LIKE ' => '%'.$this->request->query['query'].'%']);

		$this->toJson($data, true);
	}

	private function toJson($data, $auto = false, $data2 = null, $flag = false)
	{
		if ($auto) {
			$data = json_encode([
				'suggestions' => $data->toArray(),
				'query' => $this->request->query['query']
			]);
		} else {
			$values = $data;

			if ($flag) {
				$values = ['persona' => $data, 'empresa' => []];
				if (!is_null($data2)) {
					$values['empresa'] = $data2;
				}
			}
			$data = json_encode($values);
		}

		$this->autoRender = false;
		echo $data;
	}

	public function getOrganigramaByPadre($id)
	{
		$this->loadModel('Organigrama');
		$data = $this->Organigrama->find()->where(['padre_id' => $id]);
		$this->autoRender = false;
		echo json_encode($data);
	}


	public function registrarHoraInreso()
	{
		if ($this->request->is('post')) {
			$this->loadModel('Visitavisitante');

			if (!empty($this->request->data['id'])) {
				
				$visitante = $this->Visitavisitante->query()
								->update()
								->set(['visita_horaingreso' => $this->request->data['visita_horaingreso']])
								->set(['estado'=>'D'])								
								->where(['id' => $this->request->data['id']])
								->execute();
				
				$this->Flash->success(__('Visitante registrado con éxito.'));
			}
			return $this->redirect($this->referer());
		} 
	}

	public function registrarHoraSalida()
	{
		if ($this->request->is('post')) {
			$this->loadModel('Visitavisitante');

			if (!empty($this->request->data['id'])) {
				
				$visitante = $this->Visitavisitante->query()
								->update()
								->set(['visita_horasalida' => $this->request->data['visita_horasalida']])
								->set(['estado'=>'F'])
								->where(['id' => $this->request->data['id']])
								->execute();
				
				$this->Flash->success(__('Visitante registrado con éxito.'));
			}
			return $this->redirect($this->referer());
		}
	}

	public function getVisitas()
	{
		
		$this->loadModel('Personal');
		$this->loadModel('Visitavisitante');
		$this->loadModel('Visita');
		$this->loadModel('Visitante');

		$visitas = $this->Visita->find()
			->select(['id','vv.id', 'pr.persona_nombres', 'pe.persona_nombres', 'visita_fecha', 'visita_horaprogramada','vv.estado','vv.visita_horaingreso','vv.visita_horasalida'])
			->innerJoin(
				['vv' => 'Visitavisitante'],
				['visita.id = vv.visita_id']
			)
			->innerJoin(
				['vi' => 'Visitante'],
				['vv.visitante_id = vi.id']
			)
			->innerJoin(
				['pe' => 'Persona'],
				['vi.persona_id = pe.id']
			)
			->innerJoin(
				['pl' => 'Personal'],
				['visita.personal_id = pl.id']
			)
			->innerJoin(
				['pr' => 'Persona'],
				['pl.persona_id = pr.id']
			);

		$this->autoRender = false;
		$a = array();
		
		foreach ($visitas as $key){

			list($dia, $mes, $anio) = split('[/.-]', $key->visita_fecha);
			list($hora, $minuto)     = split(':', $key->visita_horaprogramada);
			list($min, $tipo) =split(' ', $minuto);
			$hora_i;
			$hora_f;
			if( $tipo=='PM' ){
				$hora_i=($hora+12).':'.$min.':00';
				$hora_f=($hora+12+2).':'.$min.':00';
			}else{
				$hora_i=($hora).':'.$min.':00';
				$hora_f=($hora+2).':'.$min.':00';
			}
			
			array_push( $a, array('title'=> 'Visita para '.$key->pr['persona_nombres'].' de '.$key->pe['persona_nombres'],
								  'start'=> $anio.'-'.$mes.'-'.$dia.' '.$hora_i,
								  'end'  => $anio.'-'.$mes.'-'.$dia.' '.$hora_f,
								  'allDay'=>false,
								  'url'   =>'/visita-edit/'.$key->id,
								  'color' => $this->random_color()
								));
		}
		
		$this->request->accepts('application/json');
		echo json_encode($a);
	}

	public function verCalendario()
	{
		$titleP = 'Calendario de Visitas';
		$title = '';
		$authUser = $this->Auth->user('usuario_login');
		

		$this->set(compact('title','titleP',  'authUser'));
	}

	public function anularvisita()
	{
		$this->loadComponent('RequestHandler');
		$this->loadModel('Visitavisitante');

		if (!empty($this->request->data['id'])) {
			$visitante = $this->Visitavisitante->query()
							->update()
							->set(['estado'=>'A'])
							->where(['id' => $this->request->data['id']])
							->execute();
			$this->Flash->success('Se anuló la visita exitosamente');
		} else {
			$this->Flash->error('Los datos enviados son incorrectos.');
		}
		$this->redirect($this->referer());
	}

	public function activarvisita()
	{				
		if ($this->request->is('ajax')) {
			$this->loadComponent('RequestHandler');
			$this->loadModel('Visitavisitante');
			$data;
			if (!empty($this->request->data['id'])) {
				$visitante = $this->Visitavisitante->query()
								->update()
								->set(['estado'=>'R'])
								->where(['id' => $this->request->data['id']])
								->execute();
				
				$data = json_encode(['mensaje' => 'Se activó la visita.']);	
				$this->autoRender = false;				
			}else{
				
				$data = json_encode(['mensaje' => 'Los datos enviados son incorrectos.']);	
				$this->autoRender = false;				
			}			

			echo $data;	

		}else {
			throw new BadRequestException();
		}	
	}

	public function probandoconsulta($id=null,$query=null){
		$this->loadModel('Empresa');
		$data = $this->Empresa->find()
			->select(['data' => 'empresa.id', 'value' => 'p.persona_nombres'])
			->innerJoin(
				['p' => 'persona'],
				['empresa.persona_id = p.id']
			);
			if ( $query != null ) {
				$data=$data->where(['p.documento_numero LIKE ' => '%'.$query.'%']);
			}
			if( $id != null ){
				$data=$data->where(['id' => $id]);
			}
			debug($data);
			die();
	}

	public function random_color() {
    	return '#' . str_pad(dechex(mt_rand(0, 0xFFFFFF)), 6, '0', STR_PAD_LEFT);
	}
}