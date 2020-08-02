<?php

namespace Tir\Menu\Entities;

use Astrotomic\Translatable\Translatable;
use Tir\Crud\Support\Eloquent\CrudModel;
use Tir\Crud\Support\Facades\Crud;

class MenuItem extends CrudModel
{
    use Translatable;

    /**
     * The attribute show route name
     * and we use in fieldTypes and controllers
     *
     * @var string
     */
    public static $routeName = 'menuItem';

    /**
     * The table associated with the model.
     *
     * @var string
     */
    public $table = 'menu_items';

    /**
     * The relations to eager load on every query.
     *
     * @var array
     */
    protected $with = ['translations'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'menu_id',
        'parent_id',
        'url',
        'target',
        'position',
        'status',
    ];

    /**
     * The attributes that are translatable.
     *
     * @var array
     */
    public $translatedAttributes = ['name'];


    /**
     * This function return array for validation
     *
     * @return array
     */
    public function getValidation()
    {
        return [
            'name'      => 'required',
            'type'      => 'required',
            'menu_id'   => 'required',
            'status'    => 'required',
        ];
    }


    /**
     * This function return an object of field
     * and we use this for generate admin panel page
     * @return array
     */
    public function getFields()
    {
        return [
            [
                'name'    => 'basic_information',
                'type'    => 'group',
                'visible' => 'ce',
                'tabs'    => [
                    [
                        'name'    => 'menu_information',
                        'type'    => 'tab',
                        'visible' => 'ce',
                        'fields'  => [
                            [
                                'name'    => 'id',
                                'type'    => 'text',
                                'visible' => 'io',
                            ],
                            [
                                'name'    => 'name',
                                'type'    => 'text',
                                'visible' => 'iec',
                            ],
                            [
                                'name'     => 'menu_id',
                                'display'  => 'menu',
                                'type'     => 'relation',
                                'relation' => ['menu', 'name'],
                                'visible'  => 'ce'
                            ],
                            [
                                'name'    => 'parent_id',
                                'display' => 'parent',
                                'type'    => 'relation',
                                'relation' => ['parent', 'name'],
                                'visible'  => 'ce',
                            ],
                            [
                                'name'    => 'target',
                                'type'    => 'select',
                                'data'    => ['_blank' => trans('menuItem::panel.blank')],
                                'visible' => 'ce',
                            ],
                            [
                                'name'    => 'position',
                                'type'    => 'position',
                                'visible' => 'ce',
                            ],
                            [
                                'name'    => 'status',
                                'type'    => 'select',
                                'data'    => ['published' => trans('menu::panel.published'), 'unpublished' => trans('menu::panel.unpublished')],
                                'visible' => 'ce',
                            ],
                            [
                                'name'    => 'url',
                                'type'    => 'text',
                                'visible' => 'ce',
                            ]
                        ]
                    ]
                ]
            ]
        ];
    }


    //Relations ///////////////////////////////////////////////////////////////////////////////////////////////////////
    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }

    public function children()
    {
        return $this->hasMany(MenuItem::class, 'parent_id');
    }

    public function parent()
    {
        return $this->belongsTo(MenuItem::class, 'parent_id');
    }

    /**
     * Determine if the menu item has any children.
     *
     * @return bool
     */
    public function hasChildren()
    {
        return $this->items->isNotEmpty();
    }

}
