<?php
ob_start();
ob_clean();
class user_check_inout extends loadFile
{
	public $db;
	//include model file by creating object
	public function __construct()
	{
		session_start();
		$this->db = $this->model('Model');
	}

	public function view_user_checkinout(){

		 $select = array("a.id","a.first_name","a.last_name","a.profile_pic","c.*","ul.*");
		 $tbl = 'users a';
		 $option = array(
			 "join" => array(
				 array(
					 "type" => "LEFT JOIN",
					 "table" => "(
						SELECT user_id,MAX(leaves.leave_from) leave_from,MAX(leaves.leave_to) leave_to,leaves.leave_type 
						FROM leaves
					GROUP BY
						user_id
					) ul",
					 "condition" => "ul.user_id = a.id"
					 ),
				 array(
					 "type" => "LEFT JOIN",
					 "table" => "(
						SELECT
							user_id,MAX(user_in_out.time_in) time_in,MAX(user_in_out.time_out) time_out
						FROM
							user_in_out
						WHERE
							user_in_out.date = CURDATE()
						GROUP BY
							user_id
					) c",
					 "condition" => "c.user_id = a.id"
				 )
			 )
			 //"GROUP_BY" => array("users.first_name")  
			 // "HAVING" => array("salary > 20000"),
			 // "ORDER_BY" => array("first_name ASC"),
			 //"LIMIT" => array("3"),
			 //"OFFSET" => ""
		 );

		 $where = '';

		$records = $this->db->select_data($select, $tbl, $option, $where);
		// echo '<pre>';
		// print_r($records); 	
		// die;
        
        $this->view("checkuser", array("title" => "User check in and out page", 'users' => $records));
    }
	
}
