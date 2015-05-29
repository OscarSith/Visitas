<?php namespace App\Model\Entity;

use Cake\ORM\Entity;

class Personal extends Entity
{
	protected $_accessible = [
		'persona_id' => true,
		'cargo_id' => true,		
		'sede_id' => true,
		'organigrama_id' => true,
	];
}