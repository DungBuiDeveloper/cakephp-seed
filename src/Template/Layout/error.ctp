<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */
?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <title>
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon') ?>

    <?= $this->Html->css('vendor.css') ?>
    <?= $this->Html->css('error.css') ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>
<body>
    <div id="container">
      <div class="error-template">
        <div id="header">
            <h1><?= __('Oops!') ?></h1>
        </div>
        <div id="content">
            <?= $this->Flash->render() ?>

            <?= $this->fetch('content') ?>
        </div>

        <div id="footer" class="error-actions">
            <a href="/" class="btn btn-primary btn-lg">
              <span class="glyphicon glyphicon-home"></span>
                Take Me Home
            </a>
            <a href="/contact" class="btn btn-default btn-lg">
              <span class="glyphicon glyphicon-envelope"></span>
              Contact Support
            </a>
        </div>
      </div>
    </div>
</body>
</html>
