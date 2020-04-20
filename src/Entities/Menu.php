<?php

namespace Tir\Store\Attribute\Entities;

use Astrotomic\Translatable\Translatable;
use Tir\Crud\Support\Eloquent\CrudModel;
use Tir\Store\Category\Entities\Category;

class Menu extends CrudModel
{
    //Additional trait insert here

    use Translatable;


    public static $routeName = 'attribute';

    protected $fillable = ['name', 'is_filterable','attribute_set_id'];

    protected $with = ['translations'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'is_filterable' => 'boolean',
    ];



    public $translatedAttributes = ['name'];



    public function getValidation()
    {
        return [
            'name' => 'required',
        ];
    }


    public function getFields()
    {
        $fields = [
            [
                'name' => 'basic-information',
                'type' => 'group',
                'visible'    => 'ce',
                'tabs'=>  [
                    [
                        'name'  => 'menu-information',
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
                                'translation'   => true,
                                'visible'   => 'icef',
                            ]

                        ]
                    ]
                ]
            ]
        ];


        return json_decode(json_encode($fields));
    }


    public function values()
    {
        return $this->hasMany(AttributeValue::class)->orderBy('position');
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class)->orderBy('position');
    }


}
