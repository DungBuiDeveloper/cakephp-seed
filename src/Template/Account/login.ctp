<div class="row">
  <div class="col-md-4 col-md-offset-4">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title">Login via DevAnt</h3>
    </div>
      <div class="panel-body panel-login">
        <?php echo $this->Form->create();?>

          <fieldset>
              <div class="form-group">
                <?php
                  echo $this->Form->control('login', ['type' => 'text','class'=>'form-control','placeholder'=>'yourmail@example.com']);
                ?>
            </div>
            <div class="form-group">
              <?php
                echo $this->Form->control('password', ['class'=>'form-control','placeholder'=>'Password']);
              ?>
            </div>

            <?php
              echo $this->Form->submit(__('Login'),['class'=>'btn btn-lg btn-success btn-block']);
            ?>



          </fieldset>
        <?php echo $this->Form->end(); ?>
        <a class="btn btn-default lost-password" href="/lost-password-step-one">Lost Password</a>
        <a class="btn btn-default reg" href="/account/register">Register</a>

        <hr/>
        <center><h4>OR</h4></center>
        <input class="btn btn-lg btn-facebook btn-block" type="submit" value="Login via facebook">
      </div>
  </div>
</div>
