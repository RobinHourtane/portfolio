<?php
require dirname(__DIR__, 3) . '/app/bootstrap.php';

(new App\Controllers\Admin\ProjectController())->index();
