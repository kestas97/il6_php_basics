<?php $ad = $this->data['ad']; ?>
<div class="wrapper">
    <h1><?= $ad->getTitle(); ?></h1>
    <div class="image-wrapper">
        <img width="200" src="<?= $ad->getImage() ?>">
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



