<?php
namespace App\Controller;

use Cake\Core\Configure;
use Cake\Event\Event;
use Cake\Http\Exception\InternalErrorException;
use Cake\Http\Exception\NotFoundException;
use Tools\Mailer\Email;
use Tools\View\Helper\ObfuscateHelper;
use Cake\I18n\Time;
use \Firebase\JWT\JWT;
use Cake\Mailer\MailerAwareTrait;


/**
 * @property \App\Model\Table\UsersTable $Users
 * @property \Tools\Model\Table\TokensTable $Tokens
 */
class AccountController extends AppController {

	/**
	 * @var string
	 */
	public $modelClass = 'Users';

	use MailerAwareTrait;
	/**
	 * [activeUser Check JWT for active user]
	 * @return [user]
	 */
	public function activeUser() {

		if(isset($_GET['token'])) {
			$key = Configure::Read('Site.token_key');
			$error = null;

			try {
	    	$user = JWT::decode($_GET['token'], $key, array('HS256'));
				$userEdit = $this->Users->get($user->user_id);


				if (!$userEdit->active) {

					if (strtotime($user->exp_active) - time() > 0) {


						$userEdit->active = 1;
						$userEdit->logins = 1;
						$userEdit->last_login = new Time();
						$userEdit = $this->Users->patchEntity($userEdit, $this->request->getData());

						if ($this->Users->save($userEdit)) {
							$this->Auth->setUser($userEdit->toArray());
							$this->Flash->success('active ok');
			 				return $this->redirect('/');
						}

					}else {
						$error = 'Token Active expire , Please contact for Admin';
						$this->set(compact('error'));


					}
				}else {
					$error = 'User is already activated';
					$this->set(compact('error'));

				}

			} catch (\Exception $e) {
				$error = 'Invalid Token';
				$this->set(compact('error'));
			}
		}
		else {
			$error = 'Invalid Token';
			$this->set(compact('error'));
		}


	}


	/**
	 * [register For Register User And Send Email Active]
	 * @return [type] [$user not Active]
	 */

	public function register() {

		$key = Configure::Read('Site.token_key');
 		$user = $this->Users->newEntity();
 		if ($this->request->is('post')) {
 			$this->Users->addBehavior('Tools.Passwordable');
 			$user->role_id = 2;
 			$user = $this->Users->patchEntity($user, $this->request->getData(), ['validate' => 'Addaccount']);

 			if ($this->Users->save($user)) {
 				//

				$token = array(
			    "user_id" => $user->id,
			    "email" => $user->email,
			    "username" => $user->username,
			    "exp_active" => date("Y-m-d h:i:s", time() + 86400),
				);

				$jwtToken = JWT::encode($token, $key);

				$this->getMailer('User')->send('register', [$user,$jwtToken]);

 				$this->Flash->success('Registered SuccessFully and Please Check Your Email :-)');
 				return $this->redirect('/');
 			}
 			$this->Flash->error(__('Please try again'));
 		}
 		$this->set(compact('user'));

 	}

	/**
	 * @return \Cake\Http\Response|null
	 */
	public function login() {
		$userId = $this->Auth->user('id');

		if ($userId) {
			return $this->redirect('/');
		}

		if ($this->Common->isPosted()) {
			$user = $this->Auth->identify();

			if ($user ) {
				$userEdit = $this->Users->get($user['id']);
				$userEdit['logins'] = $userEdit['logins'] + 1;
				$userEdit['last_login'] = new Time();


				if ($this->Users->save($userEdit)) {
					$this->Auth->setUser($user);
					$this->Flash->success(__('You are now logged in.'));
					return $this->redirect('/');
				}

			}else if($user['active']) {
				$this->Flash->error('User not activated yet,Please check email');
				return null;
			}else {
				$this->Flash->error('Wrong username/email or password');
				$this->request->data['password'] = '';
			}

		} else {
			$username = $this->request->getQuery('username');
			if ($username) {
				$this->request->data['login'] = $username;
			}
		}
	}

	/**
	 * @return \Cake\Http\Response|null
	 */
	public function logout() {
		$whereTo = $this->Auth->logout();
		$this->Flash->success(__('You are now logged out.'));
		return $this->redirect($whereTo);
	}



	/**
	 * @param string|null $key
	 * @return \Cake\Http\Response|null
	 * @throws \Cake\Http\Exception\NotFoundException
	 */
	 public function lostPassword() {
		$user = $this->Users->newEntity();

 		if ($this->request->is('post')) {
			$dataUserChecking = $this->Users->findByEmail($this->request->getData()['email'])->toArray();

			if ($dataUserChecking) {

				// Step One...
				$dataUserChecking = $dataUserChecking[0];
				if ($dataUserChecking['token_reset_password']) {
					$dataToken = JWT::decode($dataUserChecking['token_reset_password'], Configure::Read('Site.token_key'), array('HS256'));

					if(strtotime($dataToken->exp_active) - time() > 0){

						$this->set(compact('user'));
						return $this->Flash->error("Token has been issued and cannot be reissued after 24 hours ");
					}
				}

				$token = array(
					"email" => $this->request->getData()['email'],
					"exp_active" => date("Y-m-d h:i:s", time() + 86400),
				);


				$jwtToken = JWT::encode($token, Configure::Read('Site.token_key'));

				$user = $this->Users->patchEntity($dataUserChecking, array('id' => $dataUserChecking['id'] , 'token_reset_password' =>  $jwtToken ),['validate' => 'loseAccount'] );

				//Cheking User
				if ($this->Users->save($user)) {

					$this->getMailer('User')->send('resetPassword', [$user->email,$jwtToken]);

	 				$this->Flash->success('Check Email Please');
					return $this->redirect('/');

				}
			}else {
				$this->Flash->error('Unregistered email');
			}

 		}

		$this->set(compact('user'));

 	}

