<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserBloodGroup extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'blood_group',
    ];

    protected $table='UserBloodGroup';

    public function getBloodGroup(){
        return $this->blood_group;
    }

    public function user(){
        return $this->belongsTo(User::class, 'id');
    }
}
