<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Article $article
 */

?>
<script type="text/javascript" src="/ckeditor/ckeditor.js"></script>





<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Articles'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Categories'), ['controller' => 'Categories', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Category'), ['controller' => 'Categories', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Tags'), ['controller' => 'Tags', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Tag'), ['controller' => 'Tags', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="articles form large-9 medium-8 columns content">
    <?= $this->Form->create($article , ['type' => 'file','id' => 'article_submit']) ?>
    <fieldset>
        <legend><?= __('Add Article') ?></legend>

        <div class="form-group">
            <?= $this->Form->label('content', __d('admin', 'Content'), ['class' => 'col-sm-2 control-label']) ?>
            <div class="col-sm-12">
                <?= $this->Form->input(
                        'content', [
                            'label' => false,
                            'class' => 'form-control articleBox',
                            'id' => 'articleBox'
                        ]
                    ) ?>
            </div>
        </div>
          <?php
            echo $this->Form->control('user_id', ['options' => $users]);
            echo $this->Form->control('title');
            echo $this->Form->control('slug');




            echo $this->Form->control('published');
            echo $this->Form->control('categories._ids', ['options' => $categories]);
            echo $this->Form->control('tags._ids', ['options' => $tags]);
            echo $this->Form->control('image_feture', ['type' => 'text']);
          ?>



          <div id="myDropzone" class="dropzone">

          </div>

    </fieldset>
    <?= $this->Form->button('Submit' , ['id'=>'dropzoneSubmit'] ) ?>
    <?= $this->Form->end() ?>
</div>

<script type="text/javascript">

    CKEDITOR.replace('articleBox', {
      customConfig: 'config/article.js',
      filebrowserImageUploadUrl: '/articles/uploadImageCk/?type=image'
    });
</script>
