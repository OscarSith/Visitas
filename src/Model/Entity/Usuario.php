<?php namespace App\Model\Entity;

use Cake\ORM\Entity;
use Cake\Auth\DefaultPasswordHasher;

class Usuario extends Entity
{
	protected $_accessible = [
		'personal_id' => true,
		'perfil_id' => true,
		'usuario_login' => true,
		'usuario_clave' => true,
		'usuario_creador' => true,
		'usuario_actualiza' => true
	];

	public function _setUsuarioClave($value)
	{
		$hasher = new DefaultPasswordHasher();
		return $hasher->hash($value);
	}

	protected function _setPassword($password)
    {
        return (new DefaultPasswordHasher)->hash($password);
    }

	// public function beforeSaved()
	// {
	// 	$this->hashPasswords(null, true);
	// 	return true;
	// }
}