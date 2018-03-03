<?php

namespace App\Entity;

use App\Http\Localization\Traits\Translatable;
use Illuminate\Database\Eloquent\Model;
use jeremykenedy\LaravelRoles\Contracts\PermissionHasRelations as PermissionHasRelationsContract;
use jeremykenedy\LaravelRoles\Traits\PermissionHasRelations;
use jeremykenedy\LaravelRoles\Traits\Slugable;

class Permission extends \jeremykenedy\LaravelRoles\Models\Permission
{
    use Translatable;

    public $translatedAttributes = ['name', 'description'];
    public $fillable = ['slug', 'model'];
}
