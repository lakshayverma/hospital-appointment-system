<?php

// If it is going to need the database, then it is probably smart to require it before we start.
require_once(LIB_PATH . DS . "database.php");

class User extends DatabaseObject {

    // this class is used for the database table named users.
    protected static $table_name = "user";
    protected static $db_fields = array('id',
        'first_name', 'last_name',
        'username', 'password',
        'dob', 'address',
        'mobile', 'email',
        'type'
    );
    public $id;
    public $first_name;
    public $last_name;
    public $username;
    public $password;
    public $dob;
    public $address;
    public $mobile;
    public $email;
    public $type;
    public $specializations;
    private static $user_types = array('Doctor', 'Senior Doctor', 'Patient');

    public static function make($first_name, $last_name, $username, $password, $dob, $address, $mobile, $email, $type, $specializations
    ) {
        $obj = new self;
        $obj->first_name = $first_name;
        $obj->last_name = $last_name;
        $obj->username = $username;
        $obj->password = $password;
        $obj->dob = $dob;
        $obj->address = $address;
        $obj->mobile = $mobile;
        $obj->email = $email;
        $obj->type = self::resolve_type($type);
        if ($obj->type != 'Patient') {
            $obj->specializations = Specialization::make_from_array($specializations);
        }
        return $obj;
    }

    public function validate_data() {
        $attributes = array('first_name', 'last_name',
            'username', 'password',
            'dob', 'address',
            'mobile', 'email',
            'type'
        );
        return $this->doc_specs() & $this->validate_attributes($attributes) & is_numeric($this->mobile) & !is_numeric($this->first_name) & !is_numeric($this->last_name);
    }
    
    private function doc_specs(){
        if($this->type == 'Patient'){
            return TRUE;
        }else{
            if(!empty($this->specializations)){
                return TRUE;
            }  else {
                return FALSE;
            }
        }
    }

    public function save() {
        $doc = parent::save();
        foreach ($this->specializations as $specialization) {
            $specialization->doctor = $this->id;
            $spec = $specialization->save();
        }
        return $doc && $spec;
    }

    public static function resolve_type($type = "") {
        foreach (static::$user_types as $available) {
            if (strtolower($available) == strtolower($type)) {
                return $available;
            }
        }
        return $available;
    }

    public static function authenticate($username = "", $password = "") {
        global $database;

        $username = $database->escape_value($username);
        $password = $database->escape_value($password);

        $sql = "SELECT * FROM " . static::$table_name . " ";
        $sql .= "WHERE username = '{$username}' ";
        $sql .= "AND password = '{$password}' ";
        $sql .= "LIMIT 1";

        $result_array = static::find_by_sql($sql);
        return !empty($result_array) ? array_shift($result_array) : false;
    }

    public function is_admin() {
        if ($this->type != 'Patient') {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function full_name() {
        if (isset($this->first_name) && isset($this->last_name)) {
            return $this->first_name . " " . $this->last_name;
        } else {
            return "";
        }
    }

    public function introduce() {
        return $this->type . " " . $this->full_name() . $this->specializations();
    }

    public function specializations() {
        if (!isset($this->specializations)) {
            $this->specializations = Specialization::get_for_doctor($this->id);
        }
        $spcl = "";
        foreach ($this->specializations as $specialization) {
            $spcl .= ", {$specialization->body_part}";
        }
        return $spcl;
    }

    public static function find_all_of_type($type) {
        $type = static::resolve_type($type);
        $sql = "SELECT * FROM " . static::$table_name . " where type = '{$type}'";
        $users = static::find_by_sql($sql);
        return $users;
    }

}

?>