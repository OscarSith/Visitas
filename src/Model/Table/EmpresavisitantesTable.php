<?php namespace App\Model\Table;

use Cake\ORM\Table;

class EmpresavisitantesTable extends Table
{
	public function initialize(array $config)
	{
		$this->addBehavior('Timestamp');
	}
}