<?php
declare(strict_types=1);
namespace Helper;

class Url
{
    public static function redirect(string $route): void
    {
        Logger::log('Location: ' .BASE_URL . $route);
        header('Location: ' .BASE_URL . $route);

        exit;
    }

    public static function link(string $path, ?string $param = null): string
    {
        $link = BASE_URL . $path;
        if ($param !== null) {
            $link .= '/' . $param;
        }
        return $link;
    }

    public static function slug(string $string): string
    {
        $string = strtolower($string);
        $string = str_replace(' ','-',$string);
        return $string;
    }


}
