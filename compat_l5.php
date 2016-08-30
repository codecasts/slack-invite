<?php

if (!function_exists('config_path')) {
    /**
     * Return the path to config files.
     *
     * @param null $str
     *
     * @return string
     */
    function config_path($str = null)
    {
        return rtrim(realpath(__DIR__.'/config/'.$str), '/');
    }
}

if (!function_exists('public_path')) {
    /**
     * Return the path to public dir.
     *
     * @param null $str
     *
     * @return string
     */
    function public_path($str = null)
    {
        return rtrim(realpath(__DIR__.'/public/'.$str), '/');
    }
}

if (!function_exists('elixir')) {
    /**
     * Get the path to a versioned Elixir file.
     *
     * @param string $file
     *
     * @return string
     */
    function elixir($file)
    {
        static $manifest = null;
        if (is_null($manifest)) {
            $manifest = json_decode(file_get_contents(public_path().'/build/rev-manifest.json'), true);
        }
        if (isset($manifest[$file])) {
            return '/build/'.$manifest[$file];
        }
        throw new InvalidArgumentException("File {$file} not defined in asset manifest.");
    }
}
