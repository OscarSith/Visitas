<?php namespace App\Model\Entity;

use Cake\ORM\Entity;

class Visitavisitante extends Entity
{
	protected $_accessible = [
		'visita_id' => true,
		'visitante_id' => true,
		'visita_horaingeso' => true,
		'visita_horasalida' => true,
		'fecha_creacion' => true,
		'usuario_actualiza' => true,
		'fecha_actualiza' => true,
	];
}