<?php
ob_start();
ob_clean();
class Admin extends loadFile
{
	public $db;
	public function __construct()
	{
		session_start();
		$this->db = $this->model('Model');
	}
	public function login()
	{
		$this->single_view("login",  array("title" => "Admin login page"));
		if (isset($_POST['login'])) {
			$email = $this->db->escape_string($_POST['email']);
			$password = $this->db->escape_string(md5($_POST['password']));
			$where = "email = '$email'  AND password ='$password' AND role_as = 0";
			$rows = '';
			$option = '';
			$record = $this->db->select_data($rows, 'users', $option, $where);
			$total = count($record);
			if (isset($_POST['remember'])) {
				setcookie("email", $email, time() + 3600);
				setcookie("password", $password, time() + 3600);
			}
			if ($total == 1) {
				$_SESSION['admin'] = $record;
				header("location:" . base_url . "Admin/home");
			} else {
				echo "<b>login fail !!</b>";
			}
		}
	}
	public function forget_password()
	{
		$this->single_view('forget_password', array("title" => "request to email"));
	}
	public function reset_password(){
		$this->single_view('reset_password', array("title" => " password reset page"));
	}
	public function logout()
	{
		session_destroy();
		header("location:" . base_url);
	}
	public function home()
	{
		$this->view('index', array("title" => "Admin dashboard"));
	}
	public function profile($id)
	{
		$select = '';
		$tbl = 'users';
		$option = '';
		$where = 'id =' . $id;
		$records = $this->db->select_data($select, $tbl, $option, $where);
		$this->view("profile", array("title" => "this is admin profile", "data" => $records));
	}
	public function update_profile($id)
	{
		$select = '';
		$tbl = 'users';
		$option = '';
		$where = 'id =' . $id;
		$records = $this->db->select_data($select, $tbl, $option, $where);
		$this->view("edit_profile", array("title" => "update profile", "data" => $records));
		if (isset($_POST['update'])) {
			$uid = $this->db->escape_string($_POST['id']);
			$first_name = $this->db->escape_string($_POST['first_name']);
			$last_name = $this->db->escape_string($_POST['last_name']);
			$dob = $this->db->escape_string($_POST['dob']);
			$old_file_name = $_POST['profile_pic_old'];
			$file_name = $_FILES['profile_pic']['name'];
			$file_size = $_FILES['profile_pic']['size'];
			$file_tmp = $_FILES['profile_pic']['tmp_name'];
			$file_type = $_FILES['profile_pic']['type'];
			if ($file_name != '') {
				$upload_file = $file_name;
			} else {
				$upload_file = $old_file_name;
			}
			if ($_FILES['profile_pic']['name'] != '') {
				if (file_exists("assets/images/admin/" . $_FILES['profile_pic']['name'])) {
					$filename = $_FILES['profile_pic']['name'];
					$_SESSION['status'] = "image already exist" . $filename;
					header("location:" . base_url . "Admin/profile/$id");
				}
			} else {
				// move_uploaded_file($file_tmp, "assets/images/admin/" . $file_name);
				$set = array("first_name" => $first_name, "last_name" => $last_name, "profile_pic" => $upload_file, "dob" => $dob);
				$condition = array("id" => $uid);
				$upd = $this->db->update_data('users', $set, $condition);
				if ($upd) {
					if ($_FILES['profile_pic']['name'] != '') {
						move_uploaded_file($file_tmp, "assets/images/admin/" . $_FILES['profile_pic']['name']);
						unlink("assets/images/admin/" . $old_file_name);
					}
					$_SESSION['status'] = "Data updated successfully";
					header("location:" . base_url . "Admin/profile/$id");
				} else {
					$_SESSION['status'] = "Data Not updated successfully";
					header("location:" . base_url . "Admin/profile/$id");
				}
			}
		}
	}
}
