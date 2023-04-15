<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\PostModel $model */
/** @var ActiveForm $form */
$this->title = 'Comments';
?>
<a href="/php_lab_8/basic2/web/site/index" class="nav-link text-primary fs-2 d-block border border-2 rounded-3 p-1" style="width: 150px">Get back</a>
<div class="d-flex flex-column align-items-center">
    <div class="card" style="width: 600px; margin: 20px;padding: 10px">
        <h3><?=$post->title?></h3>
        <p><?=$post->content?></p>
        <p><?=$post->date?></p>
        <hr>
        <?php if(Yii::$app->request->cookies->getValue('roleID', 0) != 0): ?>
            <?php $form = ActiveForm::begin(); ?>
                <?= $form->field($model, 'content')->textarea(['rows' => '3', 'columns' => '20', 'style' => 'resize: none']) ?>
                <div style="margin-top:10px;">
                    <?= Html::submitButton('Comment', ['class' => 'btn btn-primary']) ?>
                </div>
            <?php ActiveForm::end(); ?>
        <?php endif; ?>
        <?php foreach($comments as $comment){ ?>
            <div class="border border-2 d-flex flex-column" style="margin-top: 10px; font-size: 12px; padding: 10px;">
                <div class="d-flex justify-content-between">
                    <p class="text-primary"><?=$comment->username?></p>
                    <p><?=$comment->date?></p>
                </div>
                <p><?=$comment->content?></p>
            </div>
        <?php };?>
    </div>
</div>
