<?php
    use yii\bootstrap5\ActiveForm;
    use yii\bootstrap5\Html;

    $this->title = 'Admin';
?>
<?php if(Yii::$app->request->cookies->getValue('roleID', 0) == 2): ?>
    <a href="/php_lab_8/basic2/web/site/add-post" class="nav-link text-primary fs-2 d-block border border-2 rounded-3 p-1" style="width: 150px">Add post</a>
    <?php if ($posts->getModels()):?>

        <div class="d-flex flex-column align-items-center">
            <?php foreach($posts->getModels() as $post){?>
                <?php $form = ActiveForm::begin(); ?>
                    <div class="card" style="width: 600px; margin: 20px;padding:10px;">
                        <h3><?=$post->title?></h3>
                        <p><?=$post->content?></p>
                        <p><?=$post->date?></p>
                        <input type="text" name="id" style="display: none" value="<?= $post->id; ?>">
                        <div style="margin-top:10px;">
                            <?= Html::submitButton('Delete', ['class' => 'btn btn-danger']) ?>
                        </div>
                    </div>
                <?php ActiveForm::end(); ?>
            <?php };?>
        </div>
    <?php else: ?>
        <h2>There are no posts!</h2>
    <?php endif; ?>
<?php else: ?>
<h2 class="text-danger">Forbidden for you!</h2>
<?php endif; ?>
