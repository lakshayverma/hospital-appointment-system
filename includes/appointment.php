<?php
// If it is going to need the database, then it is probably smart to require it before we start.
require_once(LIB_PATH.DS."database.php");

class Appointment extends DatabaseObject{
    // this class is used for the database table named users.
    protected static $table_name = "appointment";
    protected static $db_fields = array('id',
                                        'doctor', 'patient', 
                                        'at', 'about', 
                                        'description', 'remarks'
                                        );
    public $id;
    public $doctor;
    public $patient;
    public $at;
    public $about;
    public $description;
    public $remarks;
    
    public static function make($doctor, $patient,
                       $at, $about,
                       $description){
        $obj = new self;
        $obj->doctor = $doctor;
        $obj->patient = $patient;
        $obj->at = $at;
        $obj->about = $about;
        $obj->description = $description;
        return $obj;
    }
    public function validate_data(){
        $attributes = array('doctor', 'patient', 
                            'at', 'about', 
                            'description'
                            );
        return $this->validate_attributes($attributes);
    }
    
    public static function get_for_doctor($user_id){
        $sql = "SELECT * FROM " . static::$table_name . " WHERE doctor = {$user_id} order by at desc";
        $appointments = static::find_by_sql($sql);
        return $appointments;
    }
    public static function get_for_user($user_id){
        $sql = "SELECT * FROM " . static::$table_name . " WHERE patient = {$user_id} order by at desc";
        $appointments = static::find_by_sql($sql);
        return $appointments;
    }
    
    public function valid(){
        $specializations = Specialization::get_for_doctor($this->doctor);
        
        foreach($specializations as $specializaiton){
            if($specializaiton->body_part == $this->about){
                return TRUE;
            }
        }
        return FALSE;
    }
}
?>