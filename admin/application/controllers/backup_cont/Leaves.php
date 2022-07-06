<?php

class Leaves extends loadFile{
   public $db;
    public function __construct()
    {
        $this->db=$this->model('usermodel');
    }
    public function index(){
        echo "hello";
    }
    public function userview(){
        $this->view("login",array("this is user"));
    }
   
    public function data(){
       
       $this->db->delete_data('bonus',array("id"=>4));
       // $db->insert_data(array("bonus"=>5000), 'bonus');
    }
    // public function insert
}

?>