<?php
namespace App\Controller;

class ServiciopersonalController extends AppController
{
	public function index()
	{
			
		$this->loadModel('Serviciopersonal');
		$this->loadModel('Organigrama');
		$this->loadModel('Cargo');
		$this->loadModel('Sede');
		$this->loadModel('Personal');

		$this->layout = 'signin';

		$codPersonal=$this->request->session()->read('personal.codigo');
		$authUser = $this->Auth->user('usuario_login');
		$serviciopersonal = $this->Serviciopersonal->find()
										->select(['id','o.id','o.organigrama_nombre','c.id','c.cargo_nombre','s.id','s.sede_nombre'])
										->innerJoin(
											['o' => 'Organigrama'],
											['serviciopersonal.organigrama_id = o.id']
										)
										->innerJoin(
											['c' => 'Cargo'],
											['serviciopersonal.cargo_id = c.id']
										)
										->innerJoin(
											['s' => 'Sede'],
											['serviciopersonal.sede_id = s.id']
										)
										->innerJoin(
											['p' => 'Personal'],
											['serviciopersonal.personal_id = p.id']
										)
										->where(['serviciopersonal.personal_id' => $codPersonal])
										->where(['serviciopersonal.estado' => 'A']);
		
		$this->set(compact('authUser','serviciopersonal'));
									
	}

	public function asignaingreso(){

		$codPerfil = $this->request->session()->read('usuario.perfil');
		$this->request->session()->write('usuario.sede', $this->request->data['id-sede']);
		$this->request->session()->write('usuario.cargo', $this->request->data['id-cargo']);
		
		if ( $codPerfil == 2 ) {
		    				
		    $this->request->session()->write('usuario.organigrama', 1);
		    return $this->redirect('/persona');		    				
		}else if( $codPerfil == 1 ) {

			$this->request->session()->write('usuario.organigrama', 1);	
			return $this->redirect('/dashboard');
		}else{
		 				
			$this->request->session()->write('usuario.organigrama', $this->request->data['id-organigrama']);	
		    return $this->redirect('/dashboard');
		}
	}	
}