<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link      https://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   https://opensource.org/licenses/mit-license.php MIT License
 */
namespace App\Controller;
use Cake\ORM\TableRegistry;
use Cake\ORM\Query;

/**
 * Static content controller
 *
 * This controller will render views from Template/Pages/
 *
 * @link https://book.cakephp.org/3.0/en/controllers/pages-controller.html
 */
class PagesController extends AppController
{


    public function index(){
      $articlesTable = TableRegistry::getTableLocator()->get('Articles');
      $queryArticles = $articlesTable->find();


      $ArticlesLastest =
        $queryArticles
        ->contain('Users', function (Query $q) {
          return $q
            ->select(['username', 'email'])
            ->order(['Users.id' => 'DESC'])
            ->where(['Users.active' => true]);
        })
        ->contain(['Categories','Categories.ChildCategories',
      'Categories.ParentCategories'])
      ->limit(5)
      ->where(['published'=>1])
        ->toArray();



      $title = 'home title';
      $this->set(compact('title'));

    }
}
