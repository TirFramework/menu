<?php

namespace Tir\Menu\Controllers;

use Tir\Crud\Controllers\CrudController;
use Tir\Menu\Entities\MenuItem;

class AdminMenuItemController extends CrudController
{
    protected $model = MenuItem::Class;

}
