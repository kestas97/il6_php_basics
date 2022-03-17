<?php

declare(strict_types=1);

namespace Model;

use Core\AbstractModel;
use Core\Interfaces\ModelInterface;
use Helper\DBHelper;

class SavedAd extends AbstractModel implements ModelInterface
{
    protected const TABLE = 'saved_ads';

    private int $userId;

    private int $adId;

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

    public function setAdId(int $adId)
    {
        $this->adId = $adId;
    }

    public function assignData(): void
    {
        $this->data = [
            'ad_id' => $this->adId,
            'user_id' => $this->userId
        ];
    }

    public function load(int $id): ?object
    {
        $db = new DBHelper();
        $rez = $db->select()->from(self::TABLE)->where('id', $id)->getOne();

        if (!empty($rez)) {
            $this->id = (int)$rez['id'];
            $this->adId = (int)$rez['ad_id'];
            $this->userId = (int)$rez['user_id'];
            return $this;
        }
        return null;
    }


    public function loadByUserAndAd(int $userId, int $adId): ?object
    {
        $db = new DBHelper();
        $rez = $db->select()
            ->from(self::TABLE)
            ->where('user_id', $userId)
            ->andWhere('ad_id', $adId)
            ->getOne();
        if (!empty($rez)){
            $this->load((int)$rez['id']);
            return $this;
        }
        return null;
    }

    public static function getUsersFavoriteAds(int $userId): array
    {
        $db = new DBHelper();
        $data = $db->select()->from(self::TABLE)->where('user_id', $userId)->get();
        $ads = [];
        foreach ($data as $element){
            $ad = new Ad();
            $ad->load((int)$element['ad_id']);
            $ads[] = $ad;
        }
        return $ads;

    }
}
