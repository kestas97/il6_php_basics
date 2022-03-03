<div class="new-message">

    <div class="message-title">
        <h3>Nauja žinute</h3>
    </div>
    <?php foreach ($this->data['new_messages'] as $message) :  ?>
        <div class="message">
            <div class="message_user">
                <?php $author = $message->getUser() ?>
                <?= $author->getName() ?>
                <?= $author->getLastName() ?>
            </div>
            <div class="message_date">
                <?= $message->getDate() ?>
            </div>
            <div class="message_content">
                <p><?= $message->getMessage() ?></p>
            </div>

        </div>
    <?php endforeach; ?>
</div>
<div class="old-messages">
    <div class="message-title">
        <h3>Senos žinutės</h3>
    </div>
    <?php foreach ($this->data['old_messages'] as $message) : ?>
        <div class="message">
            <div class="message_user">
                <?php $author = $message->getUser() ?>
                <?= $author->getName() ?>
                <?= $author->getLastName() ?>
            </div>
            <div class="message_date">
                <?= $message->getDate() ?>
            </div>
            <div class="message_content">
                <p><?= $message->getMessage() ?></p>
            </div>
        </div>
    <?php endforeach; ?>
    <div class="create-message">
        <a href="<?= $this->url('message/send')?>" ><h4>Create new message</h4></a>
    </div>
</div>

