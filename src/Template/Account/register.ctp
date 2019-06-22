<?php
/**
 * @var \App\View\AppView $this
 */
?>

<div class="row">
  <div class="col-md-4 col-md-offset-4">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title">Register</h3>
    </div>
      <div class="panel-body">
        <?php echo $this->Form->create($user);?>

          <fieldset>
              <div class="form-group">
                <?php
									echo $this->Form->label('username','UserName');
                  echo $this->Form->text('username', ['type' => 'text','class'=>'form-control','placeholder'=>'username']);
                  if ($this->Form->isFieldError('username')) {
                    echo $this->Form->error('username');
                  }
                ?>
            	</div>

							<div class="form-group">
                <?php
									echo $this->Form->label('email','Email');
                  echo $this->Form->text('email', ['type' => 'email','class'=>'form-control','placeholder'=>'yourmail@example.com']);
                  if ($this->Form->isFieldError('email')) {
                    echo $this->Form->error('email');
                  }
                ?>
            	</div>


							<div class="form-group">
                <?php
									echo $this->Form->label('pwd','Password');
                  echo $this->Form->text('pwd', ['type' => 'password','class'=>'form-control','placeholder'=>'Password']);
                  if ($this->Form->isFieldError('pwd')) {
                    echo $this->Form->error('pwd');
                  }
                ?>
            	</div>

							<div class="form-group">
                <?php
									echo $this->Form->label('pwd_repeat','Pwd Repeat');
                  echo $this->Form->text('pwd_repeat', ['type' => 'password','class'=>'form-control','placeholder'=>'Password']);
                  if ($this->Form->isFieldError('pwd_repeat')) {
                    echo $this->Form->error('pwd_repeat');
                  }
                ?>
            	</div>


            <?php
              echo $this->Form->submit(__('Create account'),['class'=>'btn btn-lg btn-success btn-block']);
            ?>

          </fieldset>
        <?php echo $this->Form->end(); ?>
      </div>
  </div>
</div>
