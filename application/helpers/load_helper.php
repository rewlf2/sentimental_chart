<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Load_helper
{
    static protected $libraries = [];

    static function load_libraries($library_preset)
    {
        $CI = &get_instance();
        $libraries = $CI->config->item("libraries");

        if($libraries_presets = $CI->config->item("library_presets"))
        {
            if(isset($libraries_presets[$library_preset])){
                foreach($libraries_presets[$library_preset] as $each_library)
                    if(is_array($each_library))
                        self::$libraries[] = self::get_file($each_library[0] ?? $each_library["type"], $each_library[1] ?? $each_library["name"]);
                    elseif(isset($libraries[$each_library]))
                        self::$libraries[] = $libraries[$each_library];
            }
            else
            {
                throw new RuntimeException("unknown preset: $library_preset");
            }
        }
    }


    static function get_file($type, $name){
        switch($type)
        {
            case 'css':
                return '<link rel="stylesheet" type="text/css" href="' . base_url() . 'assets/css/'. $name .'.css">';
                break;
            case 'js':
                return '<script src="' . base_url() . 'assets/js/' . $name . '.js"></script>';
                break;
        }
    }

    static function load(... $libraries)
    {
        if ($libraries) array_push(self::$libraries, ...$libraries);
    }

    static function get_libraries()
    {
        return implode(self::$libraries);
    }
}