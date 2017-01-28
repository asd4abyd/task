<?php
/**
 * Created by PhpStorm.
 * User: Abdelqader Osama
 * Date: 1/27/17
 * Time: 6:09 PM
 */

namespace App;


use Illuminate\Database\Eloquent\Model;

class Category extends Model {

    public static function article() {
        return self::where('type', 0)->get();
    }

    public static function product() {
        return self::where(['type'=>1])->get();
    }
}