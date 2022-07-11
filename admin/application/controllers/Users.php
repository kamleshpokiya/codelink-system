<?php
ob_start();
ob_clean();
class Users extends loadFile
{
	public $db;
	public function __construct()
	{
		session_start();
		$this->db = $this->model('Model');
	}
	//users detail page
	public function users()
	{
		$tbl = 'users';
		$select = '';
		$option = '';
		$where = 'role_as != 0';
		$records = $this->db->select_data($select, $tbl, $option, $where);
		$this->view("users", array("title" => "this is user", "data" => $records));
	}
	//add user method
	public function add_users()
	{
		$this->view("adduser", array("title" => "adduser form"));
		if (isset($_POST['submit'])) {
			$first_name = $this->db->escape_string($_POST['first_name']);
			$last_name = $this->db->escape_string($_POST['last_name']);
			$email = $this->db->escape_string($_POST['email']);
			$password = $this->db->escape_string(md5($_POST['password']));
			$role = $this->db->escape_string($_POST['role']);
			$gender = $this->db->escape_string($_POST['gender']);
			// $to = $email;
			// $subject = "your password info below :";
			// $message = "this is your password :" . $_POST['password'];
			// $from = $admin_email;
			// $headers = "from : $from";
			// echo mail($to, $subject, $message, $headers);
			$data = array("first_name" => $first_name, "last_name" => $last_name, "email" => $email, "password" => $password, "gender" => $gender, "role_as" => $role);
			$ins = $this->db->insert_data($data, 'users');
			if ($ins) {
				$_SESSION['user_msg'] = "User add successfully";
				header("location:" . base_url . "Users/users");
			}
		}
	}
	//delete user
	public function delete_user()
	{
		if (isset($_REQUEST['did'])) {
			$id = $_REQUEST['did'];
			$wh = array("id" => $id);
			$del = $this->db->delete_data("users", $wh);
		}
	}
	// single user detail page
	public function single_user($id)
	{
		if (isset($id)) {
			$select = array("users.id", "users.first_name", "users.last_name", "users.gender", "users.email", "users.dob", "users.contact", "users.alt_contact", "users.address", "users.profile_pic", "users.role_as", "(users.credits - SUM(leaves.from_credit)) as total_credits");
			$tbl = 'users';
			$option = array(
				"join" => array(
					array(
						"type" => "INNER JOIN",
						"table" => "leaves",
						"condition" => "users.id = leaves.user_id"
					)
				)
				// "GROUP_BY" => array("users.id")
				// "HAVING" => array("salary > 20000"),
				// "ORDER_BY" => array("first_name ASC"),
				//"LIMIT" => array("3"),
				//"OFFSET" => ""
			);
			$user_id = $id;
			$where = 'users.id =' . $user_id;
			$records = $this->db->select_data($select, $tbl, $option, $where);
			$this->view("single_user", array("title" => "User detail page", "data" => $records));
		}
	}
	// For showing user profile
	public function edit_single_user($id)
	{
		if (isset($id)) {
			$user_id = $id;
			$tbl = 'users';
			$select = '';
			$option = '';
			$where = 'id =' . $user_id;
			$records = $this->db->select_data($select, $tbl, $option, $where);
			$this->view("edit_single_user", array("title" => "Edit User Profile", "data" => $records));
			// $this -> edit_user_profile();

		}
	}
	// For update user profile
	public function edit_user_profile()
	{
		if (isset($_POST)) {

			$data = [
				$array = [
					"field" => "first_name",
					"value" => $_POST['first_name'],
					"required" => true,
					"is_string" => true
				],
				$array = [
					"field" => "last_name",
					"value" => $_POST['last_name'],
					"required" => true,
					"is_string" => true
				],
				$array = [
					"field" => "email",
					"value" => $_POST['email'],
					"required" => true,
					"email" => true
				],
				$array = [
					"field" => "gender",
					"value" => $_POST['gender'],
					"required" => true
				],
				$array = [
					"field" => "dob",
					"value" => $_POST['dob'],
					"required" => true
				],
				$array = [
					"field" => "role_as",
					"value" => $_POST['role_as'],
					"required" => true
				],
				$array = [
					"field" => "contact",
					"value" => $_POST['contact'],
					"required" => true,
					"mob_number" => true
				],
				$array = [
					"field" => "alt_contact",
					"value" => $_POST['alt_contact'],
					"required" => true,
					"mob_number" => true
				],
				$array = [
					"field" => "address",
					"value" => $_POST['address'],
					"required" => true
				],
			];

			if (isset($_FILES['file']['name'])) {
				$array1 = [
					"field" => "size",
					"value" => $_FILES['file']['size'],
					"required" => true,
					"size" => true
				];

				$array2 = [
					"field" => "type",
					"value" => $_FILES['file']['type'],
					"required" => true,
					"type" => true
				];

				array_push($data, $array1);
				array_push($data, $array2);
			}
			$res = $this->Validate($data);

			if ($res == 1) {
				$id = $_POST['id'];
				unset($_POST['id']);

				if (isset($_FILES['file']['name'])) {
					$_POST['profile_pic'] = $_FILES['file']['name'];
				}
				$condition = array(
					'id' => $id
				);

				$resupdate = $this->db->update_data('users', $_POST, $condition);
				if ($resupdate) {
					$msg['update_success'] = 'User profile updated successfully..';
					echo json_encode($msg);
				}
			}
		}
	}
}
