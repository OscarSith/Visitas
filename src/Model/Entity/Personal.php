<?php namespace App\Model\Entity;

use Cake\ORM\Entity;

class Personal extends Entity
{
	protected $_accessible = [
		'persona_id' => true,
		'empresa_id' => true,
		'usuario_creador' => true
	];
}