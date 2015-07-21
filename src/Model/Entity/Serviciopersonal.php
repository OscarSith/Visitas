<?php namespace App\Model\Entity;

use Cake\ORM\Entity;

class Serviciopersonal extends Entity
{
	protected $_accessible = [
		'personal_id' => true,
		'sede_id' => true,
		'organigrama_id' => true,
		'cargo_id' => true,
		'usuario_creador' => true
	];
}	