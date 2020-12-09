<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class History extends Model
{
    protected $fillable = [
        'id_user', 'id_motor', 'tglPinjam', 'tglKembali'
    ];

    public function getCreatedAtAttribute(){
        if(!is_null($this->attributes['created_at'])){
            return Carbon::parse($this->attributes['created_at'])->format('Y-m-d H:i:s');
        }
    }

    public function getUpdatedAtAttribute(){
        if(!is_null($this->attributes['created_at'])){
            return Carbon::parse($this->attributes['updated_at'])->format('Y-m-d H:i:s');
        }
    }
}
