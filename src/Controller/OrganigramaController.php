<?php namespace App\Controller;


class OrganigramaController extends AppController
{
	public function index()
	{
		$title = 'Registro de Visitas';
		$authUser = $this->Auth->user('usuario_login');

		$this->set(compact('title', 'authUser'));
	}
}