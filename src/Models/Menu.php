<?php

namespace Drivezy\LaravelAdmin\Models;

use Drivezy\LaravelAccessManager\Models\PermissionAssignment;
use Drivezy\LaravelAccessManager\Models\RoleAssignment;
use Drivezy\LaravelAdmin\Observers\MenuObserver;
use Drivezy\LaravelRecordManager\Models\ClientScript;
use Drivezy\LaravelRecordManager\Models\UIAction;
use Drivezy\LaravelUtility\Models\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class Menu
 * @package Drivezy\LaravelAdmin\Models
 */
class Menu extends BaseModel
{
    /**
     * @var array
     */
    public static $hidden_columns = [];
    /**
     * @var string
     */
    protected $table = 'dz_menu_details';
    protected $hidden = ['created_by', 'updated_by', 'created_at', 'updated_at', 'deleted_at'];

    /**
     * Load the observer rule against the model
     */
    public static function boot ()
    {
        parent::boot();
        self::observe(new MenuObserver());
    }

    /**
     * @return HasMany
     */
    public function modules ()
    {
        return $this->hasMany(ModuleMenu::class);
    }

    /**
     * @return HasMany
     */
    public function parent_menus ()
    {
        return $this->hasMany(ParentMenu::class);
    }

    /**
     * @return HasMany
     */
    public function child_menus ()
    {
        return $this->hasMany(ParentMenu::class, 'parent_menu_id');
    }

    /**
     * @return HasMany
     */
    public function roles ()
    {
        return $this->hasMany(RoleAssignment::class, 'source_id')->where('source_type', md5(self::class));
    }

    /**
     * @return HasMany
     */
    public function permissions ()
    {
        return $this->hasMany(PermissionAssignment::class, 'source_id')->where('source_type', md5(self::class));
    }

    /**
     * @return BelongsTo
     */
    public function page ()
    {
        return $this->belongsTo(PageDefinition::class);
    }

    /**
     * @return HasMany
     */
    public function ui_actions ()
    {
        return $this->hasMany(UIAction::class, 'source_id')->where('source_type', md5(self::class));
    }

    /**
     * @return HasMany
     */
    public function client_scripts ()
    {
        return $this->hasMany(ClientScript::class, 'source_id')->where('source_type', md5(self::class));
    }

    /**
     * @return array
     */
    public function toArray ()
    {
        if ( self::$hidden_columns )
            $this->setHidden(self::$hidden_columns);

        return parent::toArray(); // TODO: Change the autogenerated stub
    }
}
