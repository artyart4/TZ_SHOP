<?php
declare(strict_types=1);

namespace App\Http\Models;



use Illuminate\Database\Eloquent\Model;

trait HasSlug
{
    protected static $increment = false;
    protected static $inc = 1;
    protected static function bootHasSlug( bool $increment = false): void
    {
        self::$increment = $increment;
        static ::creating(function (Model $model)
        {
           self::$increment === true ? $model->{self::slugFrom()}.=1 : str($model->{self::slugFrom()})->append(time())->slug();      //TODO вместо тайма добавить метод который будет проверять нет ли в базе уже такого слага, если есть то добавляем какой-то знак в конец
//            dd($model->{self::slugFrom()});
            if ($model->query()->where('slug',$model->slug)->first()){
                self::bootHasSlug(true);
            }

           return $model->slug;
        });
    }

    public static function slugFrom():string
    {
        return 'title';
    }

    protected static function checkUnique($string, $model){

         if($model->where('slug', $string)->first())
         {
             $newString = $string.= (string)rand(1,10);
             return $newString;
         }else return $string;
    }
}
