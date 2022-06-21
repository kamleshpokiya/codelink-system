<?php


include("../model/Model.php");
class Controller extends Model
{
	public $base_url;
	public $site_url;
	public function __construct()
	{
		parent::__construct();
		$this->base_url = "http://localhost/codelink/controllers/Controller.php";
		$this->site_url = "http://localhost/codelink/assets/";
	}
	public function index()
	{

		include("../views/login.php");
	}
	public function profile()
	{
		include("../views/header.php");
		include("../views/sidebar.php");
		include("../views/profile.php");
		include("../views/footer.php");
	}
	public function leaves()
	{
		include("../views/header.php");
		include("../views/sidebar.php");
		include("../views/leaves.php");
		include("../views/footer.php");
	}
	public function home()
	{
		include("../views/header.php");
		include("../views/sidebar.php");
		include("../views/index.php");
		include("../views/footer.php");
	}
}


$obj = new Controller();
if (isset($_POST['username'])) {

	$uname = $_POST['username'];
	$row = array(
		'password' => 'password'
	);
	$tbl = 'users';
	$option = null;
	$where = "email = '$uname' AND role_as IN (0,1,2,3)";

	$result = $obj->select_data($row, $tbl, $option, $where);
	$ress = mysqli_fetch_assoc($result);
	$num = mysqli_num_rows($result);

	if ($num > 0) {
		if ($ress['password'] ==  $_POST['password']) {
			$msg['success'] = 'login success';
		} else {
			$msg['failed'] = 'password wrong';
		}
	} else {
		$msg['user_not_exist'] = 'User not exist';
	}

	echo json_encode($msg);
}


if (isset($_SERVER['PATH_INFO'])) {
	$pt = $_SERVER['PATH_INFO'];
	if ($pt == "/index") {
		$obj->index();
	}
	if ($pt == "/profile") {
		$obj->profile();
	}
	if ($pt == "/leaves") {
		$obj->leaves();
	}
} else {
	$obj->index();
}
