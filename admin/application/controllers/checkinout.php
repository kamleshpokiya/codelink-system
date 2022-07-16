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
		//  $select = '`user_in_out`.*, `users`.`first_name`, `users`.`last_name`, `leaves`.*';
		//  $tbl = '`user_in_out`, `users`'; 
		 $select = array("user_in_out.*", "users.first_name", "users.last_name", "leaves.*");
		 $tbl = 'user_in_out, users';
		 $option = array(
			 "join" => array(
				 array(
					 "type" => "LEFT JOIN",
					 "table" => "leaves",
					 "condition" => "leaves.user_id = users.id"
				 )
			 )
			 //"GROUP_BY" => array("users.first_name")  
			 // "HAVING" => array("salary > 20000"),
			 // "ORDER_BY" => array("first_name ASC"),
			 //"LIMIT" => array("3"),
			 //"OFFSET" => ""
		 );
// 		 SELECT user_in_out.*, users.first_name, users.last_name, leaves.*
// FROM user_in_out, users 
// LEFT JOIN leaves ON leaves.user_id = users.id;

// SELECT  users.id, users.first_name, users.last_name, leaves.leave_type, leaves.leave_from, leaves.leave_to FROM leaves RIGHT JOIN users ON leaves.user_id=users.id

 

// $select = array("user_in_out.*", "users.first_name", "users.last_name", "leaves.*");
//         $tbl = 'user_in_out, users';
//         $option = array(
//             "join" => array(
//                 array(
//                     "type" => "LEFT JOIN",
//                     "table" => "leaves",
//                     "condition" => "leaves.user_id = users.id"
//                 )
//             )
//             //"GROUP_BY" => array("users.first_name")  
//             // "HAVING" => array("salary > 20000"),
//             // "ORDER_BY" => array("first_name ASC"),
//             //"LIMIT" => array("3"),
//             //"OFFSET" => ""
//         );
		 $where = '';

		$records = $this->db->select_data($select, $tbl, $option, $where);
		echo '<pre>';
		print_r($records); 
		die;
        $user_in_out_obj = [];
		$leaves_obj= [];
        
        $this->view("checkuser", array("title" => "User check in and out page", 'users' => $records));
    }
	
}
