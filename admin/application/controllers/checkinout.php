<?php
ob_start();
ob_clean();
class checkinout extends loadFile
{
	public $db;
	//include model file by creating object
	public function __construct()
	{
		session_start();
		$this->db = $this->model('Model');
	}

	public function managecheckinout(){
        $this->view("checkuser", array("title" => "User check in and out page"));
    }
}
