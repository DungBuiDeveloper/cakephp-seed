<?php
namespace App\Mailer;

use Cake\Mailer\Mailer;
use Cake\Core\Configure;

class UserMailer extends Mailer
{
    public function register($user,$jwtToken) {


          $this
            ->from(['no-reply@DevAnt' => __d('mail', 'Welcome on {0} !', Configure::read('Site.name'))])
            ->to($user->email)
            ->emailFormat('html')
            ->subject(sprintf('Welcome %s', $user->username))
            ->set(['user' => $user->username, 'token' => $jwtToken])
            ->template('register');
    }

    public function resetPassword($user)
    {
        $this
            ->to($user->email)
            ->subject('Reset password')
            ->set(['token' => $user->token]);
    }
}

?>
