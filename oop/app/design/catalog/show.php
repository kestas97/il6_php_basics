<?php $ad = $this->data['ad']; ?>
<div class="wrapper" xmlns="http://www.w3.org/1999/html">
    <h1><?= $ad->getTitle(); ?></h1>
    <?php if ($this->isUserLogged()): ?>
    <form action="<?= $this->url('catalog/favorite') ?>" method="POST">
        <?php $label = $this->data['saved_ad'] == null ? 'Isiminti' : 'Pamirsti'; ?>
        <input type="hidden" value="<?= $ad->getId(); ?>" name="ad_id">
        <input type="submit" value="<?= $label ?>" name="save">
    </form>
    <?php endif; ?>
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

    <span>Skelbimo ivertinimas(<?= $this->data['rating_count'] ?>):</span>
    <?= $this->data['ad_rating'] ?>
    <?php if ($this->isUserLogged()): ?>

        <form action="<?= $this->url('catalog/rate') ?>" method="POST">
            <input type="hidden" name="ad_id" value="<?= $ad->getId(); ?>">
            <input type="radio" value="1" name="rate">
            <input type="radio" value="2" name="rate">
            <input type="radio" value="3" name="rate">
            <input type="radio" value="4" name="rate">
            <input type="radio" value="5" name="rate">
            <br>
            <input type="submit" value="Ivertinimas" name="ratings">
        </form>
        <a href="<?= $this->url('message/chat/' . $ad->getUserId()) ?>">
            <br>
            Rasyti zinute savininkui
        </a>

    <?php endif; ?>



</div>


