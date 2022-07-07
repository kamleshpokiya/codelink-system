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
    public function holidays(){
        $tbl = 'holiday_tbl';
		$select = '';
		$option = '';
		$where = '';
		$records = $this->db->select_data($select, $tbl, $option, $where);
		$this->view("holidays", array("title" => "this is holiday list", "data" => $records));
    }
    public function add_holidays(){
        $this->view("add_holiday", array("title" => "this is holiday page"));

    }
    public function edit_holidays($id){
        $tbl = 'holiday_tbl';
		$select = '';
		$option = '';
		$where = 'id='.$id;
		$records = $this->db->select_data($select, $tbl, $option, $where);
        $this->view("add_holiday", array("title" => "this is holiday page", "data" => $records));
    }
    public function delete_holidays(){
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
