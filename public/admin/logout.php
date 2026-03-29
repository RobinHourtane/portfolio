<?php
require dirname(__DIR__, 2) . '/app/bootstrap.php';

(new App\Controllers\Admin\AuthController())->logout();
