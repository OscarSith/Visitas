<?php namespace App\Model\Entity;

use Cake\ORM\Entity;
use Cake\Auth\DefaultPasswordHasher;

class Usuario extends Entity
{
	protected $_accessible = [
		'persona_id' => true,
		'perfil_id' => true,
		'usuario_login' => true,
		'usuario_clave' => true,
		'tipo_usuario' => true,
		'usuario_creador' => true,
	];
}