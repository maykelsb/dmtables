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
require __DIR__ . '/../vendor/autoload.php';

$app = new Silex\Application();
$app->register(
    new Lokhman\Silex\Provider\ConfigServiceProvider(),
    ['config.dir' => __DIR__ . '/../app/config']
);

$app['debug'] = $app['config']['debug'];

$app->register(
    new Silex\Provider\DoctrineServiceProvider(),
    ['db.options' => $app['config']['db.options']]
)->register(
    new Dflydev\Provider\DoctrineOrm\DoctrineOrmServiceProvider(),
    $app['config']['orm']
);

$app->register(new Silex\Provider\ServiceControllerServiceProvider());

$app->mount('/tables', new Tables4dms\Provider\Controller\TablesControllerProvider())
    ->mount('/users', new Tables4dms\Provider\Controller\UsersControllerProvider())
    ->run();

