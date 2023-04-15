<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\PostModel $model */
/** @var ActiveForm $form */
$this->title = 'addPost';
?>
<?php if(Yii::$app->request->cookies->getValue('roleID', 0) == 2): ?>
<div class="site-addPost">

    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'title') ?>
        <?= $form->field($model, 'content')->textarea(['rows' => '6', 'columns' => '30', 'style' => 'resize: none']) ?>

        <div class="form-group" style="margin-top:10px;">
            <?= Html::submitButton('Add', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div>
<?php else: ?>
    <h2 class="text-danger">Forbidden for you!</h2>
<?php endif; ?>