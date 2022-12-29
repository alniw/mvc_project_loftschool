<?php

namespace App\Model\Eloquent;

use Illuminate\Database\Eloquent\Model;

/**
 * Class User
 *
 * @package App\Model\Eloquent
 *
 * @property $id
 * @property $password
 * @property $name
 * @property $email
 */
class User extends Model
{
    protected $table = 'users';
    public $timestamps = false;

    protected $fillable = [
        'name',
        'password',
        'email',
        'registration_datetime',
    ];

    public static function getByEmail(string $email)
    {
        self::query()->where('email', '=', $email)->first();
        return self::query()->where('email', '=', $email)->first();
    }

    public static function getById(int $id)
    {
        return self::query()->find($id);
    }

    public static function getList(int $limit = 10, int $offset = 0)
    {
        return self::query()->limit($limit)->offset($offset)->orderBy('id', 'DESC')->get();
    }

    public static function getPasswordHash(string $password)
    {
        return sha1('abyrvalg!291' . $password);
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    public function isAdmin(): bool
    {
        return in_array($this->id, ADMIN_IDS);
    }
}
