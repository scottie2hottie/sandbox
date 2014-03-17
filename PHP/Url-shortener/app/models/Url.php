<?php 

class Url extends Eloquent
{
  protected $fillable = array('url', 'shortened');
  public static $rules = array('url' => 'required|url');

  public static function get_unique_short_url()
  {
    $shortened = base_convert(rand(10000, 99999), 10, 36);
    $row = static::whereShortened($shortened)->first();
    if($row) {
      return static::get_unique_short_url();
    }
    return $shortened;
  }

  public static function validate($input)
  {
    $v = Validator::make($input, static::$rules);
    return $v->fails() ? $v : true;
  }
  
}