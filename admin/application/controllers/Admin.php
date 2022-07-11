<?php
ob_start();
ob_clean();
class Admin extends loadFile
{
	public $db;
	//include model file by creating object
	public function __construct()
	{
		session_start();
		$this->db = $this->model('Model');
	}

	//admin login  
	public function login()
	{
		$this->single_view("login",  array("title" => "Admin login page"));
		if (isset($_POST['login'])) {
			if ($_POST['email'] == '' && $_POST['password'] == '') {
				$_SESSION['msg'] = "Please Enter email address and password";
				header("location:" . base_url);
			} elseif ($_POST['email'] == '') {
				$_SESSION['msg'] = "Please Enter email address";
				header("location:" . base_url);
			} elseif ($_POST['password'] == '') {
				$_SESSION['msg'] = "Please Enter password";
				header("location:" . base_url);
			} else {
				$email = $this->db->escape_string($_POST['email']);
				$password = $this->db->escape_string(md5($_POST['password']));
				$where = "email = '$email' AND role_as = 0";
				$select = '';
				$option = '';
				$record = $this->db->select_data($select, 'users', $option, $where);
				$wh = "password ='$password' AND email = '$email' AND role_as = 0";
				$rows = '';
				$options = '';
				$record2 = $this->db->select_data($rows, 'users', $options, $wh);
				if ($record == '') {
					$_SESSION['msg'] = "email is not exist ";
					header("location:" . base_url);
				} elseif ($record2 == '') {
					$_SESSION['msg'] = "password is invalid";
					header("location:" . base_url);
				} else {
					$_SESSION['msg'] = "Enter valid email and password";
					header("location:" . base_url);
				}

				$total = count($record);
				$total2 = count($record2);
				if (isset($_POST['remember'])) {
					setcookie("email", $email, time() + 3600);
					setcookie("password", $password, time() + 3600);
				}
				if ($total == 1 && $total2 == 1) {
					$_SESSION['admin'] = $record;
					header("location:" . base_url . "Admin/home");
				}
			}
		}
	}
	//this method for forget password 
	public function forget_password()
	{
		$this->single_view('forget_password', array("title" => "request to email"));
		if (isset($_POST['getemail'])) {
			if ($_POST['email'] == '') {
				$_SESSION['error'] = "Please enter your email address";
				header("location:" . base_url . "Admin/forget_password");
			} else {
				$email = $this->db->escape_string($_POST['email']);
				$where = "email = '$email'  AND role_as = 0";
				$rows = '';
				$option = '';
				$record = $this->db->select_data($rows, 'users', $option, $where);
				$total = count($record);
				if ($total == 1) {
					header("location:" . base_url . "Admin/reset_password/$email");
				} else {
					$_SESSION['error'] = "email is not exist";
					header("location:" . base_url . "Admin/forget_password");
				}
			}
		}
	}
	//after get link change password
	public function reset_password($email)
	{
		$this->single_view('reset_password', array("title" => " password reset page"));
		if (isset($_POST['setpassword'])) {
			if (($_POST['password']) == '') {
				$_SESSION['error_msg'] = "Enter your password";
				header("location:" . base_url . "Admin/reset_password/$email");
			} elseif (($_POST['cnf_password']) == '') {
				$_SESSION['error_msg'] = "Reenter your password";
				header("location:" . base_url . "Admin/reset_password/$email");
			} elseif (($_POST['password']) != ($_POST['cnf_password'])) {
				$_SESSION['error_msg'] = "confirm password is not match with password";
				header("location:" . base_url . "Admin/reset_password/$email");
			} else {
				$password = $this->db->escape_string(md5($_POST['password']));
				$set = array("password" => $password);
				$condition = array("email" => $email);
				$upd = $this->db->update_data('users', $set, $condition);
				if ($upd) {
					$_SESSION['error_msg'] = "your password update successfully";
					header("location:" . base_url . "Admin/reset_password/$email");
				} else {
					$_SESSION['error_msg'] = "your password is not updated";
					header("location:" . base_url . "Admin/reset_password/$email");
				}
			}
		}
	}
	// logout method
	public function logout()
	{
		session_destroy();
		header("location:" . base_url);
	}
	// admin dash board
	public function home()
	{
		$this->view('index', array("title" => "Admin dashboard"));
	}
	
	//update admin profile by id 
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
				if (file_exists("assets/images/admin/" . $upload_file)) {
					$_SESSION['status'] = "image already exist" . $upload_file;
					header("location:" . base_url . "Admin/update_profile/$id");
				} else {
					if ($upload_file != '') {
						move_uploaded_file($file_tmp, "assets/images/admin/" . $_FILES['profile_pic']['name']);
						unlink("assets/images/admin/" . $old_file_name);
						$set = array("first_name" => $first_name, "last_name" => $last_name, "profile_pic" => $upload_file, "dob" => $dob);
						$condition = array("id" => $uid);
						$upd = $this->db->update_data('users', $set, $condition);
						if ($upd) {
							$_SESSION['status'] = "Data updated successfully";
							header("location:" . base_url . "Admin/update_profile/$id");
						} else {
							$_SESSION['status'] = "Data Not updated";
							header("location:" . base_url . "Admin/update_profile/$id");
						}
					}
				}
			} else {
				$upload_file = $old_file_name;
				$set = array("first_name" => $first_name, "last_name" => $last_name, "profile_pic" => $upload_file, "dob" => $dob);
				$condition = array("id" => $uid);
				$upd = $this->db->update_data('users', $set, $condition);
				if ($upd) {
					$_SESSION['status'] = "Data updated successfully";
					header("location:" . base_url . "Admin/update_profile/$id");
				} else {
					$_SESSION['status'] = "Data Not updated";
					header("location:" . base_url . "Admin/update_profile/$id");
				}
			}
		} else {
			if (isset($_POST['changepassword'])) {
				if (($_POST['old_password']) == '') {
					$_SESSION['change_status'] = "Enter your old password";
					header("location:" . base_url . "Admin/update_profile/$id");
				} elseif (($_POST['password']) == '') {
					$_SESSION['change_status'] = "Enter your new password";
					header("location:" . base_url . "Admin/update_profile/$id");
				} elseif (($_POST['cnf_password']) == '') {
					$_SESSION['change_status'] = "Enter confirm password";
					header("location:" . base_url . "Admin/update_profile/$id");
				} elseif (($_POST['password']) != ($_POST['cnf_password'])) {
					$_SESSION['change_status'] = "confirm password is not match with password";
					header("location:" . base_url . "Admin/update_profile/$id");
				} else {
					$old_password = $this->db->escape_string(md5($_POST['old_password']));
					$password = $this->db->escape_string(md5($_POST['password']));
					$database_pass = $_POST['pass'];
					if ($old_password != $database_pass) {
						$_SESSION['change_status'] = "Entered old password is not exist";
						header("location:" . base_url . "Admin/update_profile/$id");
					} else {
						$set = array("password" => $password);
						$condition = array("password" => $database_pass);
						$upd = $this->db->update_data('users', $set, $condition);
						if ($upd) {
							$_SESSION['change_status'] = "your password update successfully";
							header("location:" . base_url . "Admin/update_profile/$id");
						} else {
							$_SESSION['change_status'] = "your password is not updated";
							header("location:" . base_url . "Admin/update_profile/$id");
						}
					}
				}
			}
		}
	}
}
