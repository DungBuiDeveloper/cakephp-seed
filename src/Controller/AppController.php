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



	/**
	 * [Uploadload Function Uplaod For all Site]
	 * @param array  $typeFile   [typefile require]
	 * @param string $upload_dir [upload direction default 'upload/' option]
	 */
	public function Upload($typeFile = [] , $upload_dir = '' , $name = 'file') {

		$url_return = array();
		//Config TypeFile
		if (sizeof($typeFile) > 0) {
			Configure::write('Upload.upload_file_type',$typeFile);
		}
		else {
			echo 'setting type file';
			$this->response->statusCode(400);
			die();
		}
		//Config Upload Dir
		if ($upload_dir !== '') {
			Configure::write('Upload.upload_dir',$upload_dir);
		}
		$configUpload = Configure::Read('Upload');

		$storeFolder = WWW_ROOT.$configUpload['upload_dir'];

		// if folder doesn't exists, create it
		if(!file_exists($storeFolder) && !is_dir($storeFolder)) {
		  mkdir($storeFolder);
		}

		// upload files to $storeFolder
		if (!empty($_FILES)) {

			//If FILE NAME IS Array
			if (is_array($_FILES[$name]['name'])) {
				foreach ($_FILES[$name]['name'] as $key => $value) {
					if (!in_array(pathinfo($value, PATHINFO_EXTENSION), $configUpload['upload_file_type'])) {
						$this->response->type('json');
						$this->response->statusCode(400);
						$this->response->body(json_encode(array('status' => 'ERROR', 'message' => 'File Type Not Valid')));
	        	$this->response->send();
	        	$this->_stop();
						die();
					}
				}
			}

			if (is_array($_FILES[$name]['name'])) {
				foreach($_FILES[$name]['tmp_name'] as $key => $value) {

	        $tempFile = $_FILES[$name]['tmp_name'][$key];

	        $targetFile =  $storeFolder.uniqid().$_FILES[$name]['name'][$key];

	        if (move_uploaded_file($tempFile,$targetFile)) {
						array_push( $url_return , str_replace(WWW_ROOT,"",$targetFile) );
	        }
		    }
				return $url_return;
			}else {
				$tempFile = $_FILES[$name]['tmp_name'];

				$targetFile =  $storeFolder.uniqid().$_FILES[$name]['name'];
				if (move_uploaded_file($tempFile,$targetFile)) {
					return str_replace(WWW_ROOT,"",$targetFile);
				}
			}




		}


	}

}
