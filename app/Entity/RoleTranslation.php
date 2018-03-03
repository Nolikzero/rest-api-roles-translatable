<?php

namespace App\Entity;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use jeremykenedy\LaravelRoles\Contracts\PermissionHasRelations as PermissionHasRelationsContract;
use jeremykenedy\LaravelRoles\Traits\PermissionHasRelations;
use jeremykenedy\LaravelRoles\Traits\Slugable;

class RoleTranslation extends Model
{
    public $timestamps  = false;
    protected $fillable = ['name', 'description'];
}
