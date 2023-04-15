<?php
    use yii\bootstrap5\ActiveForm;
    use yii\bootstrap5\Html;

    $this->title = 'Posts';
?>
<?php if ($posts->getModels()):?>
<div class="d-flex flex-column align-items-center">
    <?php foreach($posts->getModels() as $post){?>
        <div class="card" style="width: 600px; margin: 20px;padding: 10px">
            <div class="d-flex justify-content-between">
                <h3><?=$post->title?></h3>
                <h3 class="text-primary"><?=$post->username?></h3>
            </div>

            <p><?=$post->content?></p>
            <p><?=$post->date?></p>
            <a href="/php_lab_8/basic2/web/site/comments?post_id=<?=$post->id?>" class="text-decoration-none text-primary fs-5">↓comments↓</a>
        </div>
    <?php };?>
</div>
<?php else: ?>
<h2>There are no posts!</h2>
<?php endif; ?>
