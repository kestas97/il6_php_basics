<?php

namespace Controller;

use Core\AbstractController;
use Core\Interfaces\ControllerInterface;
use Helper\CsvParser;
use Helper\Url;
use Model\Ad;

class Import extends AbstractController
{


    public function execute()
    {
        $csvPath = PROJECT_ROOT_DIR . '/var/import/ads.csv';
        $adsArray = CsvParser::parseCsv($csvPath);
        if ($adsArray !== FALSE){
            foreach ($adsArray as $adData){
                $ad = new Ad();
                $slug = Url::slug($adData['title']);
                while (!Ad::isValuelUnic('slug', $slug)){
                    $slug = $slug . rand(0, 100);
                }
                $ad->setTitle($adData['title']);
                $ad->setDescription($adData['description']);
                $ad->setYear((int)$adData['year']);
                $ad->setManufacturerId(1);
                $ad->setModelId(1);
                $ad->setPrice((float)$adData['price']);
                $ad->setImage($adData['image']);
                $ad->setActive(1);
                $ad->setViews(0);
                $ad->setSlug($slug);
                $ad->setTypeId(1);
                $ad->setUserId(24);
                $ad->save();
            }
            unlink($csvPath);
        }else{
            echo 'Nera tinkamo csv failo';
        }

    }
}