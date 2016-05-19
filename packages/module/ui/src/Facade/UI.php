<?php
/**
 * Created by PhpStorm.
 * User: mreza
 * Date: 1/23/16
 * Time: 6:29 PM
 */

namespace Module\UI\Facade;


use Illuminate\Support\Facades\Facade;

class UI extends Facade {

    protected static function getFacadeAccessor() { return 'ui'; }

}