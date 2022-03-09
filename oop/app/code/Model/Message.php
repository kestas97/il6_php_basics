<?php

declare(strict_types=1);

namespace Model;

use Helper\DBHelper;
use Helper\FormHelper;
use Helper\Logger;
use Core\AbstractModel;
use Core\Interfaces\ModelInterface;

class Message extends AbstractModel implements ModelInterface
{
    protected const TABLE = 'message';
    private int $senderId;
    private int $recipientId;
    private string $message;
    private string $date;
    private int $status;

    public function __construct(?int $id = null)
    {

        Logger::log('no_id');
        if ($id !== null){
            Logger::log('id');
            $this->load($id);
        }
    }

    public function getSenderId(): int
    {
        return $this->senderId;
    }

    public function setSenderId(int $senderId): void
    {
        $this->senderId = $senderId;
    }

    public function getRecipientId(): int
    {
        return $this->recipientId;
    }

    public function setRecipientId(int $recipientId): void
    {
        $this->recipientId = $recipientId;
    }

    public function getMessage(): string
    {
        return $this->message;
    }

    public function setMessage( string $message): void
    {
        $this->message = $message;
    }

    public function getStatus(): int
    {
        return $this->status;
    }

    public function setStatus(int $status): void
    {
        $this->status = $status;
    }

    public function getUser(): User
    {
        return new User($this->senderId);
    }

    public function getDate(): string
    {
        return $this->date;
    }

    public function assignData(): void
    {
        $this->data = [

          'sender_id' => $this->senderId,
          'recipient_id' => $this->recipientId,
          'message' => $this->message,
          'status' => $this->status
        ];
        Logger::log(print_r($this->data, true));
    }

    public function load(int $id): Message
    {
        $db = new DBHelper();
        $message = $db->select()
            ->from(self::TABLE)
            ->where('id', $id)
            ->getOne();
        if (!empty($message)){
            $this->id = (int)$message['id'];
            $this->senderId = (int)$message['sender_id'];
            $this->recipientId = (int)$message['recipient_id'];
            $this->message = $message['message'];
            $this->status = (int)$message['status'];
            $this->date = $message['date'];
        }

        return $this;
    }

    public static function getNewMessages(int $userId): array
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
            $message->load((int)$element['id']);
            $messages[] = $message;
        }
        Logger::log(print_r($messages, true));
        return $messages;
    }

    public static function getOldMessages(int $userId): array
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
            $message->load((int)$element['id']);
            $messages[] = $message;
        }

        return $messages;
    }



    public static function countNewMessages(int $userId): int
    {
        $db = new DBHelper();
        $rez = $db->select('count(*)')
            ->from(self::TABLE)
            ->where('recipient_id', $userId)
            ->andWhere('status', 0)
            ->get();
        return (int)$rez[0][0];
    }



}