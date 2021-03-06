<?php

namespace Tir\Menu\Entities;

use Astrotomic\Translatable\Translatable;
use Tir\Crud\Support\Eloquent\CrudModel;
use Tir\Store\Category\Entities\Category;

class Menu extends CrudModel
{
    //Additional trait insert here

    use Translatable;

    /**
     * The attribute show route name
     * and we use in fieldTypes and controllers
     *
     * @var string
     */
    public static $routeName = 'menu';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'is_active'];


    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'is_active' => 'boolean',
    ];


    /**
     * The attributes that are translatable.
     *
     * @var array
     */
    public $translatedAttributes = ['name'];

    /**
     * The relations to eager load on every query.
     *
     * @var array
     */
    protected $with = ['translations'];


    /**
     * This function return array for validation
     *
     * @return array
     */
    public function getValidation()
    {
        return [
            'name' => 'required',
        ];
    }


    /**
     * This function return an object of field
     * and we use this for generate admin panel page
     * @return Object
     */
    public function getFields()
    {
        $fields = [
            [
                'name' => 'basic_information',
                'type' => 'group',
                'visible'    => 'ce',
                'tabs'=>  [
                    [
                        'name'  => 'menu_information',
                        'type'  => 'tab',
                        'visible'    => 'ce',
                        'fields' => [
                            [
                                'name'       => 'id',
                                'type'       => 'text',
                                'visible'    => 'io',
                            ],
                            [
                                'name'      => 'name',
                                'type'      => 'text',
                                'placeholder'=> 'Please type a name for menu exampel "header"',
                                'validation' => 'required',
                                'visible'   => 'ice',
                            ],
                            [
                                'name'    => 'status',
                                'type'    => 'select',
                                'placeholder'=> 'Please select the status',
                                'validation' => 'required',
                                'data'    => ['published' => trans('menu::panel.published'), 'unpublished' => trans('menu::panel.unpublished')],
                                'visible' => 'ce',
                            ],

                        ]
                    ]
                ]
            ]
        ];
        return $fields;}

    //Additional methods //////////////////////////////////////////////////////////////////////////////////////////////

    public static function for($menuId)
    {
        return static::findOrNew($menuId)
            ->menuItems()
            ->with(['category', 'page'])
            ->get()
            ->noCleaning()
            ->nest();
    }



    //Relations methods ///////////////////////////////////////////////////////////////////////////////////////////////

    public function menuItems()
    {
        return $this->hasMany(MenuItem::class)->orderByRaw('-position DESC');
    }

}
