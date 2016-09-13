<?php

use yii\helpers\Html;
use yii\widgets\LinkPager;


$this->title = 'Blog';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="blog">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
<?php if(Yii::$app->session->hasFlash('notlogin')):?>
    <div class="info">
    <div id="w3-success-0" class="alert-success alert fade in">
<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
<?php echo Yii::$app->session->getFlash('notlogin'); ?>
</div>
        
    </div>
<?php endif; ?>
    <p>
        <?= Html::a('Create Post', ['create_post'], ['class' => 'btn btn-success pull-right']) ?>
    </p>

<div class="items">
<?php foreach ($posts as $post): ?>
	<div class="post">
		<div class="title">
			<?= $post->title ?>
		</div>
				<div class="content">
			<?= $post->content ?>
		</div>
		<div class="tags">
			<i><b>Tags :</b><?= $post->tags ?></i> &nbsp; &nbsp;  <b>status:</b><?= ($post->status == 1)?"Pending":"Approved" ?>
		</div>
</div>
<?php endforeach; ?>
</div>

<style type="text/css">
.blog .post {
    padding: 8px 15px;
    margin-bottom: 20px;
    list-style: none;
    background-color: #f5f5f5;
    border-radius: 4px;
    height: auto;
}
.blog .title {
    border-bottom: 1px solid;
    padding: 10px;
}
.blog .content{
	padding: 20px;
}
.blog .tags {
    border-top: 2px solid;
    padding: 10px;
}
</style>
<?= LinkPager::widget(['pagination' => $pagination]) ?>