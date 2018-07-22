<?php
/**
  * This file is part of Tables4DMs project.
  *
  * @license https://opensource.org/licenses/MIT The MIT License
  * @copyright 2017 Maykel S. Braz
  * @link http://github.com/maykelsb/tables4dms-api
  */

namespace Tables4dms\Entity;

/**
 * Base methods for entities.
 * @author Maykel S. Braz <maykelsb@yahoo.com.br>
 */
class AbstractEntity
{
    public function __set($field, $value)
    {
        $method = "set". ucfirst($field);
        if (is_callable([$this, $method])) {
            $this->$method($value);
            return $this;
        }
        throw new \Exception(get_class($this) . "::{$method}() is not defined.");
    }
}

