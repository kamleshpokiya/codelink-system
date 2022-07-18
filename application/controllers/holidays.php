<?php

class holidays extends loadFile
{
    public $db;

    public function __construct()
    {
        session_start();
        $this->db = $this->model('Model');
    }


    // TO show holidays
    public function viewholidays()
    {
        $this->view('holidays', array("title" => 'Apply for Leave'));

    }
    

}
?>
