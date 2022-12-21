<?php


namespace App\Supports;


class Tools
{
    /**
     * @param $string
     * @return string
     */
    public static function formatNameWithTitle($string): string
    {
        $pos = strpos($string, ',');
        $title = $name = '';
        if ($pos !== false) {
            $name = substr($string, 0, $pos);
            $title = substr($string, $pos, strlen($string));
            return (ucwords(strtolower($name)) . $title);
        }

        return $string;
    }

    /**
     * @param null $path
     * @return string
     */
    public static function publicPath($path = null)
    {
        return app()->basePath('public/' . $path);
    }

    /**
     * @param null $path
     * @return string
     */
    public static function routePath($path = null)
    {
        return app()->basePath('routes/' . $path);
    }

    /**
     * @param null $path
     * @return string
     */
    public static function modelPath($path = null)
    {
        return app()->basePath('app/Models/' . $path);
    }

    /**
     * @param null $path
     * @return string
     */
    public static function frontendPath($path = null)
    {
        $dir = explode('/', app()->basePath());
        array_pop($dir);
        if ($path) {
            $dir[] = $path;
        }
        $dir = implode('/', $dir);
        return $dir;
    }

    /**
     * @param null $path
     * @return string
     */
    public static function feMenuPath($path = null)
    {
        $dir = self::frontendPath();
        $dir .= "/src/router/menus/{$path}";
        return $dir;
    }
    /**
     * @param null $path
     * @return string
     */
    public static function feViewPath($path = null)
    {
        $dir = self::frontendPath();
        $dir .= "/src/views/{$path}";
        return $dir;
    }

    /**
     * @param null $path
     * @return string
     */
    public static function feApiPath($path = null)
    {
        $dir = self::frontendPath();
        $dir .= "/src/router/apis/{$path}";
        return $dir;
    }
}
