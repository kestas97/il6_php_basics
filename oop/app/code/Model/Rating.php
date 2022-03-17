<?php

declare(strict_types=1);
namespace Model;

use Core\AbstractModel;
use Core\Interfaces\ModelInterface;
use Helper\DBHelper;

class Rating extends AbstractModel implements ModelInterface
{
    protected const TABLE = 'rating';
    private int $userId;
    private int $adId;
    private int $rating;

    public function __construct(?int $id = null)
    {


        if ($id !== null) {
            $this->load($id);
        }
    }

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function setUserId(int $userId): void
    {
        $this->userId = $userId;
    }

    public function getAdId(): int
    {
        return $this->adId;
    }

    public function setAdId(int $adId): void
    {
        $this->adId = $adId;
    }

    public function getRating(): int
    {
        return $this->rating;
    }

    public function setRating(int $rating): void
    {
        $this->rating = $rating;
    }


    public function assignData(): void
    {
        $this->data = [
            'user_id' => $this->userId,
            'ad_id' => $this->adId,
            'rating' => $this->rating
        ];
    }

    public function load(int $id): ?Rating
    {
        $db = new DBHelper();
        $rez = $db->select()->from(self::TABLE)->where('id', $id)->getOne();
        if (!empty($rez)) {
            $this->id = (int)$rez['id'];
            $this->userId = (int)$rez['user_id'];
            $this->adId = (int)$rez['ad_id'];
            $this->rating = (int)$rez['rating'];
            return $this;
        }
        return null;
    }

    public function getUser()
    {
        $user = new User();
        $user->load($this->userId);
        return $user;
    }

    public function getAd()
    {
        $ad = new Ad();
        $ad->load($this->adId);
        return $ad;
    }

    public function loadByUserAndAd(int $userId, int $adId): ?Rating
    {
        $db = new DBHelper();
        $rez = $db->select()->from(self::TABLE)->where('user_id', $userId)->andWhere('ad_id', $adId)->getOne();

        if (!empty($rez)) {
            $this->load((int)$rez['id']);
            return $this;
        }

        return null;
    }

    public static function getRatingsByAd(int $adId): array
    {
        $db = new DBHelper();
        return $db->select()->from(self::TABLE)->where('ad_id',$adId)->get();
    }

    public static function getRatingByUser(int $adId, int $userId): int
    {
        $db = new DBHelper();
        $rez = $db->select()->from(self::TABLE)->where('ad_id', $adId)->andWhere('user_id', $userId)->getOne();
        return $rez['rating'];

    }

}
