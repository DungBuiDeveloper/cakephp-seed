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
      'admin.css',
  ]) ?>

  <?=
    // get css for each specified page
    $this->fetch('css')
  ?>

</head>
<body class="hold-transition skin-blue sidebar-mini">


    <div class="wrapper">


      <header class="main-header">
        <?php echo $this->element('common_admin/header'); ?>
      </header>
      <aside class="main-sidebar">
        <?php echo $this->element('common_admin/aside'); ?>
      </aside>

      <div class="content-wrapper">
        <?= $this->fetch('content') ?>
      </div>

      <footer class="main-footer">
        <?php echo $this->element('common_admin/footer'); ?>
      </footer>
    </div>

    <?= $this->Html->script([
        'admin.js',
    ])?>

    <?=
      $this->fetch('script')
    ?>
    <?= $this->Flash->render() ?>



</body>
</html>
