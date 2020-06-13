<?php

use Illuminate\Database\Eloquent\Model as Eloquent;


class UsersModel extends Eloquent
{

    protected $table = 'cms_users';
    public $primaryKey = 'user_id';


    protected $fillable = [
        'user_id',
        'asdasd',
        'username',
        'password',
        'admin_access',
        'first_name',
        'last_name',
        'email',
        'active',
        'create_date',
        'modified_date',
    ];

    //WE DON'T REALLY NEED THE PIVOT TABLE MODEL, WE ONLY NEED TO GIVE THE PIVOT TABLE NAME TO belongsToMany() method !
    public function groups()
    {
        return $this->belongsToMany('GroupsModel', 'cms_user_groups', 'user_id', 'group_id');
    }
    
    public function categorys(){
        return $this->belongsToMany('CategorysModel', 'cms_users_eventcategories', 'user_id', 'category_id');
    }


}
