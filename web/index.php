<?php
/**
 * This file is part of Tables4DMs project.
 * 
 * @author Maykel S. Braz <maykelsb@yahoo.com.br>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @copyright 2017 Maykel S. Braz
 * @link http://github.com/maykelsb/tables4dms-api
 */

require_once __DIR__ . '/../app/bootstrap.php';

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

$app->register(new Silex\Provider\LocaleServiceProvider());
$app->register(
    new Silex\Provider\TranslationServiceProvider(),
    ['locale_fallbacks' => [$app['config']['locale.fallback']]]
)->extend('translator', function($translator, $app){
    $translator->addLoader(
        'yaml',
        new Symfony\Component\Translation\Loader\YamlFileLoader()
    );

    $translator->addResource('yaml', $app['config']['locale.lang']['en'], 'en');
    $translator->addResource('yaml', $app['config']['locale.lang']['pt_br'], 'pt_br');

    return $translator;
});

$app->register(new Tables4dms\Service\UserService())
    ->register(new Tables4dms\Service\SheetService())
    ->register(new Tables4dms\Service\SheetitemService());

$app->register(new Silex\Provider\ValidatorServiceProvider());

$app->run();

