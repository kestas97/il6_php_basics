<?php

namespace Controller;

use Core\AbstractController;
use Helper\CsvParser;
use Model\Ad;

class Export extends AbstractController
{

    public function exec(){
        $ads = Ad::getAllAds();

        $adsArray = [];
        foreach ($ads as $key => $ad){
            $adsArray[$key]['title'] = $ad->getTitle();
            $adsArray[$key]['description'] = $ad->getDescription();
            $adsArray[$key]['year'] = $ad->getYear();
            $adsArray[$key]['price'] = $ad->getPrice();
            $adsArray[$key]['image'] = $ad->getImage();
            $adsArray[$key]['slug'] = $ad->getSlug();
            $adsArray[$key]['views'] = $ad->getViews();
        }

        $csv = PROJECT_ROOT_DIR. '/var/export/ads.csv';
        CsvParser::createCsv($csv, $adsArray);

    }

}
