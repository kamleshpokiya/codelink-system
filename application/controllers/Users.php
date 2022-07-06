<?php

// Users class (controller) . Extends Model class
class Users extends loadFile
{
	public $db;

	public function __construct()
	{
		session_start();
		$this->db = $this->model('Model');
	}

	// User dashboard
	public function home()
	{
		$id = '';
		$tbl = 'users';
		$select = '';
		$option = '';
		if (isset($_SESSION)) {
			$id = $_SESSION['user']['id'];
		}
		$where = "id = $id";
		$records = mysqli_fetch_assoc($this->db->select_data($select, $tbl, $option, $where));
		$this->view('index', array("title" => 'User dashboard', 'users' => $records));
	}


	// Show user leaves in table
	public function leaves()
	{
		$id = '';
		$tbl = 'users';
		$select = '';
		$option = '';
		if (isset($_SESSION)) {
			$id = $_SESSION['user']['id'];
		}
		$where = "id = $id";
		$records = mysqli_fetch_assoc($this->db->select_data($select, $tbl, $option, $where));
		$this->view('leaves', array("title" => 'User Leaves',  'users' => $records));
	}

	// User profile
	public function profile()
	{
		// For getting value from database
		$id = '';
		$tbl = 'users';
		$select = '';
		$option = '';
		if (isset($_SESSION)) {
			$id = $_SESSION['user']['id'];
		}
		$where = "id = $id";
		$users_records = mysqli_fetch_assoc($this->db->select_data($select, $tbl, $option, $where));
		$this->view("profile", array("title" => "User Profile", "users" => $users_records));
	}


	// User update profile
	public function update_user()
	{

		$id = '';
		$tbl = 'users';
		$select = '';
		$option = '';
		if (isset($_SESSION)) {
			$id = $_SESSION['user']['id'];
		}
		$where = "id = $id";
		$records = mysqli_fetch_assoc($this->db->select_data($select, $tbl, $option, $where));


		if (isset($_POST['id'])) {
			$is_valid = true;
			$old_db_password =  $records['password'];
			$old_profile_pic =  $records['profile_pic'];
			$id = $_POST['id'];
			$first_name = $_POST['first_name'];
			$last_name = $_POST['last_name'];
			$email = $_POST['email'];
			$dob = $_POST['dob'];
			$contact = $_POST['contact'];
			$alt_contact = $_POST['alt_contact'];
			$address = $_POST['address'];

			$Array = [

				$array = [
					"field" => "first_name",
					"value" => $first_name,
					"required" => true,
					"is_string" => true
				],
				$array = [
					"field" => "last_name",
					"value" => $last_name,
					"required" => true,
					"is_string" => true
				],
				$array = [
					"field" => "email",
					"value" => $email,
					"required" => true,
					"email" => true
				],
				$array = [
					"field" => "dob",
					"value" => $dob,
					"required" => true
				],
				$array = [
					"field" => "contact",
					"value" => $contact,
					"required" => true,
					"mob_number" => true
				],
				$array = [
					"field" => "alt_contact",
					"value" => $alt_contact,
					"required" => true,
					"mob_number" => true
				],
				$array = [
					"field" => "address",
					"value" => $address,
					"required" => true,
				]
			];



			if (isset($_FILES['file'])) {
				$profile_pic_type = $_FILES['file']['type'];
				$profile_pic_size = $_FILES['file']['size'];

				$array1 = [
					"field" => "profile_pic_type",
					"value" => $profile_pic_type,
					"type" => true
				];
				$array2 = [
					"field" => "profile_pic_size",
					"value" => $profile_pic_size,
					"size" => true
				];

				$_POST['profile_pic'] = $_FILES['file']['name'];

				array_push($Array, $array1, $array2);
			}

			if (isset($_POST['password'])) {
				$password = $_POST['password'];
				$old_password = $_POST['old_password'];

				if ($old_db_password != md5($old_password)) {
					$msg['Incorect_old_password'] = 'Wrong password !';
					$is_valid = false;
				}
				$array3 = [
					"field" => "password",
					"value" => $password,
					'required' => true,
					"pswd" => true
				];
				if ($is_valid) {
					array_push($Array, $array3);
				}
			}
			array_shift($_POST);

			// Form Validation
			$res = $this->Validate($Array);


			if ($res == 1 && $is_valid == true) {

				if (isset($_POST['password'])) {
					$_POST['password'] = md5($_POST['password']);
					unset($_POST['old_password']);
				}
				$codition = array(
					'id' => $id
				);

				$result = $this->db->update_data('users', $_POST, $codition);

				if ($result) {

					if (isset($_FILES['file']) && $_FILES['file']['name'] != '') {
						if (!file_exists(site_url . 'images/carousel/' . $_FILES['file']['name'])) {
							$file_tmp_path = $_FILES['file']['tmp_name'];
							move_uploaded_file($file_tmp_path, '.././public/assets/images/carousel/' . $_FILES['file']['name']);
							unlink('.././public/assets/images/carousel/' . $old_profile_pic);
						} else {
							$msg['exist_img'] = 'Image already exist.';
						}
					}
					$msg['updation_success'] = 'profile updated successfull.';
				} else {
					$msg['updation_failed'] = 'profile not updated.';
				}
			} else {
				if ($res != 1) {
					echo $res;
				}
			}

			if (isset($msg)) {
				echo json_encode($msg);
			}
		}
	}

