<?php
namespace App\Controller;

use Cake\Event\Event;
use Cake\ORM\TableRegistry;

class VisitaController extends AppController
{
	public function beforeFilter(Event $event)
	{
		parent::beforeFilter($event);
	}

	public function show($id)
	{
		$this->loadModel('Personal');
		$this->loadModel('Visitavisitante');
		$visitavisitante = $this->Visitavisitante->newEntity();
		list($lugares, $motivos, $documentos, $cargos, $organigramas) = $this->getDefaultCombos();

		$Table = TableRegistry::get('Visita');
		$visita = $Table->find()->where(['id'=> $id])->first();

		$persona = $this->Personal->find()
			->select(['cargo_id', 'p.tipodocumento_id', 'p.persona_nombre', 'p.persona_apepat', 'p.persona_apemat', 'p.documento_numero'])
			->innerJoin(
				['p' => 'Persona'],
				['persona_id = p.id']
			)
			->where(['personal.id', $visita->persona_id])
			->first();

		$visitantes = $this->Visitavisitante->find()
				->select(['id', 'p.persona_nombre', 'p.documento_numero', 'p.persona_apepat', 'p.persona_apemat'])
				->innerJoin(
					['v' => 'Visitante'],
					['visitante_id = v.id']
				)
				->innerJoin(
					['p' => 'Persona'],
					['persona_id = p.id']
				)
				->where(['Visitavisitante.visita_id', $id])
				->where(['Visitavisitante.estado IS NOT' => 'A'])
				->all();

		$title = 'Editar Visita';

		$this->set(compact('visita', 'title', 'lugares', 'cargos', 'motivos', 'organigramas', 'documentos', 'persona', 'visitantes', 'visitavisitante'));
	}

	public function guardarVisita()
	{
		$rpta = $this->Visita->query()->update()
			->set(['visita_horaprogramada' => $this->request->data['visita_horaprogramada']])
			->set(['lugar_id' => $this->request->data['lugar_id']])
			->set(['motivo_id' => $this->request->data['motivo_id']])
			->set(['visita_fecha' => $this->request->data['visita_fecha']])
			->where(['id' => $this->request->data['id']])
			->execute();
			debug($rpta->count());
			die();
		$this->Flash->success(__('Visita Actualizado'));
		$this->redirect($this->referer());
	}
}