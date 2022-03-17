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
    private int $seen;

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

    public function isSeen(): int
    {
        return $this->seen;
    }

    public function setSeen(int $seen): void
    {
        $this->seen = $seen;
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
          'seen' => $this->seen
        ];
        Logger::log(print_r($this->data, true));
    }

    public function load(int $id): Message
    {
        $db = new DBHelper();
        $rez = $db->select()
            ->from(self::TABLE)
            ->where('id', $id)
            ->getOne();
        if (!empty($rez)){
            $this->id = (int)$rez['id'];
            $this->senderId = (int)$rez['sender_id'];
            $this->recipientId = (int)$rez['recipient_id'];
            $this->message = $rez['message'];
            $this->seen = (int)$rez['seen'];
            $this->date = $rez['date'];
        }

        return $this;
    }

    public static function getUnreadMessagesCount(): int
    {
        $db = new DBHelper();
        $rez = $db->select('COUNT(*)')
            ->from(self::TABLE)
            ->where('recipient_id', $_SESSION['user_id'])
            ->andWhere('seen', 0)
            ->get();
        return (int)$rez[0][0];
    }

    public static function getUserRelatedMessages(): array
    {
        $db = new DBHelper();
        $userId = $_SESSION['user_id'];
        $data = $db->select()
            ->from(self::TABLE)
            ->where('sender_id', $userId)
            ->orWhere('recipient_id', $userId)
            ->get();
        $messages = [];
        foreach ($data as $element){
            $message = new Message();
            $message->load((int)$element['id']);
            $messages[] = $message;
        }
        return $messages;

    }

    public static function getUserMessagesWithFriend(int $friendId): array
    {
        $db = new DBHelper();
        $userId = $_SESSION['user_id'];
        $data = $db->select()
            ->from(self::TABLE)
            ->where('sender_id', $userId)
            ->andWhere('recipient_id', $friendId)
            ->orWhere('recipient_id', $userId)
            ->andWhere('sender_id', $friendId )
            ->get();
        $messages = [];
        foreach ($data as $element){
            $message = new Message();
            $message->load((int)$element['id']);
            $messages[] = $message;
        }
        return $messages;
    }

    public static function makeSeen(int $senderId, int $recipientId): void
    {
        $db = new DBHelper();
        $db->update(self::TABLE, ['seen' => 1])
            ->where('sender_id', $senderId)
            ->andWhere('recipient_id', $recipientId)
            ->andWhere('seen', 0)->exec();
    }


}