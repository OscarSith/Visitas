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

		$visitante = $this->Visitante->newEntity();

		$this->set(compact('lugares', 'motivos', 'visitante', 'documentos', 'cargos'));
	}

	public function registrar()
	{
		$persona = $this->Persona->newEntity();
		if ($this->request->is('post')) {
			$persona = $this->Persona->patchEntity($persona, $this->request->data);
			if($this->Persona->save($persona)) {
				$this->Flash->success(__('Empresa agregada con exito.'));
                return $this->redirect(['action' => 'index']);
			}
			$this->Flash->error(__('Unable to add your enterprice.'));
		}
		$this->set('persona', $persona);
	}
}