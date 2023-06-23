<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserPermissions extends Model
{
    use HasFactory;

    protected $fillable = [
        'role',
        'route_name'
    ];

    public static function routeNameList()
    {
        return [
            'pages',
            'nav-menus',
            'dashboard',
            'users',
            'user-permissions',
            'nav-menus'
        ];
    }

    public static function isRoleHasRightToAccess($userRole, $routeName)
    {
        try {
            $model = static::where('role', $userRole)
            ->where('route_name', $routeName)
            ->first();

            return $model ? true : false;
        } catch (\Throwable $th) {
            // throw $th;
            return false;
        }
    }
}
