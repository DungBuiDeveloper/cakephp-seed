<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Article $article
 */
?>



<div class="content just-form">
  <div class="row">
    <div class="col-md-12">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title"><?= __('Add Article') ?></h3>
        </div>

          <?= $this->Form->create(
            $article ,
            [
              'type' => 'file',
              'id' => 'article_add_submit'
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
                  );
                  if ($this->Form->isFieldError('user_id')) {
                    echo $this->Form->error('user_id');
                  }
                ?>

              </div>

              <div class="form-group">
                <label for="title">Title:</label>
                <?php
                  echo $this->Form->text('title' , ['class' => 'form-control' ,'placeholder'=>'Title']);
                  if ($this->Form->isFieldError('title')) {
                    echo $this->Form->error('title');
                  }
                ?>
              </div>

              <div class="form-group">
                <label for="title">Slug:</label>
                <?php
                  echo $this->Form->text('slug' , ['class' => 'form-control','placeholder'=>'Slug']);
                  if ($this->Form->isFieldError('slug')) {
                    echo $this->Form->error('slug');

                  }
                ?>
              </div>

              <div class="form-group">
                <label for="published">
                  <?php
                    echo $this->Form->checkbox('published', ['hiddenField' => false,'checked' => true]);
                    if ($this->Form->isFieldError('published')) {
                      echo $this->Form->error('published');
                    }
                  ?>
                  Published
                </label>
              </div>

              <div class="form-group">
                <label for="categories">Categories</label>
                <?php
                  echo $this->Form->select(
                    'categories._ids',
                    $categories,
                    [
                      'multiple' => 'multiple',
                      'class' => 'form-control',
                      'id' => 'categories',
                    ]
                  );
                  if ($this->Form->isFieldError('categories')) {
                    echo $this->Form->error('categories');
                  }
                ?>
              </div>

              <div class="form-group">

                <label for="tags">Tags</label>

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
                  if ($this->Form->isFieldError('tags')) {
                    echo $this->Form->error('tags');
                  }
                ?>

              </div>

              <div id="myDropzone" class="dropzone">
                <div class="dz-message" data-dz-message>
                  <span><i class="fa fa-camera" aria-hidden="true"></i></span>
                </div>
              </div>
              <div>
                <?php echo $this->Form->control('image_feture' , ['type' => 'hidden']); ?>
              </div>

              <div class="form-group">
                <label for="exampleInputEmail1">Content</label>
              </div>

              <div class="">
                  <?= $this->Form->input(
                    'body', [
                      'label' => false,
                      'class' => 'form-control articleBox',
                      'id' => 'articleBox',
                    ]
                  )?>
                  <div class="clearfix"></div>
              </div>
            </div>
            <!-- /.box-body -->

            <div class="box-footer">
              <button
                id="dropzoneSubmit"
                type="submit"
                class="btn btn-primary">
                Submit
              </button>
            </div>
          <?php $this->Form->end(); ?>
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
