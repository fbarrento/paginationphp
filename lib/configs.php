<?php
/**
 * Created by PhpStorm.
 * User: franciscobarrento
 * Date: 01/10/14
 * Time: 15:36
 */

define('ENVIRONMENT', 'development');

switch (ENVIRONMENT) {
    case 'development':
        error_reporting(E_ALL);
        ini_set('display_errors', 1);
        break;
    case 'production':
        break;
    default:  break;

}