<div>
  <?php if (isset($error)): ?>
    <?php echo $error; ?>
  <?php endif; ?>
</div>


<!-- <div>
<?php echo $this->Form->create($user);?>
	<fieldset>
		<legend><?php echo __('Enter your new password and confirm it');?></legend>
	<?php
		echo $this->Form->control('pwd', ['type' => 'password', 'autocomplete' => 'off']);
		echo $this->Form->control('pwd_repeat', ['type' => 'password', 'autocomplete' => 'off']);
	?>
	</fieldset>
<?php echo $this->Form->submit(__('Submit')); echo $this->Form->end();?>
</div> -->



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
        <h3 class="panel-title">Password lost Step Two?</h3>
    </div>
      <div class="panel-body panel-login">
        <?php echo $this->Form->create($user);?>

          <fieldset>
              <div class="form-group">
                <?php
                  echo $this->Form->control('pwd', ['type' => 'password', 'autocomplete' => 'off','class'=>'form-control','placeholder'=>'password'])
                ?>

              </div>

              <div class="form-group">
                <?php
                  echo $this->Form->control('pwd_repeat', ['type' => 'Repeat password', 'autocomplete' => 'off','class'=>'form-control','placeholder'=>'password'])
                ?>

              </div>


            <?php
              echo $this->Form->submit(__('Submit'),['class'=>'btn btn-lg btn-success btn-block']);
            ?>

          </fieldset>

      </div>
  </div>
</div>
