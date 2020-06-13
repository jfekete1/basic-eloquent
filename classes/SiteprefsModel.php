<?php
use Illuminate\Database\Eloquent\Model as Eloquent;


class SiteprefsModel extends Eloquent {

     protected $table = 'cms_siteprefs';
     public $primaryKey = 'sitepref_name';


     protected $fillable = [
     'sitepref_name',
     'sitepref_value',
     'create_date',
     'modified_date',
     ];

}