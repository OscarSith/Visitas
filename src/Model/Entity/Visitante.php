<?php namespace App\Model\Entity;

use Cake\ORM\Entity;

class Visitante extends Entity
{
	protected $_accessible = [
		'persona_id' => true,
		'empresa_id' => true,
		'visitante_email' => true,
		'usuario_creador' => true
	];
}