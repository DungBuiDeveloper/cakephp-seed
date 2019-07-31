<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Article $article
 */
?>

<div class="articles view large-9 medium-8 columns content">

    <div class="box box-primary">
      <div class="box-header with-border">
        <h3 class="box-title">
          <?php echo h($article->title) ?>
        </h3>
      </div>
      <div class="box-body">
        <table class="table">
            <tr>
                <th scope="row"><?= __('User') ?></th>
                <td><?= $article->has('user') ? $this->Html->link($article->user->username, ['controller' => 'Users', 'action' => 'view', $article->user->id]) : '' ?></td>
            </tr>
            <tr>
                <th scope="row"><?= __('Title') ?></th>
                <td><?= h($article->title) ?></td>
            </tr>
            <tr>
                <th scope="row"><?= __('Slug') ?></th>
                <td><?= h($article->slug) ?></td>
            </tr>
            <tr>
                <th scope="row"><?= __('Id') ?></th>
                <td><?= $this->Number->format($article->id) ?></td>
            </tr>
            <tr>
                <th scope="row"><?= __('Created') ?></th>
                <td><?= h($article->created) ?></td>
            </tr>
            <tr>
                <th scope="row"><?= __('Modified') ?></th>
                <td><?= h($article->modified) ?></td>
            </tr>
            <tr>
                <th scope="row"><?= __('Published') ?></th>
                <td><?= $article->published ? __('Yes') : __('No'); ?></td>
            </tr>
        </table>

        <div class="related">
            <h4><?= __('Related Categories') ?></h4>
            <?php if (!empty($article->categories)): ?>
            <table class="table table-border">
                <tr>
                    <th scope="col"><?= __('Id') ?></th>
                    <th scope="col"><?= __('Parent Id') ?></th>
                    <th scope="col"><?= __('Slug') ?></th>
                    <th scope="col"><?= __('Name') ?></th>
                </tr>
                <?php foreach ($article->categories as $categories): ?>
                <tr>
                    <td><?= h($categories->id) ?></td>
                    <td><?= h($categories->parent_id) ?></td>
                    <td><?= h($categories->slug) ?></td>
                    <td><?= h($categories->name) ?></td>
                </tr>
                <?php endforeach; ?>
            </table>
            <?php endif; ?>
        </div>
        <div class="related">
            <h4><?= __('Related Tags') ?></h4>
            <?php if (!empty($article->tags)): ?>
            <table class="table table-border">
                <tr>
                    <th scope="col"><?= __('Id') ?></th>
                    <th scope="col"><?= __('Title') ?></th>
                    <th scope="col"><?= __('Created') ?></th>
                    <th scope="col"><?= __('Modified') ?></th>
                </tr>
                <?php foreach ($article->tags as $tags): ?>
                <tr>
                    <td><?= h($tags->id) ?></td>
                    <td><?= h($tags->title) ?></td>
                    <td><?= h($tags->created) ?></td>
                    <td><?= h($tags->modified) ?></td>
                </tr>
                <?php endforeach; ?>
            </table>
            <?php endif; ?>
        </div>

      </div>
    </div>



</div>
