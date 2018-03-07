<?php
/**
 * This file is part of Tables4DMs project.
 *
 * @license https://opensource.org/licenses/MIT The MIT License
 * @copyright 2017 Maykel S. Braz
 * @link http://github.com/maykelsb/tables4dms-api
 */

require __DIR__ . '/../vendor/autoload.php';

use Symfony\Component\Console\Application;

$app = new Application();
$app->run();

