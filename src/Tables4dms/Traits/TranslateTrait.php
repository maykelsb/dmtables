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
 * Translate text according to the current locale..
 *
 * @author Maykel S. Braz <maykelsb@yahoo.com.br>
 */
trait TranslateTrait
{

    protected function trans($text)
    {
        return $this->app['translator']->trans($text);
    }
}

