<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\User;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Order extends Model
{
    use HasFactory;

    // public function orders()
    // { // объединяем таблицы user and order
    //     return $this->hasMany(User::class);
    // }
    // protected $table = 'orders'; // по дефолту добавляет -s к модели
}
