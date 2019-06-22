<?php
if (!isset($params['escape']) || $params['escape'] !== false):?>

<div class="alert alert-success" role="alert">
  <?php echo h($message); ?>
</div>
<?php endif; ?>

<script type="text/javascript">
  var timeOutAlert=setTimeout(function () {
    $('.alert').fadeOut(500);
  }, 2500);
  $('.alert').click(function() {
    $('.alert').hide();
    clearTimeout(timeOutAlert);
  })
</script>
