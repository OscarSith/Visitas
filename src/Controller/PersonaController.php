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

		$this->set(compact('persona', 'lugares', 'motivos', 'documentos', 'cargos'));
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

			$this->request->data['fecha_creacion'] = date('Y-m-d H:i:s');
			$this->request->data['usuario_creador'] = 'Administrador';
			$fecha = explode(" ", $this->request->data['visita_fecha']);
			$this->request->data['visita_fecha'] = $fecha[0];
			$this->request->data['visita_horaprogramada'] = $fecha[1];

			if (empty($this->request->data['persona_id'])) {
				$persona = $this->Persona->newEntity($this->request->data);
				$this->Persona->save($persona);

				$this->request->data['persona_id'] = $persona->id;
				$personal = $this->Personal->newEntity($this->request->data);
				$this->Personal->save($personal);
			} else {
				$personal = $this->Personal->find()->select(['id'])->where(['persona_id' => $this->request->data['persona_id']]);
			}

			$this->request->data['personal_id'] = $personal->id;
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
			$this->loadModel('Empresa');

			$this->request->data['fecha_creacion'] = date('Y-m-d');
			$this->request->data['usuario_creador'] = 'Administrador';
			$this->request->data['persona_nombres'] = $this->request->data['persona_apepat']. ' ' . $this->request->data['persona_apemat'];

			if (empty($this->request->data['persona_id'])) {
				$persona = $this->Persona->newEntity($this->request->data);
				$this->Persona->save($persona);
				$this->request->data['persona_id'] = $persona->id;

				$empresa = $this->Empresa->newEntity($this->request->data);
				$this->Empresa->save($empresa);
			} else {
				$empresa = $this->Empresa->find()->select(['id'])->where(['persona_id' => $this->request->data['persona_id']]);
			}

			if (!isset($empresa->id)) {
				$empresa = $this->Empresa->newEntity($this->request->data);
				$this->Empresa->save($empresa);
			}
			$this->request->data['empresa_id'] = $empresa->id;
			$visitante = $this->Visitante->newEntity($this->request->data);
			$this->Visitante->save($visitante);

			$data = json_encode([
				'id' => $visitante->id,
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

	public function search()
	{
		$data = $this->Persona->find()->select(['data' => 'id', 'value' => 'persona_nombres'])->where(['persona_nombres LIKE' => '%'. $this->request->query['query'] .'%']);
		$data = json_encode([
			'suggestions' => $data->toArray(),
			'query' => $this->request->query['query']
		]);
		$this->autoRender = false;
		echo $data;
	}

	public function show($id)
	{
		$data = $this->Persona->get($id);
		$data = json_encode($data);
		$this->autoRender = false;
		echo $data;
	}
}