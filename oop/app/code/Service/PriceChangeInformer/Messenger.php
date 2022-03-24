<?php

namespace Service\PriceChangeInformer;

use Model\SavedAd;
use Helper\DBHelper;
class Messenger
{
    public function setMessages($adId)
    {
        $usersIds = SavedAd::getUsersIdsByAd($adId);

        foreach ($usersIds as $usersId){
            $db = new DBHelper();
            $data = [
                'user_id' => $usersId,
                'ad_id' => $adId
            ];
            $db->insert('price_informer_queue', $data)->exec();

        }
    }
}
