<?php

namespace Tir\User\Controllers;

use Tir\User\Entities\Menu;
use Tir\Crud\Controllers\CrudController;

class AdminMenuController extends CrudController
{
    protected $model = Menu::Class;

}
