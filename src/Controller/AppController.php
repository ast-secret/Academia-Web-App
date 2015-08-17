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
            'className' => 'Bootstrap3.BootstrapForm'
        ],
        'Html' => [
            'className' => 'Bootstrap3.BootstrapHtml'
        ],
        'Paginator' => [
            'className' => 'Bootstrap3.BootstrapPaginator'
        ],
        'Modal' => [
            'className' => 'Bootstrap3.BootstrapModal'
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
        $menuItems = [
            [
                'label' => 'Clientes',
                'controller' => 'Customers',
                'action' => 'index',
            ],
            [
                'label' => 'Aulas',
                'controller' => 'Services',
                'action' => 'index',
            ],
            [
                'label' => 'Comunicados',
                'controller' => 'Releases',
                'action' => 'index',
            ],
            [
                'label' => 'Caixa de Sugestões',
                'controller' => 'Suggestions',
                'action' => 'index',
            ],
            [
                'label' => 'Usuários',
                'controller' => 'Users',
                'action' => 'index',
            ],
        ];
        $this->set(compact('menuItems'));

        $this->loadComponent('Auth', [
            'loginAction' => [
                'controller' => 'Users',
                'action' => 'login'
            ],
            'loginRedirect' => [
                'controller' => 'Customers',
                'action' => 'index'
            ],
            'authError' => 'Você deve fazer o login para acessar esta área.',
            'authenticate' => [
                'Form' => [
                    'scope' => [
                        'Users.is_active' => true
                    ],
                    'contain' => ['Roles', 'Gyms']
                ]
            ]
        ]);
        $this->loadComponent('Flash');
        if ( $this->Auth->user()) {
            $loggedinUser = $this->Auth->user();
            $shortName = explode(' ', $loggedinUser['name']);
            $total = count($shortName);
            $loggedinUser['short_name'] = ($total > 1) ? $shortName[0] . ' ' . $shortName[$total - 1] : $shortName[0];

            $this->set(compact('loggedinUser'));
        }
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

    public function tabFilter($tab, $model)
    {
        $condition = [];
        switch ($tab) {
            case 0:
                $condition = [$model . '.is_active' => 1];
                break;
            case 1:
                $condition = [$model . '.is_active' => 0];
                break;
        }

        return $condition;
    }
}
