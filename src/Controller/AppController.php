<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link      http://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   http://www.opensource.org/licenses/mit-license.php MIT License
 */
namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Event\Event;

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @link http://book.cakephp.org/3.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller
{

    /**
     * Initialization hook method.
     *
     * Use this method to add common initialization code like loading components.
     *
     * @return void
     */
    public function initialize()
    {
        parent::initialize();
        $this->loadComponent('Flash');
        $this->loadComponent('Auth', [
            'loginRedirect' => [
                'controller' => 'dashboard'
            ],
            'logoutRedirect' => [
                'controller' => 'usuario',
                'action' => 'login',
                'home'
            ],
            'loginAction' => [
                'controller' => 'Usuario',
                'action' => 'login',
            ],
            'authenticate' => [
                'Form' => [
                    'userModel' => 'Usuario',
                    'fields' => [
                        'username' => 'usuario_login',
                        'password' => 'usuario_clave'
                    ],
                ],
            ]
        ]);
    }

    public function beforeFilter(Event $event)
    {
        $this->Auth->allow(['registrar', 'add']);
    }

    public function getDefaultCombos()
    {
        $this->loadModel('Lugar');
        $this->loadModel('Motivo');
        $this->loadModel('Tipodocumento');
        $this->loadModel('Cargo');
        $this->loadModel('Organigrama');

        $lugares = $this->Lugar->find('list',  [
            'keyField' => 'id',
            'valueField' => 'lugar_nombre'
        ])
        ->where(['sede_id' => $this->request->session()->read('usuario.sede')]);
        $lugares = $lugares->toArray();

        $motivos = $this->Motivo->find('list',  [
            'keyField' => 'id',
            'valueField' => 'motivo_descripcion'
        ]);
        $motivos = $motivos->toArray();

        $documentos = $this->Tipodocumento->find('list',  [
            'keyField' => 'id',
            'valueField' => 'tipodocumento_nombre'
        ]);
        $documentos = $documentos->toArray();

        $cargos = $this->Cargo->find('list',  [
            'keyField' => 'id',
            'valueField' => 'cargo_nombre'
        ]);
        $cargos = $cargos->toArray();

        $organigramas = $this->Organigrama->find('list',  [
            'keyField' => 'id',
            'valueField' => 'organigrama_nombre'
        ])
        ->where(['id' => 1]);

        $organigramas = $organigramas->toArray();

        return [$lugares, $motivos, $documentos, $cargos, $organigramas];
    }
}
