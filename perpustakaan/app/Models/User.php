<?php

namespace App\Models;

use Carbon\Carbon;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/**
 * App\Models\User
 *
 * @mixin Eloquent
 *
 * @property int                      $id
 * @property string                   $name
 * @property string                   $email
 * @property null|Carbon              $email_verified_at
 * @property int                      $is_admin
 * @property string                   $password
 * @property null|string              $remember_token
 * @property null|Carbon              $created_at
 * @property null|Carbon              $updated_at
 *
 * @property-read Collection|Borrow[] $borrows
 *
 * @method static Builder|User query()
 */
class User extends Authenticatable
{
    use HasFactory;
    use Notifiable;

    /**
     * The table associated with the model.
     *
     * @var string|null
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'email_verified_at',
        'is_admin',
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'name'              => 'string',
            'email'             => 'string',
            'email_verified_at' => 'datetime',
            'is_admin'          => 'int',
            'password'          => 'string',
            'remember_token'    => 'string',
            'created_at'        => 'datetime',
            'updated_at'        => 'datetime',
        ];
    }

    /**
     * @return HasMany|Borrow
     */
    public function borrows(): HasMany|Borrow
    {
        return $this->hasMany('App\Models\Borrow', 'user_id', 'id');
    }
}
