<?php $ad = $this->data['ad']; ?>
<div class="wrapper">
    <h1><?= $ad->getTitle(); ?></h1>
    <div class="image-wrapper">
        <img width="600" src="<?= $ad->getImage() ?>">
    </div>
    <div class="price">
        <?= $ad->getPrice(); ?>
    </div>
    <div class="details">
        <p>
            <?= $ad->getDescription(); ?>
        </p>
    </div>
    <div class="years">
        <p>
            <?= $ad->getYear(); ?>
        </p>
    </div>

</div>
<div class="comment-wrapper">

    <div>
        <?= $this->data['comment_box']; ?>
    </div>
    <h3>Komentaras</h3>
    <?php foreach ($this->data['comments'] as $comment) : ?>
        <div class="comments">
            <?= $comment->getUser()->getName(); ?>
            <?= $comment->getUser()->getLastName(); ?>
            <?= $comment->getCreatedAt(); ?>
            <div class="comment-message">
                <?= $comment->getComment(); ?>
            </div>

            <br>


        </div>

    <?php endforeach; ?>

    <div class="create-message">
        <a href="<?= $this->url('message/send')?>" ><h4>Create new message</h4></a>



    </div>

</div>


