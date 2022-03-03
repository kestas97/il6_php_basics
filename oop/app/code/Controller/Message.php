<?php

namespace Controller;

use Core\Interfaces\ControllerInterface;
use Model\Message as MessageModel;
use Core\AbstractController;
use Helper\FormHelper;
use Helper\Logger;
use Helper\Url;
class Message extends AbstractController implements ControllerInterface
{

    public function index()
    {
        if (!isset($_SESSION['user_id'])) Url::redirect('user/login');

        $this->data['new_messages'] = MessageModel::getNewMessages($_SESSION['user_id']);
        $this->data['old_messages'] = MessageModel::getOldMessages($_SESSION['user_id']);

        foreach ($this->data['new_messages'] as $message){
            Logger::log($message->getId());
            $status = new MessageModel($message->getId());
            $status->setStatus(1);
            $status->save();
        }
        $this->render('message/inbox');
    }

    public function send($receipientId = null)
    {
        if (!isset($_SESSION['user_id'])) Url::redirect('user/login');

        $form = new FormHelper('message/sendmessage', 'POST');

        $form->input([
            'name' => 'sender_id',
            'value' => $_SESSION['user_id'],
            'type' => 'hidden'
        ]);

        $form->input([
            'name' => 'recipient_id',
            'value' => $receipientId,
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

    public function sendMessage()
    {
        $message = new MessageModel();
        $message->setSenderId($_POST['sender_id']);
        $message->setRecipientId($_POST['recipient_id']);
        $message->setMessage($_POST['message']);
        $message->setStatus(0);
        $message->save();

        Url::redirect('');
    }
}