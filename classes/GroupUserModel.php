<?php

use Illuminate\Database\Eloquent\Relations\Pivot;

//WE DON'T REALLY NEED THE PIVOT TABLE MODEL, WE ONLY NEED TO GIVE THE PIVOT TABLE NAME TO belongsToMany() method !
class GroupUserModel extends Pivot
{
    protected $table = 'cms_user_groups';

     protected $fillable = [
     'group_id',
     'user_id'
     ];
}