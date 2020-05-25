<?php

namespace Tir\Menu\Entities;

use Astrotomic\Translatable\Translatable;
use Tir\Crud\Support\Eloquent\CrudModel;
use Tir\Crud\Support\Facades\Crud;
use Tir\Page\Entities\Page;
use Tir\Store\Category\Entities\Category;
use TypiCMS\NestableTrait;

class MenuItem extends CrudModel
{
    use Translatable, NestableTrait;

    /**
     * The attribute show route name
     * and we use in fieldTypes and controllers
     *
     * @var string
     */
    public static $routeName = 'menuItems';

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
        'category_id',
        'page_id',
        'parent_id',
        'type',
        'url',
        'target',
        'position',
        'is_root',
        'is_fluid',
        'is_active',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'is_root' => 'boolean',
        'is_fluid' => 'boolean',
        'is_active' => 'boolean',
    ];

    /**
     * The attributes that are translatable.
     *
     * @var array
     */
    public $translatedAttributes = ['name'];

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

//        static::addGlobalScope('not_root', function ($query) {
//            $query->where('is_root', false);
//        });

    }



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
                                'visible'   => 'ice',
                            ],
                            [
                                'name' => 'menu_id',
                                'type' => 'relation',
                                'relation' => ['menu', 'name'],
                                'visible' => 'ce'
                            ],
                            [
                                'name'      => 'parent_id',
                                'type'      => 'text',
                                'visible'   => 'ce',
                            ],
                            [
                                'name'      => 'target',
                                'type'      => 'text',
                                'visible'   => 'ce',
                            ],
                            [
                                'name'      => 'position',
                                'type'      => 'position',
                                'visible'   => 'ce',
                            ],
                            [
                                'name' => 'type',
                                'type' => 'select',
                                'placeholder' => 'select',
                                'data' => ['category' => trans('menu::panel.category'),
                                           'page'     => trans('menu::panel.page'),
                                           'url'      => trans('menu::panel.url')],

                                'script'    => '
                                
                                    $(`[name="category_id"]`).parents(".form-group").addClass("d-none");
                                    $(`[name="page_id"]`).parents(".form-group").addClass("d-none");
                                    $(`[name="url"]`).parents(".form-group").addClass("d-none");

                                    typeSelect( $(`[name="type"]`).val() );

                                    console.log( $(`[name="type"]`).val() );
                                    
                                    $(`[name="type"]`).on("change", function() {
                                        typeSelect( $(this).val() );
                                    });

                                    function typeSelect(element){
                                        if(element == "category"){

                                            $(`[name="category_id"]`).parents(".form-group").removeClass("d-none");
                                            $(`[name="page_id"]`).parents(".form-group").addClass("d-none");
                                            $(`[name="url"]`).parents(".form-group").addClass("d-none");

                                        } 

                                        if(element == "page"){

                                            $(`[name="category_id"]`).parents(".form-group").addClass("d-none");
                                            $(`[name="page_id"]`).parents(".form-group").removeClass("d-none");
                                            $(`[name="url"]`).parents(".form-group").addClass("d-none");

                                        } 

                                        if(element == "url"){

                                            $(`[name="category_id"]`).parents(".form-group").addClass("d-none");
                                            $(`[name="page_id"]`).parents(".form-group").addClass("d-none");
                                            $(`[name="url"]`).parents(".form-group").removeClass("d-none");

                                        } 
                                    }
                                ',
                                'visible' => 'ce'
                            ],




                            [
                                'name'      => 'url',
                                'type'      => 'text',
                                'visible'   => 'ce',
                            ],

                            [
                                'name' => 'category_id',
                                'type' => 'relation',
                                'relation' => ['category', 'name'],
                                'visible' => 'ce'
                            ],

                            [
                                'name' => 'page_id',
                                'type' => 'relation',
                                'relation' => ['page', 'name'],
                                'visible' => 'ce'
                            ],




                            [
                                'name'       => 'is_root',
                                'type'       => 'select',
                                'data'       => ['1'=>trans('menu::panel.yes'),'0'=>trans('menu::panel.no')],
                                'visible'    => 'ce',
                            ],
                            [
                                'name'       => 'is_fluid',
                                'type'       => 'select',
                                'data'       => ['1'=>trans('menu::panel.yes'),'0'=>trans('menu::panel.no')],
                                'visible'    => 'ce',
                            ],
                            [
                                'name'       => 'is_active',
                                'type'       => 'select',
                                'data'       => ['1'=>trans('menu::panel.yes'),'0'=>trans('menu::panel.no')],
                                'visible'    => 'ce',
                            ]

                        ]
                    ]
                ]
            ]
        ];
        return json_decode(json_encode($fields));
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

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function page()
    {
        return $this->belongsTo(Page::class);
    }

    /**
     * Set the menu item's page id.
     *
     * @param int $pageId
     * @return void
     */
    public function setPageIdAttribute($pageId)
    {
        $this->attributes['page_id'] = $pageId;
    }

    /**
     * Set the menu item's parent id.
     *
     * @param int $parentId
     * @return void
     */
    public function setParentIdAttribute($parentId)
    {
        $this->attributes['parent_id'] = $parentId;
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

    /**
     * Determine if the menu item type is category.
     *
     * @return bool
     */
    public function isCategoryType()
    {
        return $this->type === 'category';
    }

    /**
     * Determine if the menu item type is page.
     *
     * @return bool
     */
    public function isPageType()
    {
        return $this->type === 'page';
    }

    /**
     * Determine if the menu item type is url.
     *
     * @return bool
     */
    public function isUrlType()
    {
        return $this->type === 'url';
    }

    /**
     * Returns the public url for the menu item.
     *
     * @return string
     */
    public function url()
    {
        if ($this->isCategoryType()) {
            return optional($this->category)->url();
        }

        if ($this->isPageType()) {
            return optional($this->page)->url();
        }

        if ($this->getAttributeFromArray('url') === '#') {
            return '#';
        }

        return Crud::localized_url(Crud::locale(), $this->getAttributeFromArray('url'));
    }

    /**
     * Get the root menu item for the given menu id.
     *
     * @param int $menuId
     * @return $this
     */
    public static function root($menuId)
    {
        return static::withoutGlobalScope('not_root')
            ->where('menu_id', $menuId)
            ->firstOrFail();
    }

    /**
     * Get the parents of the given menuId.
     *
     * @param int $menuId
     * @param int $menuItemId
     * @return array
     */
    public static function parents($menuId, $menuItemId)
    {
        return static::withoutGlobalScope('active')
            ->where('id', '!=', $menuItemId)
            ->where('menu_id', $menuId)
            ->get()
            ->noCleaning()
            ->nest()
            ->setIndent('¦–– ')
            ->listsFlattened('name');
    }
}
