<?php

namespace Service\PriceChangeInformer;

use Helper\DBHelper;
use Model\Ad;
use Model\Message;
use Model\User;

class Cron
{
    public function exec()
    {
        $db = new DBHelper();
        $data = $db->select()->from('price_informer_queue')->limit(100)->get();
        foreach ($data as $element){
            $user = new User();
            $user->load($element['user_id']);
            $ad = new Ad($element['ad_id']);
            $messageText = " Sveiki <a href=".BASE_URL."catalog/show/".$ad->getSlug().">Nuoroda i skelbima</a> " .$user->getName(). " Automobilis " . $ad->getTitle(). " pakeite kaina ";
            $message = new Message();

            $message->setMessage($messageText);
            $message->setRecipientId($user->getId());
            $message->setSenderId(1);
            $message->setSeen(0);
            $message->save();
            $db = new DBHelper();
            $db->delete()->from('price_informer_queue')->where('id', $element['id'])->exec();
        }
    }
}
