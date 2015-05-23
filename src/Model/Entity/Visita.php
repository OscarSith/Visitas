<?php namespace App\Model\Entity;

use Cake\ORM\Entity;

class Visita extends Entity
{
	protected $_accessible = [
		'personal_id' => true,
		'lugar_id' => true,
		'motivo_id' => true,
		'visita_observacion' => true
		'visita_detalle' => true
		'visita_fecha' => true
		'visita_horaprogramada' => true
		'usuario_creador' => true
		'fecha_creacion' => true
	];
}