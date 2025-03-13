<?php

$pageUrl = urldecode(
    parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH)
);

if ($pageUrl !== '/' && file_exists(__DIR__.'/public'.$pageUrl)) {
    // Serve public assets
    readfile(__DIR__.'/public'.$pageUrl);
} elseif (str_starts_with($pageUrl, '/api/')) {
    // API routing
    require_once __DIR__.'/public/api.php';
} else {
    // Entrypoint to dashboard and website pages
    require_once __DIR__ . '/public/index.php';
}

return true;
