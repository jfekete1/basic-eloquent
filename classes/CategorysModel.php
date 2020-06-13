<?php

use Illuminate\Database\Eloquent\Model as Eloquent;


class CategorysModel extends Eloquent {

     protected $table = 'cms_module_cgcalendar_categories';
     public $primaryKey = 'category_id';


     protected $fillable = [
     'category_id',
     'category_name',
     'category_bgcolor',
     'category_fgcolor',
     'category_order',
     ];


     public function events()
     {
         return $this->belongsToMany('EventsModel', 'cms_module_cgcalendar_events_to_categories', 'category_id', 'event_id');
     }

     public function users()
     {
         return $this->belongsToMany('UsersModel', 'cms_users_eventcategories', 'category_id', 'user_id');
     }
}