<?php

declare(strict_types=1);

namespace Controller;

use Core\Interfaces\ControllerInterface;
use Model\Message as MessageModel;
use Core\AbstractController;
use Model\User as UserModel;
use Helper\FormHelper;
use Helper\Logger;
use Helper\Url;
class Message extends AbstractController implements ControllerInterface
{

    public function __construct()
    {
        parent::__construct();
        if (!isset($_SESSION['user_id'])) Url::redirect('user/login');
    }

    public function index(): void
    {
        if (!isset($_SESSION['user_id'])) Url::redirect('user/login');

        $this->data['new_messages'] = MessageModel::getNewMessages((int)$_SESSION['user_id']);
        $this->data['old_messages'] = MessageModel::getOldMessages((int)$_SESSION['user_id']);


        foreach ($this->data['new_messages'] as $message){
            Logger::log((string)$message->getId());
            $status = new MessageModel((int)$message->getId());
            $status->setStatus((int) 1);
            $status->save();
        }
        $this->render('message/inbox');
    }

    public function send(string $nickName = null): void
    {
        if (!isset($_SESSION['user_id'])) Url::redirect('user/login');

        $form = new FormHelper('message/sendmessage', 'POST');

        $form->input([
            'name' => 'sender_id',
            'value' => $_SESSION['user_id'],
            'type' => 'hidden'
        ]);

        $form->input([
            'name' => 'recipient',
            'value' => $nickName,
            'placeholder' => 'Vardas',
            'type' => 'text'
        ]);

        $form->textArea('message', null, 'your message', 255 );
        $form->input([
            'name' => 'submit',
            'value' => 'send',
            'type' => 'submit'
        ]);

        $this->data['form'] = $form->getForm();
        $this->render('message/send');

    }

    public function sendMessage(): void
    {
        $nickName = $_POST['recipient'];
        $recipient = UserModel::getRecipient($nickName);
        $message = new MessageModel();
        $message->setSenderId((int)$_POST['sender_id']);
        $message->setRecipientId((int)$recipient);
        $message->setMessage($_POST['message']);
        $message->setStatus((int)$_POST['status']);
        $message->save();

        Url::redirect('');
    }
}
