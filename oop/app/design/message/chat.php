<div class="wrapper">
    <?php foreach ($this->data['messages'] as $message): ?>
        <?php  $class = $message->getSenderId() == $_SESSION['user_id'] ? 'my' :   'him'; ?>
        <div class="message-box <?= $class ?>" >
            <div class="message">
                <?= $message->getMessage() ?>
            </div>
            <div class="date">
                <?= $message->getDate() ?>
            </div>
        </div>
    <?php endforeach; ?>
    <div class="chat-box">
        <form action="<?= $this->url('message/send') ?>" method="POST">
            <div>
                <textarea name="message"></textarea>
                <input type="hidden" name="reseiver_id" value="<?= $this->data['reseiver_id'] ?>">
            </div>
            <input type="submit" value="Send" class="btn submit">
        </form>
    </div>
</div>