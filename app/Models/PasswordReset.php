<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class PasswordReset extends BaseModel
{
    use HasFactory;

    public const EXPIRE_TOKEN = 60;
    public $timestamps = false;
    protected $primaryKey = null;

    /**
     * The database table used this model.
     * @var string
     */
    protected $table = 'password_resets';

    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = ['email', 'token', 'created_at'];
}
