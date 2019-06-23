<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>

<h2><?php echo __('Password lost?');?></h2>

<div class="users form">
<?php echo $this->Form->create($user);?>
	<fieldset id="step-1">
		<legend><?php echo __('Step {0}', 1);?></legend>
		<p>Please enter your email address</p>
	<?php
	echo $this->Form->control('email', ['label' => __('Email')]);


	echo $this->Form->submit(__('Submit'),['name' => 'enter-email']);
	?>
	</fieldset>
<?php echo $this->Form->end();?>


	</div>



<br/><br/>

<div class="actions">
	<ul>
		<li><?php echo $this->Html->link(__('Login instead'), ['action' => 'login']);?></li>
	</ul>
</div>
