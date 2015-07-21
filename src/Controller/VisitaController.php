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
			->select(['id','persona_id','s.cargo_id', 'p.tipodocumento_id', 'p.persona_nombre', 'p.persona_apepat', 'p.persona_apemat', 'p.documento_numero'])
			->innerJoin(
				['s' => 'Serviciopersonal'],
				['Personal.id = s.personal_id']
			)
			->innerJoin(
				['p' => 'Persona'],
				['persona_id = p.id']
			)
			->where(['Personal.id' => $visita->personal_id ])
			->where(['s.organigrama_id' => $visita->organigrama_id ])
			->where(['s.sede_id' => $visita->sede_id ])
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
				->where(['Visitavisitante.estado !=' => 'A'])
				->all();

		$title = 'Editar Visita';
		$titleP = 'Visita';
		$authUser = $this->Auth->user('usuario_login');
		
		$this->set(compact('visita', 'title','titleP', 'lugares', 'cargos', 'motivos', 'organigramas', 'documentos', 'personal', 'visitantes', 'visitavisitante','authUser'));
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

	public function visitantesbyoficina(){
		
		$this->loadModel('Visitavisitante');
		$visita = $this->Visitavisitante->find();
		 
		$visita->select(['count' => $visita->func()->count('*'), 'o.organigrama_nombre'])
		 		->innerJoin(
							['v' => 'Visita'],
							['visita_id = v.id']
				)
		 		->innerJoin(
							['o' => 'Organigrama'],
							['v.organigrama_id = o.id']
				)
				->where(['Visitavisitante.estado !=' => 'A'])
				->group('o.id');
		
		$this->autoRender = false;
		$this->request->accepts('application/json');
		echo json_encode($visita);		
	}

	public function visitantesbyestado(){

		$this->loadModel('Visitavisitante');
		$visita = $this->Visitavisitante->find();		 
		$visita->select(['count' => $visita->func()->count('*'), 'estado'])
		 		->innerJoin(
							['v' => 'Visita'],
							['visita_id = v.id']
				)
		 		->innerJoin(
							['o' => 'Organigrama'],
							['v.organigrama_id = o.id']
				)
				->group('Visitavisitante.estado');
		$this->autoRender = false;
		$this->request->accepts('application/json');
		echo json_encode($visita);		
	}

	public function getVisitas()
	{
		
		$this->loadModel('Personal');
		$this->loadModel('Visitavisitante');
		$this->loadModel('Visita');
		$this->loadModel('Visitante');

		$visitas = $this->Visita->find()
			->select(['id','vv.id', 'pr.persona_nombres', 'pe.persona_nombres', 'visita_fecha', 'visita_horaprogramada','vv.estado','vv.visita_horaingreso','vv.visita_horasalida','m.motivo_color'])
			->innerJoin(
				['vv' => 'Visitavisitante'],
				['visita.id = vv.visita_id']
			)
			->innerJoin(
				['m' => 'Motivo'],
				['motivo_id = m.id']
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
			->where(['vv.estado IS NOT' => 'A']);


		$this->autoRender = false;
		$a = array();
		
		foreach ($visitas as $key){

			list($dia, $mes, $anio) = split('[/.-]', $key->visita_fecha);
			list($hora, $minuto)     = split(':', $key->visita_horaprogramada);
			list($min, $tipo) =split(' ', $minuto);
			$hora_i;
			$hora_f;
			if( $tipo=='PM' ){
				if($hora==12){
					$hora_i=($hora).':'.$min.':00';
					$hora_f=($hora+2).':'.$min.':00';	
				}else{
					$hora_i=($hora+12).':'.$min.':00';
					$hora_f=($hora+12+2).':'.$min.':00';	
				}
				
			}else{
				$hora_i=($hora).':'.$min.':00';
				$hora_f=($hora+2).':'.$min.':00';
			}
			
			array_push( $a, array('title'=> 'Visita para '.$key->pr['persona_nombres'].' de '.$key->pe['persona_nombres'],
								  'start'=> $anio.'-'.$mes.'-'.$dia.' '.$hora_i,
								  'end'  => $anio.'-'.$mes.'-'.$dia.' '.$hora_f,
								  'allDay'=>false,
								  'url'   =>'/visita-edit/'.$key->id,
								  'color' => $key->m['motivo_color']
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
}