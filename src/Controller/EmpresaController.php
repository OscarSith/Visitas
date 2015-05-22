<?php
namespace App\Controller;

class EmpresaController extends AppController
{
	public function index()
	{
		$empresas = $this->Empresa->find('all');
		$this->set('empresas', $empresas);
	}

	public function add()
	{
		$empresa = $this->Empresa->newEntity();
		if ($this->request->is('post')) {
			$this->request->data['persona_id'] = 1;
			$empresa = $this->Empresa->patchEntity($empresa, $this->request->data);
			if($this->Empresa->save($empresa)) {
				$this->Flash->success(__('Empresa agregada con exito.'));
                return $this->redirect(['action' => 'index']);
			}
			$this->Flash->error(__('Unable to add your enterprice.'));
		}
		$this->set('empresa', $empresa);
	}
}