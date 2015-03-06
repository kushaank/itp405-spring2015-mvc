<?php
/**
 * Created by PhpStorm.
 * User: kush2
 * Date: 3/5/15
 * Time: 3:49 PM
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class FormatDvd extends Model
{
    protected $table = 'formats';

    public function dvd()
    {
        return $this->hasMany('App\Models\Dvd');
    }
}