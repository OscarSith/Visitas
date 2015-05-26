<?php namespace App\Model\Entity;

use Cake\ORM\Entity;

class Empresavisitantes extends Entity
{
	protected $_accessible = [
		'visitantes_id' => true,
		'empresa_id' => true
	];
}