<?php
/**
  * This file is part of Tables4DMs project.
  *
  * @license https://opensource.org/licenses/MIT The MIT License
  * @copyright 2017 Maykel S. Braz
  * @link http://github.com/maykelsb/tables4dms-api
  */

namespace Tables4dms\Exception;

/**
 * An exception class to store validation errors associated to its fields.
 *
 * @author Maykel S. Braz <maykelsb@yahoo.com.br>
 */
class ValidationException
    extends \Exception
    implements \Iterator, \ArrayAccess
{
    use \Tables4dms\Traits\HashMapTrait;
}

