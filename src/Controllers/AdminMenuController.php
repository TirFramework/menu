<?php

namespace Tir\Menu\Controllers;

use Tir\Menu\Entities\Menu;
use Tir\Crud\Controllers\CrudController;

class AdminMenuController extends CrudController
{
    protected $model = Menu::Class;

}
