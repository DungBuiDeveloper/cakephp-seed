<?php
  use Cake\Core\Configure;
?>
<nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="/">
        <?php
          echo Configure::Read('Site.name');
        ?>
      </a>
    </div>
    <ul class="nav navbar-nav">
      <li class="active"><a  href="#">Page 1</a></li>
      <li><a href="#">Page 2</a></li>
      <li><a href="#">Page 3</a></li>
    </ul>
    <?php  ?>
    <div class="pull-right">
      <?php if ($this->request->getSession()->read('Auth.User.id')): ?>



        <ul class="nav pull-right">
            <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">Welcome, <?php echo h($this->request->getSession()->read('Auth.User.username')); ?> <b class="caret"></b></a>
                <ul class="dropdown-menu">
                  <li>
                    <a href="/user/preferences"><i class="icon-cog"></i> Preferences</a>
                  </li>

                  <li class="divider"></li>
                  <li>
                    <a href="/logout"><i class="icon-off"></i> Logout</a>
                  </li>
                </ul>
            </li>
        </ul>
      <?php else: ?>
        <ul class="nav navbar-nav pull-right">
          <li><a  href="/login">Login</a></li>
        </ul>
      <?php endif; ?>
    </div>


  </div>
</nav>
