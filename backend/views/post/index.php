<?php

use Yii\app;
use yii\helpers\Html;
use yii\widgets\LinkPager;
use yii\web\User;



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
<?php if(Yii::$app->session->hasFlash('approve')):?>
    <div class="info">
    <div id="w3-success-0" class="alert-success alert fade in">
<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
<?php echo Yii::$app->session->getFlash('approve'); ?>
</div>
        
    </div>
<?php endif; ?>
<?php if(Yii::$app->session->hasFlash('unapprove')):?>
    <div class="info">
    <div id="w3-success-0" class="alert-success alert fade in">
<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
<?php echo Yii::$app->session->getFlash('unapprove'); ?>
</div>
        
    </div>
<?php endif; ?>
<?php if(Yii::$app->session->hasFlash('delete')):?>
    <div class="info">
    <div id="w3-success-0" class="alert-success alert fade in">
<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
<?php echo Yii::$app->session->getFlash('delete'); ?>
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
   <?php if(Yii::$app->user->id == 1): ?>
        <div class="actions">
            <p>
        <?= Html::a('Approve', ['approve', 'id' => $post->id], ['class' => 'btn btn-primary']) ?>
        <?php if($post->status == 2): ?>
        <?= Html::a('Unapprove', ['unapprove', 'id' => $post->id], ['class' => 'btn btn-info']) ?>
        <?php endif; ?>
        <?= Html::a('Delete', ['delete', 'id' => $post->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>
        </div>
<?php endif; ?>
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