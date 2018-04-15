<?php
/**
  * This file is part of Tables4DMs project.
  *
  * @license https://opensource.org/licenses/MIT The MIT License
  * @copyright 2017 Maykel S. Braz
  * @link http://github.com/maykelsb/tables4dms-api
  */

namespace Tables4dms\Service;

/**
 * Provide basic functions to find, retrieve, transform and return data.
 *
 * @author Maykel S. Braz <maykelsb@yahoo.com.br>
 * @abstract
 */
abstract class AbstractService
{
    use \Tables4dms\Traits\ResourceNameTrait;

    /**
     * @var Silex\Application
     */
    protected $app;

    final public function __construct(Silex\Application $app)
    {
        $this->app = $app;
        $this->getResourceName(); 
    }

    /**
     * Get a reference for the entity manager.
     *
     * @param string $name Entity manager name.
     * @return \Doctrine\ORM\EntityManager
     */
    protected function getEntityManager($name = 'default')
    {
        return $this->app['orm.ems'][$name];
    }

    /**
     * Return a reference for a entity repository.
     *
     * @param string $resourceName Resource name.
     * @return \Doctrine\ORM\EntityRepository
     */
    protected function getRepository($resourceName = null)
    {
        if (is_null($resourceName)) {
            $resourceName = $this->getResourceName();
        }

        $entityName = "{$this->app['config']['app.package']}\\Entity\\{$resourceName}";

        return $this->getEntityManager()
            ->getRepository($entityName);
    }
}

