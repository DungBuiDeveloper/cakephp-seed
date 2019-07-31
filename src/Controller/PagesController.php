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
use Cake\Database\Expression\QueryExpression;

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
      $title = 'Home';
      $articlesTable = TableRegistry::getTableLocator()->get('Articles');
      $queryArticles = $articlesTable->find();
      $queryArticlesCat = $articlesTable->find();
      $queryArticlesRate = $articlesTable->find();

      //Get Articles Lastest
      $ArticlesLastest =
        $queryArticles
        ->contain('Users', function (Query $q) {
          return $q
            ->select(['username', 'email'])
            ->order(['Users.id' => 'DESC'])
            ->where(['Users.active' => true]);
        })
        ->contain(['Categories','Categories.ChildCategories',
      'Categories.ParentCategories','Tags'])
        ->limit(5)
        ->where(['published'=>1])
        ->toArray();

        //Get Articles in Categories PickUp
        $CatPickup = TableRegistry::getTableLocator()->get('pick_up')
          ->find()
          ->where(function (QueryExpression $exp, Query $q) {
              return $exp->eq('type', 'category');
          })
          ->first();

        $CatPickup = array_map('intval', explode(",",$CatPickup['id_pickup']));


        $ArticlesCatPickup =
          $queryArticlesCat
          ->innerJoinWith('Categories', function ($eq) use ($CatPickup) {
              return $eq->where(function (QueryExpression $exp, Query $q) use ($CatPickup) {
                return $exp->in('Categories.id', $CatPickup);
              });
          })
          ->toArray();


          $ArticlesRateFive =
            $queryArticlesRate
              ->where(function (QueryExpression $exp){
                return $exp->gte('rate' , '4');
              })
              ->toArray();

              $a = "<a href='javascript:;'>asdasd</a>";
      $this->set(compact('title','ArticlesRateFive','ArticlesCatPickup','ArticlesLastest','a'));

    }
}
