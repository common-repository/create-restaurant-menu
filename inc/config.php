<?php
/**
 * Created by PhpStorm.
 * User: ryan
 * Date: 10/23/2018
 * Time: 10:25 PM
 */
defined('ABSPATH') || exit;

$stripedtl = array(
    "store_name" => get_option('storename'),
    "menutitlefontsize" => get_option('menutitlefontsize'),
    "menuotherfontsize" => get_option('menuotherfontsize'),
    "otherbuttonbgcolor" => get_option('otherbuttonbgcolor'),
    "symb"     => get_option('currencysymb'),
    "jquery" => get_option('jquery'),
    "allergens" => get_option('allergens'),
    "allergensfontsize" => get_option('allergensfontsize'),
    "allergensfontcolor" => get_option('allergensfontcolor'),
    "bootstrapminjs" => get_option('bootstrap_minjs'),
    "fontawesomemincss" => get_option('fontawesome_mincss'),
    "bootstrapmincss" => get_option('bootstrap_mincss')
);