	// User login 
	public function login()
	{

		$msg = [];
		if (isset($_POST['login'])) {
			$email = $_POST['email'];
			$password = md5($_POST['password']);
			if ($email == '' || $password == '') {
				$msg['empty_field'] = 'Please enter your email and password';
			} else {
				$rows = '';
				$where = "email = '$email' AND role_as IN (1,2,3)";
				$option = '';
				$record = $this->db->select_data($rows, 'users', $option, $where);
				$row = $record->num_rows;

				if ($row == 1) {
					$record = mysqli_fetch_assoc($record);
					if ($password == $record['password']) {
						$id = $record['id'];
						$_SESSION['user'] = $record;
						if (isset($_POST['remember'])) {
							setcookie("user_email", $email, time() + 3600, '/');
							setcookie("user_password", $_POST['password'], time() + 3600, '/');
						} else {
							if (isset($_COOKIE['user_email']) && isset($_COOKIE['user_password'])) {

								unset($_COOKIE['user_email']);
								setcookie('user_email', '', time() - 3600, '/');
								unset($_COOKIE['user_password']);
								setcookie('user_password', '', time() - 3600, '/');
							}
						}
						header("location:" . base_url . "Users/home?id=$id");
					} else {
						$msg['pass_not_match'] = 'Incorrect Password !';
					}
				} else {
					$msg['User_not_exist'] = 'User does not exist';
				}
			}
		}

		if (isset($msg)) {

			$this->view("login", array("title" => "User Login", "data" => $msg));
		} else {
			$this->view("login", array("title" => "User Login"));
		}
	}


	public function recoverpassword()
	{

		if (isset($_POST['update_password'])) {
			$email = $_POST['email'];
			if ($email != '') {
				$rows = '';
				$where = "email = '$email' AND role_as IN (1,2,3)";
				$option = '';
				$record = $this->db->select_data($rows, 'users', $option, $where);
				$row = $record->num_rows;
				if ($row == 1) {
					$res = mysqli_fetch_assoc($record);
					$id = $res['id'];

					// send email to user for reset password
					$to_email = $email;
					$subject = 'Simple mail test via local php';
					$body = "Hii, This is test mail send by php script in 2022 from mysite?id=$id";
					$headers = 'From: narendrasinghks2019@gmail.com';

					if (mail($to_email, $subject, $body, $headers)) {
						$msg['email_sent'] = 'An mail sent to your account to reset password please check..';
						echo $msg['email_sent'];
					} else {
						$msg['email_sent_failed'] = 'Failed to sent email';
						echo $msg['email_sent_failed'];
						echo $email;
					}
				} else {
					$msg['email_not_exist'] = 'Email address is not valid';
					echo $msg['email_not_exist'];
				}
			} else {
				$msg['req_email'] = 'Please enter your email address';
				echo $msg['req_email'];
			}
		}


		$this->view("recoverpassword", array("title" => "Recover Password"));
	}


	// Reset user password using new and confirm password through email
	public function resetpassword()
	{
		if (isset($_POST['reset_password'])) {
			$newpassword = $_POST['newpassword'];
			$confirmnewpassword = $_POST['confirmnewpassword'];

			// http://localhost/codelink-mvc/users/resetpassword?id=4
			// Password validation
			if ($newpassword == '') {
				$res['required_newpassword'] = "Please enter new password";
			}
			if ($confirmnewpassword == '') {
				$res['required_confirmpassword'] = "Please enter confirm password";
			}
			if (!empty($newpassword) && !empty($confirmnewpassword)) {
				if ($newpassword != $confirmnewpassword) {
					$res['not_mach_password'] = "Password not match !";
				} else {
					$uppercase = preg_match('@[A-Z]@', $newpassword);
					$lowercase = preg_match('@[a-z]@', $newpassword);
					$number    = preg_match('@[0-9]@', $newpassword);

					if (!$uppercase || !$lowercase || !$number || strlen($newpassword) < 8) {
						$res['invalid_password'] = 'Password should be upper case lower case one number and greater than 8 character';
					} else {
						$set = array(
							'password' => md5($newpassword)
						);

						// Get user id from url(querystring)
						// $id = $_GET['id'];
						$condition = array(
							// 'id' => $id
							'id' => 4
						);

						$result = $this->db->update_data('users', $set, $condition);
						if ($result) {
							$res['update_password_success'] = "Password reset successfully.";
						} else {
							$res['update_password_failed'] = "Password not reset";
						}
					}
				}
			}
		}
		if (isset($res)) {
			$this->view("resetpassword", array("title" => "Reset Password", "data" => $res));
		} else {
			$this->view("resetpassword", array("title" => "Reset Password"));
		}
	}

	public function logout()
	{
		session_destroy();
		header("location:" . base_url);
	}


	public function notFound(){
		$this -> view('sdklsfjkf');
	}
}
