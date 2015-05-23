<?php namespace App\Model\Entity;

use Cake\ORM\Entity;

class Personal extends Entity
{
	protected $_accessible = [
		'persona_id' => true,
		'cargo_id' => true,
		'usuario_creador' => true,
		'fecha_creacion' => true,
		'usuario_actualiza' => true,
	];
}