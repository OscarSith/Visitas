<?php namespace App\Model\Entity;

use Cake\ORM\Entity;

class Organigrama extends Entity
{
	protected $_accessible = [
		'persona_id' => true,
		'usuario_creador' => true,
		'usuario_actualiza' => true,
		'fecha_creacion' => true,
	];
}
