<?php
/**
 * author : tama asrory
 * email : tamaasrory@gmail.com
 */

namespace App\Models\Base;

use App\Traits\Searchable;
use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Laravel\Lumen\Auth\Authorizable;
use Spatie\Permission\Traits\HasRoles;

/**
 * Class User
 *
 * @package App
 * @property string $id
 * @property string $name
 * @property string $no_hp
 * @property array $role
 * @property string $email
 * @property string $email_verified_at
 * @property string $password
 * @property array $detail
 * @property string $remember_token
 * @property string $created_at
 * @property string $updated_at
 * @property string|null $role_id
 * @property-read mixed $perm
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\Permission\Models\Permission[] $permissions
 * @property-read int|null $permissions_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\Permission\Models\Role[] $roles
 * @property-read int|null $roles_count
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User permission($permissions)
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User role($roles, $guard = null)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereDetail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class User extends SelfModel implements AuthenticatableContract, AuthorizableContract
{
    use Authenticatable, Authorizable, HasRoles, Searchable;

    protected $guard_name = 'api';
    protected $table = 'users';
    protected $primaryKey = 'id';
    public $incrementing = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'name',
        'email',
        'password',
        'detail',
    ];

    /**
     * The attributes that are searchable.
     *
     * @var array
     */
    public $searchable = [
        'id',
        'name',
        'email',
        'email_verified_at',
        'detail',
        'created_at',
        'updated_at',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'roles','permissions'
    ];

    protected $casts = [
        'detail' => 'json',
        'email_verified_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public $appends = [
        'role',
        'perm',
    ];

    public function getRoleAttribute()
    {
        return $this->getRoleNames()->toArray();
    }

    public function getPermAttribute()
    {
        return $this->getPermissionsViaRoles()->pluck('name');
    }
}
