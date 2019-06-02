<!-- GET meta -->
<?php $this->element('meta'); ?>
<!-- GET meta -->

<?php $this->start('css'); ?>
  <style media="screen">

  </style>
<?php $this->end('css'); ?>

<!-- Content -->
<div class="">

</div>
<!-- /Content -->


<?php $this->start('script'); ?>
  <?= $this->Html->script([
    'home.js',
  ])?>
<?php $this->end('script'); ?>
