<h1>
  Click the following link to reset the password
</h1>
<?php

  echo $this->Html->link('Active User ' . $user, [
    'controller' => 'account',
    'action' => 'lostPasswordStepTwo',
    '?' => ['token' => $token],
    '_full' => true
  ]);
?>
