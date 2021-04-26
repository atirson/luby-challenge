<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Ramsey\Uuid\Rfc4122\NilTrait;
use App\Models\Concerns\UsesUuid;;

class Student extends Model
{
    use HasFactory, UsesUuid;

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($post) {
            $post->{$post->getKeyName()} = (string) Str::uuid();
        });
    }

    public function getIncrementing()
    {
        return false;
    }

    public function getKeyType()
    {
        return 'string';
    }

    /**
     * @var string
     */
    protected $table = 'student';

    /**
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * @var bool
     */
    public $incrementing = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'number_registration',
        'series',
        'gender',
        'age',
        'phone',
        'cpf',
        'address',
        'test_grade',
        'status',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'name' => 'string',
        'number_registration' => 'string',
        'series' => 'integer',
        'gender' => 'string',
        'age' => 'integer',
        'phone' => 'string',
        'cpf' => 'string',
        'address' => 'string',
        'test_grade' => 'integer',
        'status' => 'string',
        'created_at' => 'timestamp',
        'updated_at' => 'timestamp',
    ];
}
