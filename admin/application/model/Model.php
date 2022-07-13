<?php
class Model
{
	public $db;
	public function __construct()
	{
		$this->db = new mysqli("localhost", "root", "", "codelink");
	}
	public function insert_data($data, $tbl)
	{
		$field = array_keys($data);
		$fields = implode(", ", $field);
		$val = array_values($data);
		$value = str_replace("'", "", $val);
		$values = "'" . implode("','", $value) . "'";
		$ins = "INSERT INTO $tbl ($fields) Values ($values)";
		// echo $ins;
		// die;
		$query = $this->db->query($ins) or die("query failed");
		return $query;
	}
	public function select_data($select = null, $tbl, $option = null, $where = null)
	{
		$join = $group_by = $having = $order_by = $limit = $offset = '';
		if ($select != null) {
			$row_fields = implode(', ', $select);
			$sel = 'SELECT ' . $row_fields . ' FROM ' . $tbl;
		} else {
			$select = '*';
			$sel = 'SELECT ' . $select . ' FROM ' . $tbl;
		}
		if ($option != null) {

			foreach ($option as  $key => $value) {
				$val = $key;
				if ($val == "join") {
					foreach ($value as $values) {
						foreach ($values as $keys => $vals) {
							if ($keys == "condition") {
								$join .= '  ON   ' . $vals . '  ';
							} else {
								$join .= '   ' . $vals;
							}
						}
					}
				}
				if (isset($option['GROUP_BY'])) {
					$group_by = ' GROUP BY ' . implode('', $option['GROUP_BY']);
				} else {
					$group_by = '';
				}
				if (isset($option['HAVING'])) {
					$having = ' HAVING ' . implode('', $option['HAVING']);
				} else {
					$having = '';
				}
				if (isset($option['ORDER_BY'])) {
					$order_by = ' ORDER BY ' . implode('', $option['ORDER_BY']);
				} else {
					$order_by = '';
				}

				if (isset($option['LIMIT'])) {
					$limit = ' LIMIT ' . implode('', $option['LIMIT']);
				} else {
					$limit = '';
				}
				if (isset($option['OFFSET'])) {
					$offset = ' OFFSET ' . implode('', $option['OFFSET']);
				} else {
					$offset = '';
				}
			}
		}
		$sel .= $join;
		$sel .= $having;
		$sel .= $order_by;
		$sel .= $limit;
		$sel .= $offset;
		if ($where != null) {
			$sel .= ' WHERE ' . $where;
		}
		$sel .= $group_by;
		$sql = $this->db->query($sel) or die("query failed");
		$row = [];
			while ($r = $sql->fetch_object()) {
				$row[] = $r;
			}
		return $row;
	}
	public function delete_data($tbl, $condition)
	{
		$field = array_keys($condition);
		$fields = implode($field);
		$value = array_values($condition);
		$values = implode($value);
		// if(count($ > 0))
		$del = "DELETE FROM $tbl WHERE $fields='$values'";

		$query = $this->db->query($del) or die("query failed");
		return $query;
	}
	public function update_data($tbl, $set, $condition)
	{
		$field = array_keys($condition);
		$fields = implode($field);
		$value = array_values($condition);
		$values = implode($value);
		$string = implode(', ', array_map(function ($v, $k) {
			return sprintf("%s='%s'", $k, $v);
		}, $set, array_keys($set)));
		$upd = "UPDATE $tbl SET $string WHERE $fields='$values' ";
		// echo $upd;
		// return $upd;
		// die;

		$query = $this->db->query($upd) or die("query not run");
		return $query;
	}
	public function escape_string($value)
	{
		return $this->db->real_escape_string($value);
	}
	public function reset_increament($id)
	{
	}
}
