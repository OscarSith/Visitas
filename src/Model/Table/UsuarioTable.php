<?php namespace App\Model\Table;

use Cake\ORM\Table;

class UsuarioTable extends Table
{
	public function initialize(array $config)
	{
		$this->addBehavior('Timestamp');
	}
}