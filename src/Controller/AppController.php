<?php
namespace App\Controller;

use Cake\Core\Configure;
use Cake\Event\Event;
use Tools\Controller\Controller;

/**
 * @property \Flash\Controller\Component\FlashComponent $Flash
 * @property \Tools\Controller\Component\CommonComponent $Common
 * @property \TinyAuth\Controller\Component\AuthUserComponent $AuthUser
 * @property \TinyAuth\Controller\Component\AuthComponent $Auth
 */
class AppController extends Controller {

	/**
	 * @var array
	 */
	public $components = ['Tools.Common','TinyAuth.Auth', 'TinyAuth.AuthUser'];


	public function beforeFilter(Event $event) {
		parent::beforeFilter($event);
		$this->loadComponent('Flash');

		$config = [
			'authenticate' => [
				'Tools.MultiColumn' => [
					'fields' => [
						'username' => 'login',
						'password' => 'password'
					],
					'columns' => ['username', 'email'],
					'userModel' => 'Users',
				]
			],
			'authorize' => ['TinyAuth.Tiny' => []],
			'logoutRedirect' => [
				'plugin' => false,
				'prefix' => false,
				'controller' => 'pages',
				'action' => 'index'
			],
			'loginRedirect' => [
				'plugin' => false,
				'prefix' => false,
				'controller' => 'Account',
				'action' => 'index'
			],
			'loginAction' => [
				'plugin' => false,
				'prefix' => false,
				'controller' => 'Account',
				'action' => 'login'
			],
			'authError' => __d('cake', 'facking')
		];
		// $this->Auth->config($config);
		$this->Auth->setConfig($config);

		// Make sure you can't access login etc when already logged in
		$allowed = [
			'Account' => ['login', 'lost_password', 'register' , 'active_user']
		];


		if ($this->name === "Account") {
			$this->viewBuilder()->setLayout('account');
		}
		if (!$this->AuthUser->id()) {
			return null;
		}

		foreach ($allowed as $controller => $actions) {


			if ($this->name === $controller && in_array($this->request->param('action'), $actions)) {
				$this->Flash->info('The page you tried to access is not relevant if you are already logged in. Redirected to main page.');
				return $this->redirect('/');
			}
		}



	}

	/**
	 * @param \Cake\Event\Event $event
	 *
	 * @return \Cake\Http\Response|null
	 */
	public function beforeRender(Event $event) {
		parent::beforeRender($event);

		if (Configure::read('debug')) {
			$this->disableCache();
		}
	}

}
