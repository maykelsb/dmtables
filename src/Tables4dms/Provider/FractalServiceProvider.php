<?php
/**
  * This file is part of Tables4DMs project.
  *
  * @license https://opensource.org/licenses/MIT The MIT License
  * @copyright 2017 Maykel S. Braz
  * @link http://github.com/maykelsb/tables4dms-api
  */

namespace Tables4dms\Provider;

use League\Fractal\Manager;
use Pimple\Container;
use Pimple\ServiceProviderInterface;

/**
 * Service provider to expose fractal API.
 *
 * @author Maykel S. Braz <maykelsb@yahoo.com.br>
 */
class FractalServiceProvider implements ServiceProviderInterface
{
    public function register(Container $container)
    {
        $container['fractal.manager'] = function() {
            return new Manager();
        };
    }
}

