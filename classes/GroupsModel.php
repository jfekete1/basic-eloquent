<?php

use Illuminate\Database\Eloquent\Model as Eloquent;


class GroupsModel extends Eloquent
{

    protected $table = 'cms_groups';
    public $primaryKey = 'group_id';


    protected $fillable = [
        'group_id',
        'group_name',
        'group_desc',
        'active',
        'create_date',
        'modified_date',
    ];

    public function users()
     {
         return $this->belongsToMany('UsersModel', 'cms_user_groups', 'group_id', 'user_id');
     }

}
