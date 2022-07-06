<?php
class Users extends loadFile
{
	public $db;
	public function __construct()
	{
		session_start();
		$this->db = $this->model('Model');
	}
	public function index()
	{
		$this->view("login", array("this is login"));
		if (isset($_POST['login'])) {
			$email = $_POST['email'];
			$password = $_POST['password'];
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
				header("location:" . base_url . "Users/home");
			} else {
				echo "<b>login fail !!</b>";
			}
		}
	}
	public function logout()
	{
		session_destroy();
		header("location:" . base_url);
	}
	public function users()
	{
		$tbl='users';
		$select='';
		$option='';
		$where='';
		$records=$this->db->select_data($select, $tbl, $option, $where);
		$this->view("users", array("title" => "this is user", "data" => $records));
	}
	public function leaves()
	{
		$this->view("leaves", array("this is leaves"));
	}
	public function home()
	{
		$this->view('index', array('Admin dashboard'));
	}
}
