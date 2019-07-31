<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Article $article
 */
?>


<div class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title"><?= __('Edit Article') ?></h3>
        </div>
        <?= $this->Form->create(
          $article ,
          [
            'type' => 'file',
            'id' => 'article_edit_submit'
          ]);
        ?>
        <div class="box-body">
          <div class="form-group">
            <label for="exampleInputEmail1">Author</label>
            <?php echo $this->Form->select(
              'user_id',
              $users,
              [
                'class' => 'form-control',
                'id' => 'user_id'
              ]
            ); ?>
          </div>

          <div class="form-group">
            <label for="title">Title:</label>
            <?php
              echo $this->Form->text('title' , ['class' => 'form-control' ,'placeholder'=>'Title']);
            ?>
          </div>

          <div class="form-group">
            <label for="title">Slug:</label>
            <?php
              echo $this->Form->text('slug' , ['class' => 'form-control','placeholder'=>'Slug']);
            ?>
          </div>

          <div class="form-group">
            <label for="published">
              <?php
                echo $this->Form->checkbox('published', ['hiddenField' => false]);
              ?>
              Published
            </label>

          </div>


          <div class="form-group">

            <label for="exampleInputEmail1">Categories</label>

            <?php

              echo $this->Form->select(
                'categories._ids',
                $categories,
                [
                  'multiple' => 'multiple',
                  'class' => 'form-control',
                  'id' => 'categories'
                ]
              );



            ?>

          </div>

          <div class="form-group">

            <label for="exampleInputEmail1">Tags</label>

            <?php
              echo $this->Form->select(
                'tags._ids',
                $tags,
                [
                  'class' => 'form-control',
                  'id' => 'tags',
                  'multiple' => 'multiple'
                ]
              );
            ?>

          </div>
        </div>

        <div class="form-group">
            <?= $this->Form->label('content', __d('admin', 'Content'), ['class' => 'col-sm-2 control-label']) ?>
            <div class="col-sm-12">
                <?= $this->Form->input(
                  'body', [
                      'label' => false,
                      'class' => 'form-control articleBox',
                      'id' => 'articleBox',

                  ]

                )?>
            </div>
            <div class="clearfix"></div>
        </div>


        <div class="box-body">
          <div>
            <?php echo $this->Form->control('image_feture' , ['type' => 'hidden']); ?>
          </div>
          <div id="myDropzone" class="dropzone">
            <div class="dz-message" data-dz-message><span><i class="fa fa-camera" aria-hidden="true"></i></span></div>
            <?php if ($article['image_feture'] !== '') :?>
              <div class="preview">
                <img src="<?php echo $article['image_feture']; ?>" alt="">
              </div>
            <?php endif; ?>
          </div>
        </div>

        <div class="box-footer">
          <button

            type="submit"
            class="btn btn-primary">
            Submit
          </button>
        </div>


        <?= $this->Form->end() ?>
      </div>

    </div>

  </div>

</div>
<script type="text/javascript" src="/ckeditor/ckeditor.js"></script>
<script>
  (function() {
    CKEDITOR.replace('articleBox', {
      customConfig: 'config/article.js',
      filebrowserImageUploadUrl: '/articles/uploadImageCk/?type=image'
    });
  })();
</script>
