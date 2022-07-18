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
	}
	public function holidays()
	{
		$tbl = 'holiday_tbl';
		$select = '';
		$option = '';
		$where = '';
		$holiday_records = $this->db->select_data($select, $tbl, $option, $where);
		while ($r = $holiday_records->fetch_object()) {
			$row[] = $r;
		}
		
		$this->view("holidays", array("title" => "holidays", "data" => $row));
	}	
}
