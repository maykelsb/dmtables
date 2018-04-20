<?php
/**
 * This file is part of Tables4DMs project.
 *
 * @license https://opensource.org/licenses/MIT The MIT License
 * @copyright 2017 Maykel S. Braz
 * @link http://github.com/maykelsb/tables4dms-api
 */

namespace Tables4dms\DTO;

/**
 * Data transfer object to Messages.
 *
 * @author Maykel S. Braz <maykelsb@yahoo.com.br>
 */
class MessageDTO
{
    const TYPE_ERROR = 'error';
    const TYPE_SUCCESS = 'success';
    const TYPE_EXCEPTION = 'exception';
    const TYPE_WARNING = 'warning';

    public $type;
    public $message;
}

