<div class="wrapper-favorite">
    <ul>
        <?php foreach ($this->data['list'] as $ad): ?>

                <li>
                    <a href="<?= $this->url('catalog/show/' . $ad->getSlug()) ?>">
                <?= $ad->getTitle() ?>
                    </a>
            </li>
        <?php endforeach; ?>
    </ul>
</div>
