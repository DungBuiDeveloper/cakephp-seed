<?php
namespace App\Model\Table;

use Tools\Model\Table\Table;
use Cake\ORM\Query;
use Cake\Validation\Validator;

class UsersTable extends Table {



  public function validationloseAccount(Validator $validator){

    $validator
      ->notEmpty('email', __("You must set an Email"))
      ->add('email', 'custom', [
		    'rule' => function ($value, $context) {

					if (sizeof($this->findByEmail($value)->toList()) === 0) {
						return false;
					}
		      return true;
		    },
		    'message' => __("Unregistered email")
			]);

      // $this->Users->findByEmail();
    return $validator;
  }

  public function validationAddaccount(Validator $validator){
		$validator
			->notEmpty('username', __("You must set an username"))
			->add('username', [
					'unique' => [
							'rule' => 'validateUnique',
							'provider' => 'table',
							'message' => __("This username is already used.")
					]
			])
			->add('username', 'custom', [
		    'rule' => function ($value, $context) {
					$pattern = '/(?=^.{6,51}$)([A-Za-z]{1})([A-Za-z0-9!@#$%_\^\&amp;\*\-\.\?]{5,49})$/';
					if (preg_match($pattern , $value)) {
						return true;
					}
		      return false;
		    },
		    'message' => __("user names. Matching text must have 6 - 50 characters, cannot contain spaces, must begin with an alpha character, can contain mixed case alpha, digits, and the following special characters: ! @ # $ % ^ &amp; * - . _ ?")
			])
			->notEmpty('email', __("You must set an Email"))
			->add('email', [
					'unique' => [
							'rule' => 'validateUnique',
							'provider' => 'table',
							'message' => __("This email is already used.")
					]
			])
			->add('email', 'custom', [
		    'rule' => function ($value, $context) {
					$pattern = '/^([0-9a-zA-Z]([-.\w]*[0-9a-zA-Z])*@([0-9a-zA-Z][-\w]*[0-9a-zA-Z]\.)+[a-zA-Z]{2,9})$/';

					if (preg_match($pattern , $value)) {
						return true;
					}
		      return false;
		    },
		    'message' => __("(1) It allows usernames with 1 or 2 alphanum characters, or 3+ chars can have -._ in the middle. username may NOT start/end with -._ or any other non alphanumeric character. (2) It allows heirarchical domain names (e.g. me@really.big.com). Similar -._ placement rules there. (3) It allows 2-9 character alphabetic-only TLDs (that oughta cover museum and adnauseum :&gt;). (4) No IP email addresses though -- I wouldn't Want to accept that kind of address.")
			])
			->notEmpty('pwd', __("You must set an Password"))
			->notEmpty('pwd_repeat', __("You must set an Password"))
			->add('pwd_repeat', 'no-misspelling', [
        'rule' => ['compareWith', 'pwd'],
        'message' => 'Passwords are not equal',
    	]);

		return $validator;
	}

	/**
	 * @param array $config
	 *
	 * @return void
	 */
	public function initialize(array $config) {

		$this->belongsTo('Roles');
		$this->setDisplayField('username');
		$this->addBehavior('Timestamp');
	}

}
