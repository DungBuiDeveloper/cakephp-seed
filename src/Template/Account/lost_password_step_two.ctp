<div class="">
  <?php if (isset($error)): ?>
    <?php echo $error; ?>
  <?php endif; ?>
</div>


<div class="users form">
<?php echo $this->Form->create($user);?>
	<fieldset>
		<legend><?php echo __('Enter your new password and confirm it');?></legend>
	<?php
		echo $this->Form->control('pwd', ['type' => 'password', 'autocomplete' => 'off']);
		echo $this->Form->control('pwd_repeat', ['type' => 'password', 'autocomplete' => 'off']);
	?>
	</fieldset>
<?php echo $this->Form->submit(__('Submit')); echo $this->Form->end();?>
</div>
