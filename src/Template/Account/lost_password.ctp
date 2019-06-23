<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>
<div class="row">
  <div class="col-md-4 col-md-offset-4">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title">Password lost Step One?</h3>
    </div>
      <div class="panel-body panel-login">
        <?php echo $this->Form->create($user);?>

          <fieldset>
              <div class="form-group">
                <?php
                  echo $this->Form->control('email', ['type' => 'text','class'=>'form-control','placeholder'=>'yourmail@example.com']);
                ?>

            </div>


            <?php
              echo $this->Form->submit(__('Submit'),['class'=>'btn btn-lg btn-success btn-block']);

            ?>
          </fieldset>
          <?php echo $this->Form->end(); ?>


        <hr/>
        <center><h4>OR</h4></center>
        <?php echo $this->Html->link(__('Login instead'), ['action' => 'login'] ,['class' => 'btn btn-default']);?>
      </div>
  </div>
</div>
