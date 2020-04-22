<?php

namespace Tir\Menu\Entities;


use Tir\Crud\Support\Eloquent\TranslationModel;

class MenuItemTranslation extends TranslationModel
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name'];
}
