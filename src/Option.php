<?php

namespace Summergeorge\Options;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Option extends Model
{
    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * Casts.
     *
     * @var array
     */
    protected $casts = [
        'value' => 'json',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var [type]
     */
    protected $fillable = [
        'name',
        'key',
        'value',
    ];

    /**
     * Determine if the given option value exists.
     *
     * @param  string  $key
     * @return bool
     */
    public function exists($key)
    {
        return self::where('key', $key)->exists();
    }

    /**
     * Get the specified option value.
     *
     * @param  string  $key
     * @param  mixed   $default
     * @return mixed
     */
    public function get($key, $default = null)
    {
        $cache_key = "laravel-option.".$key;
        if(Cache::has($cache_key)){
            return Cache::get($cache_key);
        }
        if ($option = self::where('key', $key)->first()) {
            Cache::put($cache_key,$option->value,3600);
            return $option->value;
        }

        //如果数据库没有指，将默认值写入数据库
        if($default){
            self::set($key,$default);
        }

        return $default;
    }

    /**
     * Set a given option value.
     *
     * @param  array|string  $key
     * @param  mixed   $value
     * @return void
     */
    public function set($key, $value = null)
    {
        $keys = is_array($key) ? $key : [$key => $value];

        foreach ($keys as $key => $value) {
            Cache::forget( "laravel-option.".$key);
            self::updateOrCreate(['key' => $key], ['value' => $value]);
        }

        // @todo: return the option
    }

    /**
     * Remove/delete the specified option value.
     *
     * @param  string  $key
     * @return bool
     */
    public function remove($key)
    {
        return (bool) self::where('key', $key)->delete();
    }
}
