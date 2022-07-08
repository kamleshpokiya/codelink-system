<?php
ob_start();
ob_clean();
class Holiday extends loadFile
{
	public $db;
	public function __construct()
	{
		session_start();
		$this->db = $this->model('Model');
	}
	public function holidays()
	{
		$tbl = 'holiday_tbl';
		$select = '';
		$option = '';
		$where = '';
		$records = $this->db->select_data($select, $tbl, $option, $where);
		$this->view("holidays", array("title" => "this is holiday list", "data" => $records));
	}
	public function add_holidays()
	{
		$this->view("add_holiday", array("title" => "this is holiday page"));
		if (isset($_POST['submit'])) {
			$date = $this->db->escape_string($_POST['date']);
			$title = $this->db->escape_string($_POST['title']);
			$description = $this->db->escape_string($_POST['description']);
			$file_name = $_FILES['image']['name'];
			$file_size = $_FILES['image']['size'];
			$file_tmp = $_FILES['image']['tmp_name'];
			$file_type = $_FILES['image']['type'];
			if (isset($file_name)) {
				move_uploaded_file($file_tmp, "assets/images/holiday_img/" . $file_name);
			}
			$data = array("date" => $date, "title" => $title, "description" => $description, "image" => $file_name);
			$ins = $this->db->insert_data($data, 'holiday_tbl');
			if ($ins) {
				header("location:" . base_url . "Holiday/holidays");
			}
		}
	}
	public function edit_holidays($id)
	{
		$tbl = 'holiday_tbl';
		$select = '';
		$option = '';
		$where = 'id=' . $id;
		$records = $this->db->select_data($select, $tbl, $option, $where);
		$this->view("add_holiday", array("title" => "this is holiday page", "data" => $records));
	}
	public function delete_holidays()
	{
		if (isset($_REQUEST['did'])) {
			$id = $_REQUEST['did'];
			if (empty($id)) {
				echo "no record found to delete";
			} else {
				$wh = array("id" => $id);

				$del = $this->db->delete_data("users", $wh);
				if ($del) {

					$this->holidays();
				} else {
					echo "query failed";
				}
			}
		}
	}
}
