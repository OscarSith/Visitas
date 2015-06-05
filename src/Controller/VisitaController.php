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
		
		$personal = $this->Personal->find()
			->select(['id','persona_id','cargo_id', 'p.tipodocumento_id', 'p.persona_nombre', 'p.persona_apepat', 'p.persona_apemat', 'p.documento_numero'])
			->innerJoin(
				['p' => 'Persona'],
				['persona_id = p.id']
			)
			->where(['Personal.id' => $visita->personal_id ])
			->first();

		$visitantes = $this->Visitavisitante->find()
				->select(['id','v.id', 'p.persona_nombre', 'p.documento_numero', 'p.persona_apepat', 'p.persona_apemat'])
				->innerJoin(
					['v' => 'Visitante'],
					['visitante_id = v.id']
				)
				->innerJoin(
					['p' => 'Persona'],
					['persona_id = p.id']
				)
				->where(['Visitavisitante.visita_id' => $id])
				->where(['Visitavisitante.estado IS NOT' => 'A'])
				->all();

		$title = 'Editar Visita';
		$authUser = $this->Auth->user('usuario_login');
		
		$this->set(compact('visita', 'title', 'lugares', 'cargos', 'motivos', 'organigramas', 'documentos', 'personal', 'visitantes', 'visitavisitante','authUser'));
	}

	public function guardarVisita()
	{
		$this->loadModel('Visitavisitante');

		$this->request->data['visita_id']= $this->request->data['id'];
		$visitantes_id = $this->request->data['visitante_id'];
		
		foreach ($visitantes_id as $key) {
			list($vvisitante, $visitante) = explode('|', $key);

			if($vvisitante==0){
				$this->request->data['visitante_id'] = $visitante;
				$visitavisitante = $this->Visitavisitante->newEntity($this->request->data);
				
				$this->Visitavisitante->save($visitavisitante);
			}

		}

		$rpta = $this->Visita->query()->update()
			->set(['visita_fecha' => $this->request->data['visita_fecha']])
			->set(['visita_horaprogramada' => $this->request->data['visita_horaprogramada']])
			->set(['lugar_id' => $this->request->data['lugar_id']])
			->set(['motivo_id' => $this->request->data['motivo_id']])
			->set(['personal_id' => $this->request->data['personal_id']])
			->set(['organigrama_id' => $this->request->data['hdnorganigrama_id']])
			->set(['visita_date' => $this->request->data['visita_fecha']])
			->where(['id' => $this->request->data['id']])
			->execute();

		$this->Flash->success(__('Visita Actualizado'));
		$this->redirect($this->referer());
	}
}