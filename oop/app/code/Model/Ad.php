<?php

declare(strict_types=1);
namespace Model;

use Core\Interfaces\ModelInterface;
use Helper\DBHelper;
use Core\AbstractModel;
use Helper\Logger;

class Ad extends AbstractModel implements ModelInterface
{
    protected const TABLE = 'ads';

    private string $title;

    private string $description;

    private int $manufacturerId;

    private int $modelId;

    private float $price;

    private int $year;

    private int $typeId;

    private int $userId;

    private string $image;

    private int $active;

    private string $slug;

    private string $createdAt;

    private int $views;



    public function __construct(?int $id = null)
    {

        if($id !== null){
            $this->load($id);
        }

    }

    /**
     * @return mixed
     */
//    public function getId()
//    {
//        return $this->id;
//    }


    /**
     * @return mixed
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param mixed
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    /**
     * @return mixed
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getManufacturerId(): int
    {
        return $this->manufacturerId;
    }

    /**
     * @param mixed $manufacturerId
     */
    public function setManufacturerId(int $manufacturerId): void
    {
        $this->manufacturerId = $manufacturerId;
    }

    /**
     * @return mixed
     */
    public function getModelId(): int
    {
        return $this->modelId;
    }

    /**
     * @param mixed $modelId
     */
    public function setModelId(int $modelId): void
    {
        $this->modelId = $modelId;
    }

    /**
     * @return mixed
     */
    public function getPrice(): float
    {
        return $this->price;
    }

    /**
     * @param mixed $price
     */
    public function setPrice(float $price): void
    {
        $this->price = $price;
    }

    /**
     * @return mixed
     */
    public function getYear(): int
    {
        return $this->year;
    }

    /**
     * @param mixed $year
     */
    public function setYear(int $year): void
    {
        $this->year = $year;
    }

    /**
     * @return mixed
     */
    public function getTypeId(): int
    {
        return $this->typeId;
    }

    /**
     * @param mixed $typeId
     */
    public function setTypeId(int $typeId): void
    {
        $this->typeId = $typeId;
    }

    /**
     * @return mixed
     */
    public function getUserId(): int
    {
        return $this->userId;
    }

    /**
     * @param mixed $userId
     */
    public function setUserId(int $userId): void
    {
        $this->userId = $userId;
    }

    public function getImage(): string
    {
        return $this->image;
    }

    public function setImage(string $image): void
    {
        $this->image = $image;
    }

    public function isActive(): int
    {
        return $this->active;
    }

    public function setActive(int $active): void
    {
        $this->active = $active;
    }

    public function getSlug(): string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): void
    {
        $this->slug = $slug;
    }

    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }



    public function getViews(): int
    {
        return $this->views;
    }


    public function setViews(int $views): void
    {
        $this->views = $views;
    }

    public function getUser(): User
    {
        return new User($this->userId);
    }




    public function assignData(): void
    {
        $this->data = [
            'title' => $this->title,
            'description' => $this->description,
            'manufacturer_id' => $this->manufacturerId,
            'model_id' => $this->modelId,
            'price' => $this->price,
            'year' => $this->year,
            'type_id' => $this->typeId,
            'user_id' => $this->userId,
            'image' => $this->image,
            'active' => $this->active,
            'slug' => $this->slug,
            'views'=> $this->views
        ];
    }






    public function load(int $id): Ad
    {
        $db = new DBHelper();
        $ad = $db->select()->from(self::TABLE)->where('id', $id)->getOne();
        if(!empty($ad)){
            $this->id = (int)$ad['id'];
            $this->title = $ad['title'];
            $this->manufacturerId = (int)$ad['manufacturer_id'];
            $this->description = $ad['description'];
            $this->modelId = (int)$ad['model_id'];
            $this->price = (float)$ad['price'];
            $this->year = (int)$ad['year'];
            $this->typeId = (int)$ad['type_id'];
            $this->userId = (int)$ad['user_id'];
            $this->image = $ad['image'];
            $this->active = (int)$ad['active'];
            $this->slug = $ad['slug'];
            $this->createdAt = $ad['created_at'];
            $this->views = (int)$ad['views'];
        }

        Logger::log($ad['active'] .'belekas');
        return $this;

    }

    public function loadBySlug(string $slug): ?Ad
    {
        $db = new DBHelper();
        $rez = $db->select()->from(self::TABLE)->where('slug', $slug)->getOne();
        if(!empty($rez)){
            $this->load((int)$rez['id']);
            return $this;
        }else{
            return null;
        }
    }


    public static function getAllAds(): array
    {
        $db = new DBHelper();
        $data = $db->select()->from(self::TABLE)->where('active', 1)->get();
        $ads = [];
        foreach ($data as $element) {
            $ad = new Ad();
            $ad->load((int)$element['id']);
            $ads[] = $ad;
        }
        return $ads;
    }

    public static function getPopularOne(int $limit): array
    {
        $db = new DBHelper();
        $data = $db->select()
            ->from(self::TABLE)
            ->where('active', 1)
            ->orderBy("views", 'DESC')
            ->limit($limit)
            ->get();
        $ads = [];
        foreach ($data as $element) {
            $ad = new Ad();
            $ad->load((int)$element['id']);
            $ads[] = $ad;
        }
        return $ads;


    }

    public static function getNewest(int $limit): array
    {
        $db = new DBHelper();
        $data = $db->select()
            ->from(self::TABLE)
            ->where('active', 1)
            ->orderBy("created_at", 'ASC')
            ->limit($limit)
            ->get();
        $ads = [];
        foreach ($data as $element) {
            $ad = new Ad();
            $ad->load((int)$element['id']);
            $ads[] = $ad;
        }
        return $ads;

    }

    public static function getPagenes(int $offset, int $limit): array
    {
        $db = new DBHelper();
        $data = $db->select()
            ->from(self::TABLE)
            ->where('active', 1)
            ->limit($limit)
            ->offSet($offset)
            ->get();
        $ads = [];
        foreach ($data as $element) {
            $ad = new Ad();
            $ad->load((int)$element['id']);
            $ads[] = $ad;
        }
        return $ads;


    }

}