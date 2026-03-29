<?php
require dirname(__DIR__) . '/app/bootstrap.php';

(new App\Controllers\PageController())->about();
