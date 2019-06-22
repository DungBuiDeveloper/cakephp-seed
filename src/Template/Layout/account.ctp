<?php
/**
 * @var \App\View\AppView $this
 */
$this->layout = false;
?>

<?php
use Cake\Core\Configure;

?>
<!DOCTYPE html>
<html>
<head>
  <?= $this->Html->charset() ?>
  <?= $this->Html->meta('icon') ?>
  <?= $this->Html->meta(
    'viewport',
    'width=device-width, initial-scale=1.0, maximum-scale=1.0'
  )?>
  <?= $this->fetch('meta') ?>
  <title>
    <?php
      echo Cake\Core\Configure::Read('Site.name').'- Login';
    ?>
  </title>

  <?= $this->Html->css([
      'vendor.css',
      'app.css'
  ]) ?>


</head>
<body class="<?php echo strtolower($this->request->params['controller']).'-'.strtolower($this->request->params['action']) ?>">

    <div class="container-fluid clearfix">
			<div class="container">
				<?= $this->fetch('content') ?>
			</div>
    </div>

    <?= $this->Html->script([
      'vendor.js',
      'app.js',
    ]) ?>

    <?=
      //get Script for each specified page
      $this->fetch('script')
    ?>
    <?= $this->Flash->render() ?>
</body>
</html>
