<?php

global $pageUrl;

use App\Api\Pages;

require __DIR__.'/../vendor/autoload.php';

// Entrypoint for the website pages
switch ($pageUrl) {
    case '/':
    case '/dashboard':
        echo '<style>';
        include 'css/dashboard.css';
        echo '</style>';

        $pages = (new Pages())->getData();
        include 'views/dashboard.html.php';

        echo '<script type="text/javascript">';
        include 'js/dashboard.js';
        echo '</script>';

        break;
    default:
        include 'views/website.html';
}