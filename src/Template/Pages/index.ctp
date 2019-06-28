<?php
  use Cake\I18n\Time;
?>
<div class="container-fluid">

  <div class="slider-lastest">
  <?php foreach ($ArticlesLastest as $article): ?>


    <div class="col-md-4">
      <div class="well ">
          <div class="media">

      		<div class="media-body">
            <a class="col-md-12" href="#">
        		  <img style="margin: 0px auto 10px;" class="media-object img-responsive" src="<?php echo $article->image_feture; ?>">
      		  </a>
        		<h4 class="media-heading">
              <?php echo $article->title; ?>

            </h4>
              <p class="text-left">

                <i class="glyphicon glyphicon-user"></i>
                <?php echo $article->user->username; ?>
              </p>
              <p class="js-body-dot">
                <?php
                  echo $article->body;
                ?>
              </p>
              <ul class="list-inline list-unstyled">
      			    <li>
                  <span>
                    <i class="glyphicon glyphicon-calendar"></i>
                    <?php $difference = Time::now()->diff($article->created); ?>

                    <?php echo $difference->days ?> days, <?php echo $difference->h ?> hours

                  </span>
                </li>
                <li>|</li>

                <span><i class="glyphicon glyphicon-tag"></i> <?php echo sizeof($article['tags']); ?> Tags</span>
                <li class="li-rate">
                  <?php
                    for ($i=0; $i < 5; $i++):

                  ?>
                    <?php if ($i <= $article->rate): ?>
                      <span class="glyphicon glyphicon-star"></span>
                    <?php else: ?>
                      <span class="glyphicon glyphicon-star-empty"></span>

                    <?php endif; ?>

                  <?php endfor; ?>


                </li>

                <li>
                <!-- Use Font Awesome http://fortawesome.github.io/Font-Awesome/ -->
                  <span><i class="fa fa-facebook-square"></i></span>
                  <span><i class="fa fa-twitter-square"></i></span>
                  <span><i class="fa fa-google-plus-square"></i></span>
                </li>
    			</ul>
           </div>
        </div>
      </div>
    </div>


  <?php endforeach; ?>





</div>


</div>
