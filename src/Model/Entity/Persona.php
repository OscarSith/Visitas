<?php namespace App\Model\Entity;

use Cake\ORM\Entity;

class Persona extends Entity
{
	protected $_accessible = [
		'persona_id' => true,
		'persona_nombre' => true,
		'persona_apepat' => true,
		'persona_apemat' => true,
		'persona_nombres' => true,
		'tipodocumento_id' => true,
		'documento_numero' => true,
		'usuario_creador' => true,
		'fecha_creacion' => true,
		'usuario_actualiza' => true,
		'fecha_actualiza' => true,
	];
}