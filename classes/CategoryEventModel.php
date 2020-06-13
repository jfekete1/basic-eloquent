<?php

use Illuminate\Database\Eloquent\Relations\Pivot;

//WE DON'T REALLY NEED THE PIVOT TABLE MODEL, WE ONLY NEED TO GIVE THE PIVOT TABLE NAME TO belongsToMany() method !
class CategoryEventModel extends Pivot
{
    protected $table = 'cms_module_cgcalendar_events_to_categories';

     protected $fillable = [
     'categoty_id',
     'event_id'
     ];
}