<?php
/**
 * Created by PhpStorm.
 * User: kush2
 * Date: 3/5/15
 * Time: 3:50 PM
 */

namespace App\Models;
use Illuminate\Database\Eloquent\Model;


class SoundDvd extends Model{

    protected $table = 'sounds';
    public function dvd()
    {
        return $this->hasMany('App\Models\Dvd');
    }
}