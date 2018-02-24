<?php
// If it is going to need the database, then it is probably smart to require it before we start.
require_once(LIB_PATH.DS."database.php");

class Specialization extends DatabaseObject{
    // this class is used for the database table named users.
    protected static $table_name = "specialization";
    protected static $db_fields = array('id',
                                        'doctor', 'body_part'
                                        );
    public $id;
    public $doctor;
    public $body_part;
    
    public static function make($body_part){
        $obj = new static;
        $obj->body_part = $body_part;
        return $obj;
    }
    public function validate_data(){
        $attributes = array('doctor', 'body_part');
        return $this->validate_attributes($attributes);
    }
    
    public static function get_for_doctor($user_id){
        $sql = "SELECT * FROM " . static::$table_name . " WHERE doctor = {$user_id}";
        $specializations = static::find_by_sql($sql);
        return $specializations;
    }
    
    public static function find_unique(){
        $sql = "SELECT distinct body_part from " . static::$table_name . " ORDER by body_part asc";
        $specializations = static::find_by_sql($sql);
        return $specializations;
    }
    
    public static function make_from_array($specializations = array()){
        $objects = array();
        foreach ($specializations as $specialization){
            $objects[] = static::make($specialization);
        }
        return $objects;
    }
}
?>