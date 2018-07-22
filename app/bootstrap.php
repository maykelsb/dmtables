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

// -- Routes -------------------------------------------------------------------------
$app->register(new Silex\Provider\ServiceControllerServiceProvider());
$app->mount(
    '/{_locale}/sheets',
    new Tables4dms\Provider\Controller\SheetControllerProvider()
);
$app->mount(
    '/{_locale}/sheetitems',
    new Tables4dms\Provider\Controller\SheetitemControllerProvider()
);
$app->mount(
    '/{_locale}/users',
    new Tables4dms\Provider\Controller\UserControllerProvider()
);
