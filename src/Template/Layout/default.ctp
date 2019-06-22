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
      echo Configure::Read('Site.name').'-';
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
      'vendor.css',
      'app.css'
  ]) ?>

  <?=
    // get css for each specified page
    $this->fetch('css')
  ?>

</head>
<body>


    <div class="container-fluid clearfix">


      <header>
        <?php echo $this->element('common/header'); ?>
      </header>
      <div class="container-fluid">
        <div class="content-page">
          <?= $this->fetch('content') ?>
        </div>
      </div>

      <footer>
        <?php echo $this->element('common/footer'); ?>
      </footer>
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
