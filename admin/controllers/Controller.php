<?php
include("../model/Model.php");
class Controller extends Model
{
	public $base_url;
	public $site_url;
	public function __construct()
	{
		parent::__construct();
		session_start();
		$this->base_url = "http://localhost/codelink/admin/controllers/Controller.php";
		$this->site_url = "http://localhost/codelink/admin/assets/";
	}
	public function index()
	{
		include("../views/login.php");
		if(isset($_POST['login']))
		{
			$email=$_POST['email'];
			$password=$_POST['password'];
			$where="email = '$email'  AND password ='$password' AND role_as = 0";
			$rows='';
			$option='';
			$record=$this->select_data($rows,'users',$option,$where); 
			$total=count($record);
			if(isset($_POST['remember'])){
				setcookie("email",$em,time()+3600);
				setcookie("password",$ps,time()+3600);
			
			}
			if($total == 1)
			{
				$_SESSION['admin']=$record;
				header("location:".$this->base_url."/home");
			}
			else{
				echo "<b>login fail !!</b>";
			}
		}
	}
	public function logout(){
		session_destroy();
		header("location:".$this->base_url);
	}
	public function users()
	{
		include("../views/header.php");
		include("../views/sidebar.php");
		include("../views/users.php");
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

if (isset($_SERVER['PATH_INFO'])) {
	$pt = $_SERVER['PATH_INFO'];
	if ($pt == "/index") {
			$obj->index();
	}
	if ($pt == "/profile") {
		$obj->users();
	}
	if ($pt == "/leaves") {
		$obj->leaves();
	}
	if ($pt == "/home") {
		$obj->home();
	}
	if ($pt == "/logout") {
		$obj->logout();
	}
	
}else{
	$obj -> index();
}
