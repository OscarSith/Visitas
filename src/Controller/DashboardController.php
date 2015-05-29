<?php namespace App\Controller;

use Cake\Event\Event;

class DashboardController extends AppController {

	public function beforeFilter(Event $event)
	{
		parent::beforeFilter($event);
	}

	public function index()
	{
		$title = 'Dashboad';
		$authUser = $this->Auth->user('usuario_login');
		$this->set(compact('authUser', 'title'));
	}
}