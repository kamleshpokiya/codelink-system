<?php
ob_start();
ob_clean();
class holiday extends loadFile
{
	public $db;
	public function __construct()
	{
		session_start();
		$this->db = $this->model('Model');
		$all_permission_array = $this->permission();
		$permition[] = $all_permission_array[3]->options;
		$permition_option_array =explode(',',$permition[0]);
		$this->_auth = $permition_option_array;
	}
	public function holidays()
	{
		$tbl = 'holiday_tbl';
		$select = '';
		$option = '';
		$where = '';
		$records = $this->db->select_data($select, $tbl, $option, $where);
		 if(in_array('1', $this->_auth)){ 
			$this->view("holidays", array("title" => "this is holiday list", "data" => $records, 'recode'=> $this->_auth));
			}
	}
	public function add_holidays()
	{
		if(in_array('3', $this->_auth)){  
		$this->view("add_holiday", array("title" => "this is holiday page"));
		}else {
		   $this->single_view("error");
   }
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
				header("location:" . base_url . "holiday/holidays");
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
		if(in_array('2', $this->_auth)){  
		$this->view("edit_holiday", array("title" => "this is holiday page", "data" => $records));
		}else {
		   $this->single_view("error");
   }
		if (isset($_POST['edit'])) {
			$h_id = $this->db->escape_string($_POST['id']);
			$date = $this->db->escape_string($_POST['date']);
			$title = $this->db->escape_string($_POST['title']);
			$description = $this->db->escape_string($_POST['description']);
			$old_image = $_POST['old_image'];
			$file_name = $_FILES['image']['name'];
			$file_size = $_FILES['image']['size'];
			$file_tmp = $_FILES['image']['tmp_name'];
			$file_type = $_FILES['image']['type'];
			if ($file_name != '') {
				$upload_file = $file_name;
				if (file_exists("assets/images/holiday_img/" . $upload_file)) {
					$_SESSION['h_msg'] = "image already exist" . $upload_file;
					header("location:" . base_url . "holiday/edit_holidays/$id");
				} else {
					if ($upload_file != '') {
						move_uploaded_file($file_tmp, "assets/images/holiday_img/" . $upload_file);
						unlink("assets/images/holiday_img/" . $old_image);
						$set = array("date" => $date, "title" => $title, "description" => $description, "image" => $upload_file);
						$condition = array("id" => $h_id);
						$upd = $this->db->update_data('holiday_tbl', $set, $condition);
						if ($upd) {
							header("location:" . base_url . "holiday/holidays");
						} else {
							$_SESSION['h_msg'] = "Data Not updated";
							header("location:" . base_url . "holiday/edit_holidays/$id");
						}
					}
				}
			} else {
				$upload_file = $old_image;
				$set = array("date" => $date, "title" => $title, "description" => $description, "image" => $upload_file);
				$condition = array("id" => $h_id);
				$upd = $this->db->update_data('holiday_tbl', $set, $condition);
				if ($upd) {
					header("location:" . base_url . "holiday/holidays");
				} else {
					$_SESSION['h_msg'] = "Data Not updated";
					header("location:" . base_url . "holiday/edit_holidays/$id");
				}
			}
		}
	}
	public function delete_holidays()
	{
		if ((isset($_REQUEST['did'])) && (in_array('4', $permission))) {
			$id = $_REQUEST['did'];
				$wh = array("id" => $id);
				$del = $this->db->delete_data("holiday_tbl", $wh);
		}
	}
}
