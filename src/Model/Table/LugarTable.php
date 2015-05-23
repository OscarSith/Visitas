<?php namespace App\Model\Table;

use Cake\ORM\Table;

class LugarTable extends Table
{
	public function initialize(array $config)
	{
		$this->addBehavior('Timestamp');
	}
}