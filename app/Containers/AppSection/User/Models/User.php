<?php

namespace App\Containers\AppSection\User\Models;

use App\Containers\AppSection\Auth\Enums\Role as RoleEnum;
use App\Containers\AppSection\User\Data\Collections\UserCollection;
use App\Ship\Parents\Models\UserModel as ParentUserModel;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

final class User extends ParentUserModel
{
    protected $fillable = [
        'email',
        'password',
        'role',
        'manager_id',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'immutable_datetime',
        'password' => 'hashed',
    ];

    public function newCollection(array $models = []): UserCollection
    {
        return new UserCollection($models);
    }

    /**
     * Allows Passport to find the user by email (case-insensitive).
     */
    public function findForPassport(string $username): self|null
    {
        return self::orWhereRaw('lower(email) = lower(?)', [$username])->first();
    }

    public function manager(): BelongsTo
    {
        return $this->belongsTo(self::class, 'manager_id');
    }

    public function employees(): HasMany
    {
        return $this->hasMany(self::class, 'manager_id');
    }

    public function isManager(): bool
    {
        return $this->role === RoleEnum::MANAGER->value;
    }

    public function isEmployee(): bool
    {
        return $this->role === RoleEnum::EMPLOYEE->value;
    }

    protected function email(): Attribute
    {
        return new Attribute(
            get: static fn (string|null $value): string|null => is_null($value) ? null : strtolower($value),
        );
    }
}
