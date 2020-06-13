<?php

use Illuminate\Database\Eloquent\Model as Eloquent;

class EventsModel extends Eloquent {
	protected $table = 'cms_module_cgcalendar_events';
	public $primaryKey = 'event_id';
	//public $incrementing = false;
	
	protected $fillable = [
	'event_id',
	'event_title',
	'event_summary',
	'event_details',
	'event_date_start',
	'event_date_end',
	'event_parent_id',
	'event_recur_period',
	'event_date_recur_end',
	'event_created_by',
	'event_create_date',
	'event_modified_date',
	'event_recur_nevents',
	'event_recur_interval',
	'event_recur_weekdays',
	'event_recur_monthdays',
	'event_allows_overlap',
	'event_all_day',
	'event_status',
	];

	public function categorys()
    {
        return $this->belongsToMany('CategorysModel', 'cms_module_cgcalendar_events_to_categories', 'event_id', 'category_id');
	}
	
}




