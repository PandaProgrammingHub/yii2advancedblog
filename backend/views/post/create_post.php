<?php

use Yii\app;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Post */
/* @var $form ActiveForm */
$this->title = 'Create Post';
$this->params['breadcrumbs'][] = $this->title;
?>
<?php if(Yii::$app->session->hasFlash('success')):?>
    <div class="info">
        <?php //echo Yii::$app->session->getFlash('success'); ?>
    </div>
<?php endif; ?>
<div class="post-create_post">

    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'title') ?>       
        <?= $form->field($model, 'content') ?>
        <?= $form->field($model, 'tags') ?>
              
    
        <div class="form-group">
            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- post-create_post -->
