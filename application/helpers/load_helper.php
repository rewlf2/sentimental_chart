<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Load_helper
{
    const highcharts = '<script src="https://cdnjs.cloudflare.com/ajax/libs/highcharts/5.0.10/highcharts.js" integrity="sha256-QXl+BEJDfotiSrbE8cZJvM3ogQvRwWaaDDkk8MYemPY=" crossorigin="anonymous"></script>',

        jquery = '<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>',

        bootstrap = '<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">',

        moment = '<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-daterangepicker/2.1.25/moment.min.js" integrity="sha256-TkEcmf5KSG2zToAaUzkq6G+GWezMQ4lEtaBiyaq6Jb4=" crossorigin="anonymous"></script>',

        daterangepicker = '<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-daterangepicker/2.1.25/daterangepicker.min.css" integrity="sha256-RqJuUJ19HEfsKUNMC+6GLSatrHeroWygib75lro4BMU=" crossorigin="anonymous" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-daterangepicker/2.1.25/daterangepicker.min.js" integrity="sha256-WniDtKHyk2OPgNtTFKu/sL8zGBzmCfMcmEKRAqfi25c=" crossorigin="anonymous"></script>',
        
        baguetteBox = '<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.8.1/baguetteBox.min.css" integrity="sha384-6FQ6OFPrf2AOjgiXGui+QNSaNlLEWEtWtQyedBVzVAK5B6VgZmvC5iOzchvV8drJ" crossorigin="anonymous">',
        
        font_awesome = '<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha256-eZrrJcwDc/3uDhsdt61sL2oOBY362qM3lon1gyExkL0=" crossorigin="anonymous" />';


    static $libraries = [];

    static function load_default_libraries()
    {
        self::$libraries[] = self::jquery;
        self::$libraries[] = self::bootstrap;

        self::$libraries[] = '<link rel="stylesheet" type="text/css" href="' . base_url() . 'assets/css/style.css">';
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