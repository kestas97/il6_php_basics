<?php

namespace Model;

use Helper\DBHelper;
use Helper\FormHelper;
use Helper\Logger;
use Core\AbstractModel;
use Core\Interfaces\ModelInterface;

class message extends AbstractModel implements ModelInterface
{
    protected const TABLE = 'message';
    private $senderId;
    private $recipientId;
    private $message;
    private $date;
    private $status;

    public function __construct($id = null)
    {

        Logger::log('no_id');
        if ($id !== null){
            Logger::log('id');
            $this->load($id);
        }
    }

    public function getSenderId()
    {
        return $this->senderId;
    }

    public function setSenderId($senderId)
    {
        $this->senderId = $senderId;
    }

    public function getRecipientId()
    {
        return $this->recipientId;
    }

    public function setRecipientId($recipientId)
    {
        $this->recipientId = $recipientId;
    }

    public function getMessage()
    {
        return $this->message;
    }

    public function setMessage($message)
    {
        $this->message = $message;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function setStatus($status)
    {
        $this->status = $status;
    }

    public function getUser()
    {
        return new User($this->senderId);
    }

    public function getDate()
    {
        return $this->date;
    }

    public function assignData()
    {
        $this->data = [
            'sender_id' => $this->senderId,
            'recipient_id' => $this->recipientId,
            'message' => $this->message,
            'status' => $this->status
        ];
        Logger::log(print_r($this->data, true));
    }

    public function load($id)
    {
        $db = new DBHelper();
        $data = $db->select()
            ->from(self::TABLE)
            ->where('id', $id)
            ->getOne();
        if (!empty($data)){
            $this->id = $data['id'];
            $this->senderId = $data['sender_id'];
            $this->recipientId = $data['recipient_id'];
            $this->message = $data['message'];
            $this->status = $data['status'];
            $this->date = $data['date'];
        }

        return $this;
    }

    public static function getNewMessages($userId)
    {
        $db = new DBHelper();
        $data = $db->select()
            ->from(self::TABLE)
            ->where('recipient_id', $userId)
            ->andWhere('status', 0)
            ->get();
        Logger::log(print_r($data, true));

        $messages = [];

        foreach ($data as $element) {
            $message = new Message();
            $message->load($element['id']);
            $messages[] = $message;
        }
        Logger::log(print_r($messages, true));
        return $messages;
    }

    public static function getOldMessages($userId)
    {
        $db = new DBHelper();
        $data = $db->select()
            ->from(self::TABLE)
            ->where('recipient_id', $userId)
            ->andWhere('status', 1)
            ->get();
        $messages = [];

        foreach ($data as $element){
            $message = new Message();
            $message->load($element['id']);
            $messages[] = $message;
        }

        return $messages;
    }



    public static function countNewMessages($userId)
    {
        $db = new DBHelper();
        $rez = $db->select('count(*)')
            ->from(self::TABLE)
            ->where('recipient_id', $userId)
            ->andWhere('status', 0)
            ->get();
        return $rez[0][0];
    }

}