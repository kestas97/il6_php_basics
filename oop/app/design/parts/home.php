<div>
    <h2>Home page</h2>

        <div class="wrapper">
            <h2>Populiariausi</h2>

            <?php foreach ($this->data['popular'] as $ad): ?>
            <div class="box">

            <a href="<?php echo $this->url('catalog/show', $ad->getSlug()) ?>">
                <img  src="<?php echo $ad->getImage() ?>">
                <div class="title">
                    <?php echo $ad->getTitle() ?>
                </div>
                <div class="price">
                    <?php echo $ad->getPrice() ?>
                </div>
            </a>
        </div>
        <?php endforeach; ?>
        </div>

    <div class="wrapper">
        <h2>Naujausi skelbimai</h2>

        <?php foreach ($this->data['newest'] as $ad): ?>
            <div class="box">

                <a href="<?php echo $this->url('catalog/show', $ad->getSlug()) ?>">
                    <img  src="<?php echo $ad->getImage() ?>">
                    <div class="title">
                        <?php echo $ad->getTitle() ?>
                    </div>
                    <div class="price">
                        <?php echo $ad->getPrice() ?>
                    </div>
                </a>
            </div>
        <?php endforeach; ?>
    </div>

</div>

