<?php
/**
 * Created by PhpStorm.
 * User: mreza
 * Date: 1/23/16
 * Time: 6:29 PM
 */

namespace App\Backend\Navigation\Facade;


use Illuminate\Support\Facades\Facade;

class Navigation extends Facade {

    protected static function getFacadeAccessor() { return 'navigation'; }

}