<?php
/**
 * This file is part of Tables4DMs project.
 *
 * @license https://opensource.org/licenses/MIT The MIT License
 * @copyright 2017 Maykel S. Braz
 * @link http://github.com/maykelsb/tables4dms-api
 */

namespace Tables4dms\Provider\Controller;

/**
 * Controller for tables requests.
 *
 * @author Maykel S. Braz <maykelsb@yahoo.com.br>
 */
class TablesControllerProvider extends AbstractControllerProvider
{
    protected function tablesAction()
    {
        $this->getCc()->get('/', function(){
            return 'hiha!';
        })->bind('tables');
    }
}

