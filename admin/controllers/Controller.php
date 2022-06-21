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
}
