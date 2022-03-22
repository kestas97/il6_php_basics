<?php

namespace Controller;

use Core\AbstractController;
use Model\Ad;

class Export extends AbstractController
{
    public function export()
    {
        $ads = Ad::getAllAds();

        $file = fopen('../var/export/ads.csv', 'a');

        //reikia headerio : kaip title, description...
        fputcsv($file, $ads);
        foreach ($file as $row){
            fputcsv($file, $row);
        }
        fclose($file);



    }
}
