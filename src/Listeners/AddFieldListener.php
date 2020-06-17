<?php

namespace Tir\Menu\Listeners;



use Tir\Crud\Events\GetCrudEvent;

class AddFieldListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {

    }


    public function handle(GetCrudEvent $getCrudEvent)
    {
        if($getCrudEvent->crud->name == 'menuItem'){
            $crud = $getCrudEvent->crud;

            $newfields = (object)[
                'name'    => 'is_active',
                'type'    => 'select',
                'data'    => ['1' => trans('menu::panel.yes'), '0' => trans('menu::panel.no')],
                'visible' => 'ce',
            ];
            array_push($crud->fields{0}->tabs{0}->fields, $newfields);
            return $crud;
        }else{
            return $getCrudEvent->crud;
        }

    }
}
