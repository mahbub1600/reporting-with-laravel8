<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'father_name',
        'mother_name',
    ];
    protected $table='User';

    /**
     * @param int $dataCount
     */
    public static function testLoad($dataCount=100){
        $users = self::factory()->count($dataCount)->hasGroup(UserBloodGroup::factory())->create();
        return;
    }

    /**
     * The relationships that should always be loaded.
     *
     * @var array
     */
    #protected $with = [UserBloodGroup::class];

    public function group(){
        return $this->hasOne(UserBloodGroup::class, 'user_id', 'id');
    }

    public static function getUserWithBloodGroup(){
        return User::with('Group:blood_group')->get();

    }
}
