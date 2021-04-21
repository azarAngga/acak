<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TelegramStorage extends Model
{
    //
    protected $table = "telegram_storage";
    public $timestamps = false;
    protected $fillable = ['username_telegram','id_type_user_telegram','code'];
}
