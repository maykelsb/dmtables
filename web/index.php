<?php
/**
 * This file is part of Tables4DMs project.
 * 
 * @author Maykel S. Braz <maykelsb@yahoo.com.br>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @copyright 2017 Maykel S. Braz
 * @link http://github.com/maykelsb/tables4dms-api
 */

/**
 * Composer autoload
 */
require_once __DIR__ . '/../vendor/autoload.php';

$app = new Silex\Application();

$app['debug'] = true;

$app->register(new Silex\Provider\ServiceControllerServiceProvider());

$app->run();

