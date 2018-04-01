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
$loader = require __DIR__ . '/../vendor/autoload.php';

$app = new Silex\Application();
$app->register(
    new Lokhman\Silex\Provider\ConfigServiceProvider(),
    ['config.dir' => __DIR__ . '/../app/config']
);

$app['debug'] = $app['config']['debug'];

$app->register(
    new Silex\Provider\DoctrineServiceProvider(),
    $app['config']['database']
)->register(
    new Dflydev\Provider\DoctrineOrm\DoctrineOrmServiceProvider(),
    $app['config']['orm']
);

$app->register(new Tables4dms\Provider\FractalServiceProvider());
$app->register(
    new Basster\Silex\Provider\Swagger\SwaggerProvider(),
    $app['config']['swagger']
);

// -- Fix to Doctrine annotations find Swagger namespace
Doctrine\Common\Annotations\AnnotationRegistry::registerLoader([
    $loader,
    'loadClass'
]);

$app->register(new Silex\Provider\ServiceControllerServiceProvider());
$app->mount('/sheets', new Tables4dms\Provider\Controller\SheetControllerProvider())
    ->mount('/users', new Tables4dms\Provider\Controller\UserControllerProvider())
    ->run();

