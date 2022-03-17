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
        $messages = MessageModel::getUserRelatedMessages();
        $chats = [];
        foreach ($messages as $message){
            if ($message->getSenderId() > $message->getRecipientId()){
                $key = $message->getRecipientId() . '-' . $message->getSenderId();
            }else{
                $key = $message->getSenderId() . '-' . $message->getRecipientId();
            }
            $chatFriendId = $message->getSenderId() == $_SESSION['user_id'] ? $message->getRecipientId() : $message->getSenderId();
            //Logger::log('sned_id '.$message->getSenderId());

            //Logger::log('rec_id '.$message->getSenderId());

            $chatFriend = new UserModel();
            //Logger::log('id '.$chatFriendId);
            $chatFriend->load((int)$chatFriendId);
            $chats[$key]['message'] = $message;
            $chats[$key]['chat_friend'] = $chatFriend;
        }
            usort($chats, function ($item1, $item2){
            return $item2['message']->getId() <=> $item1['message']->getId();
            });

            $this->data['chat'] = $chats;
            $this->render('message/inbox');

    }


    public function chat(int $chatFriendId): void
    {
        $this->data['messages'] = MessageModel::getUserMessagesWithFriend($chatFriendId);
        MessageModel::makeSeen($chatFriendId, $_SESSION['user_id']);
        $this->data['reseiver_id'] = $chatFriendId;
        $this->render('message/chat');
    }

    public function send(): void
    {
        $message = new MessageModel();
        $message->setMessage($_POST['message']);
        $message->setRecipientId((int)$_POST['reseiver_id']);
        $message->setSenderId((int)$_SESSION['user_id']);
        $message->setSeen(0);
        $message->save();
        Url::redirect('message/chat/' . $_POST['reseiver_id']);
    }

}
