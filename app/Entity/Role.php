<?php

namespace App\Entity;

use App\Http\Localization\Traits\Translatable;
use Illuminate\Database\Eloquent\Model;
use jeremykenedy\LaravelRoles\Contracts\RoleHasRelations as RoleHasRelationsContract;
use jeremykenedy\LaravelRoles\Traits\RoleHasRelations;
use jeremykenedy\LaravelRoles\Traits\Slugable;

class Role extends \jeremykenedy\LaravelRoles\Models\Role
{
    use Translatable;

    public $translatedAttributes = ['name', 'description'];
    public $fillable = ['slug', 'level'];
}
