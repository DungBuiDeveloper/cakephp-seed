<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Article Entity
 *
 * @property int $id
 * @property int $user_id
 * @property string $title
 * @property string $slug
 * @property string|null $body
 * @property bool|null $published
 * @property string $image_feture
 * @property int|null $count
 * @property int|null $rate
 * @property int|null $total_rate
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $modified
 *
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\Category[] $categories
 * @property \App\Model\Entity\Tag[] $tags
 */
class Article extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        'user_id' => true,
        'title' => true,
        'slug' => true,
        'body' => true,
        'published' => true,
        'image_feture' => true,
        'count' => true,
        'rate' => true,
        'total_rate' => true,
        'created' => true,
        'modified' => true,
        'user' => true,
        'categories' => true,
        'tags' => true
    ];
}
