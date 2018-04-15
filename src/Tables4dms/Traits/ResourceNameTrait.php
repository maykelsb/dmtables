<?php
/**
  * This file is part of Tables4DMs project.
  *
  * @license https://opensource.org/licenses/MIT The MIT License
  * @copyright 2017 Maykel S. Braz
  * @link http://github.com/maykelsb/tables4dms-api
  */

namespace Tables4dms\Traits;

/**
 * Find and store a resource name based on another class name.
 *
 * @author Maykel S. Braz <maykelsb@yahoo.com.br>
 */
trait ResourceNameTrait
{
    /**
     * @var string Resource name.
     */
    protected $resourceName;

    /**
     * Find the resource name, store and retrieve it.
     *
     * @return string
     */
    protected function getResourceName()
    {
        if (!isset($this->resourceName)) {
            $tokens = explode('\\', get_class($this));
            $tokenName = end($tokens);
            $this->resourceName = str_replace(
                [
                    'ControllerProvider',
                    'Service'
                ],
                '',
                $tokenName
            );
        }

        return $this->resourceName;
    }
}