	public function lostPasswordStepTwo(){

		if(isset($_GET['token'])) {
			$key = Configure::Read('Site.token_key');
			$error = null;

			try {
	    	$userDecode = JWT::decode($_GET['token'], $key, array('HS256'));



				if (!strtotime($userDecode->exp_active) - time() > 0) {

					$this->Flash->error("Token has been issued and cannot be reissued after 24 hours ");
					return $this->redirect('/account/lost-password');

				}



			} catch (\Exception $e) {
				$error = 'Invalid Token';
				$this->set(compact('error'));
			}


			$user = $this->Users->findByEmail($userDecode->email)->first();

			$this->Users->addBehavior('Tools.Passwordable', ['minLength' => 1 , 'maxLength' => 255]);


			if ($this->request->is('put')) {

				$user = $this->Users->patchEntity($user, $this->request->getData(), ['fields' => ['pwd', 'pwd_repeat']]);

				if ($this->Users->save($user)) {
					$this->Flash->success(__('new pw saved - you may now log in'));
					return $this->redirect('/login');
				}
			}
			$this->set(compact('user'));



		}
		else {
			$error = 'Invalid Token';
			$this->set(compact('error'));
		}
	}

	/**
	 * @return \Cake\Http\Response|null
	 * @throws \Cake\Http\Exception\NotFoundException
	 */
	public function changePassword() {
		if (!Configure::read('debug')) {
			throw new NotFoundException('Disabled for live');
		}

		$uid = $this->request->session()->read('Auth.Tmp.id');
		if (empty($uid)) {
			$this->Flash->error(__('You have to find your account first and click on the link in the email you receive afterwards'));
			return $this->redirect(['action' => 'lost_password']);
		}
		$user = $this->Users->get($uid);

		if ($this->request->getQuery('abort')) {
			if (!empty($uid)) {
				$this->request->session()->delete('Auth.Tmp');
			}
			return $this->redirect(['action' => 'login']);
		}

		$this->Users->addBehavior('Tools.Passwordable', []);
		if ($this->Common->isPosted()) {
			$user = $this->Users->patchEntity($user, $this->request->getData(), ['fields' => ['pwd', 'pwd_repeat']]);

			if ($this->Users->save($user)) {
				$this->Flash->success(__('new pw saved - you may now log in'));
				$this->request->session()->delete('Auth.Tmp');
				$username = $this->Users->field('username', ['id' => $uid]);
				return $this->redirect(['action' => 'login', '?' => ['username' => $username]]);
			}
			$this->Flash->error(__('formContainsErrors'));

			// Pwd should not be passed to the view again for security reasons.
			unset($this->request->data['pwd']);
			unset($this->request->data['pwd_repeat']);
		}

		$this->set(compact('user'));
	}



	/**
	 * @return \Cake\Http\Response|null
	 */
	public function index() {

	}

	/**
	 * @return \Cake\Http\Response|null
	 */
	public function edit() {
		$uid = $this->request->session()->read('Auth.User.id');
		$user = $this->Users->get($uid);
		$this->Users->addBehavior('Tools.Passwordable', ['require' => false]);

		if ($this->Common->isPosted()) {
			$fieldList = ['username', 'email', 'pwd', 'pwd_repeat'];
			$this->Users->patchEntity($user, $this->request->getData(), ['fields' => $fieldList]);
			if ($this->Users->save($user)) {
				$this->Flash->success(__('Account modified'));

				$this->Auth->setUser($this->Users->get($uid)->toArray());

				return $this->redirect(['action' => 'index']);
			}
			$this->Flash->error(__('formContainsErrors'));

			// Pwd should not be passed to the view again for security reasons.
			unset($this->request->data['pwd']);
			unset($this->request->data['pwd_repeat']);
		}

		$this->set(compact('user'));
	}

	/**
	 * @return \Cake\Http\Response|null
	 * @throws \Cake\Http\Exception\InternalErrorException
	 */
	public function delete() {
		$this->request->allowMethod(['post', 'delete']);
		$uid = $this->request->session()->read('Auth.User.id');
		if (!$this->Users->delete($uid)) {
			throw new InternalErrorException('Cannot delete user');
		}
		$this->Flash->success('Account deleted');
		return $this->redirect(['action' => 'logout']);
	}

}
