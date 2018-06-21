<?php

namespace Drivezy\LaravelAdmin\Models;

use Drivezy\LaravelAccessManager\Models\PermissionAssignment;
use Drivezy\LaravelAccessManager\Models\RoleAssignment;
use Drivezy\LaravelAdmin\Observers\MenuObserver;
use Drivezy\LaravelUtility\Models\BaseModel;

/**
 * Class Menu
 * @package Drivezy\LaravelAdmin\Models
 */
class Menu extends BaseModel {
    /**
     * @var string
     */
    protected $table = 'dz_menu_details';
    /**
     * @var array
     */
    public static $hidden_columns = [];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function modules () {
        return $this->hasMany(ModuleMenu::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function parent_menus () {
        return $this->hasMany(ParentMenu::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function child_menus () {
        return $this->hasMany(ParentMenu::class, 'parent_menu_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function roles () {
        return $this->hasMany(RoleAssignment::class, 'source_id')->where('source_type', self::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function permissions () {
        return $this->hasMany(PermissionAssignment::class, 'source_id')->where('source_type', self::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function page () {
        return $this->belongsTo(PageDefinition::class);
    }

    /**
     * @return array
     */
    public function toArray () {
        if ( self::$hidden_columns )
            $this->setHidden(self::$hidden_columns);

        return parent::toArray(); // TODO: Change the autogenerated stub
    }

    /**
     * Load the observer rule against the model
     */
    public static function boot () {
        parent::boot();
        self::observe(new MenuObserver());
    }
}