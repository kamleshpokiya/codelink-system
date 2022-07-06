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

	public function users()
	{
		$tbl = 'users';
		$select = '';
		$option = '';
		$where = 'role_as != 0';
		$records = $this->db->select_data($select, $tbl, $option, $where);
		$this->view("users", array("title" => "this is user", "data" => $records));
	}

	public function add_users($admin_email)
	{
		$this->view("adduser", array("title" => "adduser form"));
		if (isset($_POST['submit'])) {

			$first_name = $this->db->escape_string($_POST['first_name']);
			$last_name = $this->db->escape_string($_POST['last_name']);
			$email = $this->db->escape_string($_POST['email']);
			$password = $this->db->escape_string(md5($_POST['password']));
			$role = $this->db->escape_string($_POST['role']);
			$gender = $this->db->escape_string($_POST['gender']);
			$to = $email;
			$subject = "your password info below :";
			$message = "this is your password :" . $_POST['password'];
			$from = $admin_email;
			$headers = "from : $from";
			echo mail($to, $subject, $message, $headers);
			$data = array("first_name" => $first_name, "last_name" => $last_name, "email" => $email, "password" => $password, "gender" => $gender, "role_as" => $role);
			$ins = $this->db->insert_data($data, 'users');
			if ($ins) {
				header("location:" . base_url . "Users/users");
			}
		}
	}

	public function delete_user()
	{
		if (isset($_REQUEST['did'])) {
			$id = $_REQUEST['did'];
			if (empty($id)) {
				echo "no record found to delete";
			} else {
				$wh = array("id" => $id);

				$del = $this->db->delete_data("users", $wh);
				if ($del) {
					$this->users();
				} else {
					echo "query failed";
				}
			}
		}
	}

	public function single_user($id)
	{
		if (isset($id)) {
			$user_id = $id;
			$tbl = 'users';
			$select = '';
			$option = '';
			$where = 'id =' . $user_id;
			$records = $this->db->select_data($select, $tbl, $option, $where);
			$this->view("single_user", array("title" => "User detail page", "data" => $records));
		}
	}

	public function edit_user()
	{
		if (isset($_REQUEST['eid'])) {
			$id = $_REQUEST['eid'];
		}
	}
}
