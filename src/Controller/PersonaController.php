<?php
namespace App\Controller;

use Cake\Event\Event;

class PersonaController extends AppController
{
	public function beforeFilter(Event $event)
	{
		parent::beforeFilter($event);
	}
	public function index()
	{
		$this->loadModel('Lugar');
		$this->loadModel('Motivo');
		$this->loadModel('Visitante');
		$this->loadModel('Tipodocumento');
		$this->loadModel('Cargo');

		$lugares = $this->Lugar->find('list',  [
			'keyField' => 'id',
			'valueField' => 'lugar_nombre'
		]);
		$lugares = $lugares->toArray();

		$motivos = $this->Motivo->find('list',  [
			'keyField' => 'id',
			'valueField' => 'motivo_descripcion'
		]);
		$motivos = $motivos->toArray();

		$documentos = $this->Tipodocumento->find('list',  [
			'keyField' => 'id',
			'valueField' => 'tipodocumento_nombre'
		]);
		$documentos = $documentos->toArray();

		$cargos = $this->Cargo->find('list',  [
			'keyField' => 'id',
			'valueField' => 'cargo_nombre'
		]);
		$cargos = $cargos->toArray();

		$persona = $this->Persona->newEntity();

		$title = 'Registro de Visitas';
		$authUser = $this->Auth->user('usuario_login');

		$this->set(compact('persona', 'lugares', 'motivos', 'documentos', 'cargos', 'title', 'authUser'));
	}

	public function registrarVisita()
	{
		$this->loadModel('Personal');
		$this->loadModel('Visita');
		$this->loadModel('Visitavisitante');

		if ($this->request->is('post')) {

			if (empty($this->request->data['visitante_id'])) {
				$this->Flash->error(__('Debe agregar al menos un visitante.'));
				return $this->redirect(['action' => 'index']);
			}

			$this->request->data['fecha_creacion'] = date('Y-m-d');
			$this->request->data['usuario_creador'] = 'Administrador';
			$this->request->data['visita_fecha'] = $this->request->data['visita_fecha'];
			$this->request->data['visita_horaprogramada'] = date('H:i:s');

			if (empty($this->request->data['personal_id'])) {
				$persona = $this->Persona->newEntity($this->request->data);
				$this->Persona->save($persona);

				$this->request->data['persona_id'] = $persona->id;
				$personal = $this->Personal->newEntity($this->request->data);
				$this->Personal->save($personal);
			}
			// else {
			// 	$personal = $this->Personal->find()->select(['id'])->where(['persona_id' => $this->request->data['persona_id']]);
			// $this->request->data['personal_id'] = $personal->id;
			// }

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


			$this->request->data['persona_nombres'] = $this->request->data['persona_apepat']. ' ' . $this->request->data['persona_apemat'];
			if (empty($this->request->data['visitante_id'])) {
				$this->loadModel('Visitante');
				$this->loadModel('Empresa');

				$this->request->data['fecha_creacion'] = date('Y-m-d');
				$this->request->data['usuario_creador'] = 'Administrador';

				$persona = $this->Persona->newEntity($this->request->data);
				$this->Persona->save($persona);
				$this->request->data['persona_id'] = $persona->id;

				$empresa = $this->Empresa->newEntity($this->request->data);
				$this->Empresa->save($empresa);

				$visitante = $this->Visitante->newEntity($this->request->data);
				$this->Visitante->save($visitante);
			}

			$data = json_encode([
				'id' => $this->request->data['visitante_id'],
				'documento_numero' => $this->request->data['documento_numero'],
				'persona_nombre' => $this->request->data['persona_nombre'],
				'persona_apellidos' => $this->request->data['persona_nombres']
			]);
			// $this->set('_serialize', 'data');
			$this->autoRender = false;
			echo $data;
		} else {
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
			->select(['vv.id', 'pr.persona_nombres', 'pe.persona_nombres', 'visita_fecha', 'visita_horaprogramada'])
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
			)
			->all();
		// select  from visita as v
		// join visitavisitante as vv on v.id = vv.visita_id
		// join visitante as vi on vv.visitante_id = vi.id
		// join persona as pe on vi.persona_id = pe.id 
		// join personal as pl on v.personal_id = pl.id
		// join persona as pr on pl.persona_id = pr.id 
		// where v.id = 4

		$authUser = $this->Auth->user('usuario_login');
		$title = 'Listado de visitas';
		$this->set(compact('visitas', 'authUser', 'title'));
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
				->where(['persona_nombres LIKE' => '%'. $this->request->query['query'] .'%']);

		$this->toJson($data, true);
	}

	public function show($id)
	{
		$data = $this->Persona
				->find()
				->select(['p.id', 'persona_nombre', 'persona_apepat', 'persona_apemat', 'persona_nombres', 'tipodocumento_id', 'documento_numero', 'p.cargo_id'])
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
		$data = $this->Persona
				->find()
				->select(['v.id', 'persona_nombre', 'persona_apepat', 'persona_apemat', 'persona_nombres', 'tipodocumento_id', 'documento_numero'])
				->innerJoin(
					['v' => 'visitante'],
					['persona.id = v.persona_id']
				)
				->where(['v.id = ' => $id])
				->first();

		$this->loadModel('Empresavisitantes');
		$data2 = $this->Empresavisitantes
			->find()
			->select(['p.persona_nombres', 'p.documento_numero'])
			->innerJoin(
				['e' => 'empresa'],
				['empresavisitantes.empresa_id = e.id']
			)
			->innerJoin(
				['p' => 'persona'],
				['p.id = e.persona_id']
			)
			->where(['visitantes_id =' => $id])
			->first();

		$this->toJson($data, false, $data2, true);
	}

	public function showByRuc()
	{
		$data = $this->Empresa->find()
			->find()
			->select(['data' => 'id', 'value' => 'p.persona_nombres'])
			->innerJoin(
				['p' => 'persona'],
				['empresa.persona_id = p.id']
			)
			->where(['p.documento_numero LIKE ' => '%'.$this->request->query['query'].'%']);

		$this->toJson($data, true);
	}

	public function searchByDni()
	{
		$data = $this->Persona
				->find()
				->select(['data' => 'v.id', 'value' => 'persona_nombres'])
				->join([
					'v' => [
						'table' => 'visitante',
						'type' => 'inner',
						'conditions' => 'persona.id = v.persona_id'
					]
				])
				->where(['documento_numero LIKE' => '%'.$this->request->query['query'].'%']);
			// debug($data);
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
}