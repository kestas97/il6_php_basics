<div class="wrapper">
    <?php foreach ($this->data['chat'] as $chat): ?>
        <div class="message-box">
            <div class="chat-header">
                <?= $chat['chat_friend']->getName() ?>
                <?= $chat['message']->getDate() ?>
            </div>
            <?php $class = '';
            if ($chat['message']->getRecipientId() == $_SESSION['user_id'] &&
                $chat['message']->isSeen() == 0) {
                $class = 'bolt';
            } ?>
            <div class="last-message-body <?= $class ?>">
                <?= $chat['message']->getMessage() ?>
            </div>
            <div class="read-more">
                <a href="<?= $this->url('message/chat/' . $chat['chat_friend']->getId()) ?>">
                    Chat with <?= $chat['chat_friend']->getName() ?>
                </a>
            </div>
        </div>
    <?php endforeach; ?>
</div>