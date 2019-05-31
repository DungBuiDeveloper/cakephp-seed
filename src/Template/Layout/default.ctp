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
      echo Cake\Core\Configure::Read('Site.name').'-';
    ?>
    <?php
      if (isset($title)) {
        echo $title;
      }else {
        echo $this->fetch('title');
      }
    ?>
  </title>

  <?= $this->Html->css([
      '../node_modules/bootstrap/dist/css/bootstrap.min.css',
      'base.css',
      'style.css'
  ]) ?>

  <?=
    // get css for each specified page
    $this->fetch('css')
  ?>

</head>
<body>


    <div class="container-fluid clearfix">
      <?= $this->Flash->render() ?>

      <header>
        <?php echo $this->element('common/header'); ?>
      </header>
        <?= $this->fetch('content') ?>
      <footer>
        <?php echo $this->element('common/footer'); ?>
      </footer>
    </div>

    <?= $this->Html->script([
        '../node_modules/jquery/dist/jquery.min.js',
        '../node_modules/bootstrap/dist/js/bootstrap.min.js',
        'main.js',
    ]) ?>

    <?=
      //get Script for each specified page
      $this->fetch('script')
    ?>
</body>
</html>
