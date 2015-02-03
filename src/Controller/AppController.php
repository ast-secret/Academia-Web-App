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
    public $layout = 'custom';

    public $helpers = [
        'Form' => [
            'className' => 'Chocolate.BootstrapForm'
        ]
    ];

    /**
     * Initialization hook method.
     *
     * Use this method to add common initialization code like loading components.
     *
     * @return void
     */
    public function initialize()
    {
        $bootstrapFormTemplate = [
            'formStart' => '<form {{attrs}} novalidate>',
            'errorList' => '<ul>{{content}}</ul>',
            'errorItem' => '<li>{{text}}</li>',
            'input' => '<input {{type}} {{attrs}} {{name}} class="form-control">',
            'textarea' => '<textarea {{attrs}} {{name}} class="form-control">{{value}}</textarea>',
            'inputContainer' => '<div class="form-group">{{content}}</div>',
            'inputContainerError' => '<div class="form-group">{{content}}</div>',
            'formGroup' => '{{label}} {{input}}',
            'dateWidget' => '<div class="row">
                    <div class="col-md-3">{{day}}</div>
                    <div class="col-md-5">{{month}}</div>
                    <div class="col-md-4">{{year}}</div>
                </div>',
            'select' => '<select {{name}} {{attrs}} class="form-control">{{content}}</select>'
        ];

        $this->loadComponent('Flash');
        $this->set(compact('bootstrapFormTemplate'));
    }

    public function errorsToList($fields)
    {
        $list = '<dl>';

        foreach ($fields as $fieldKey => $field) {
            $list .= "<dt>{$fieldKey}</dt>";
            foreach ($field as $error) {
                $list .= "<dd>{$error}</dd>";
            }
        }
        
        $list .= '<dl>';

        return $list;
    }
}
