<?php
require 'Core/Route.php';

use Core\Route;

$main = new Route();

$main -> index($_SERVER['REQUEST_URI']);