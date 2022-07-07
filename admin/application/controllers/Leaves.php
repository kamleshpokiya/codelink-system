<?php
ob_start();
ob_clean();
class Leaves extends loadFile
{
    public $db;
    public function __construct()
    {
        session_start();
        $this->db = $this->model('Model');
    }
    //leave details 
    public function leaves()
    {
        $select = array("leaves.id", "users.first_name", "leaves.leave_type", "leaves.half_leave_type", "leaves.leave_subject", "leaves.from_credit", "leaves.from_non_credit", "leaves.total", "leaves.leave_from", "leaves.leave_to", "leaves.comments", "leaves.status", "leaves.date");
        $tbl = 'leaves';
        $option = array(
            "join" => array(
                array(
                    "type" => "INNER JOIN",
                    "table" => "users",
                    "condition" => "leaves.user_id=users.id"
                )
            )
            //"GROUP_BY" => array("users.first_name")  
            // "HAVING" => array("salary > 20000"),
            // "ORDER_BY" => array("first_name ASC"),
            //"LIMIT" => array("3"),
            //"OFFSET" => ""
        );
        $where = '';
        $records = $this->db->select_data($select, $tbl, $option, $where);
        $this->view("leaves", array("title" => "this is leaves", "data" => $records));
    }
    //approve by admin 
    public function approve_leave($id)
    {
        $leave_id = $id;
        $select_date = "";
        $tbl = "leaves";
        $option = "";
        $where = "id =" . $leave_id;
        $sel_date = $this->db->select_data($select_date, $tbl, $option, $where);
        $data = array_values($sel_date);
        $currentdate = date("y-m-d");
        // $newDate = date('Y-m-d', strtotime($currentdate . ' + 4 months'));
        $month = date("m", strtotime($currentdate));
        $this->view("approve_leave", array("title" => "approve leave", "data" => $sel_date));
        if (isset($_POST['edit'])) {
            $leave_status = $this->db->escape_string($_POST['status']);
            $comment = $this->db->escape_string($_POST['comment']);
            $credit_leave = $this->db->escape_string($_POST['credits']);
            if (date("m", strtotime($data[0]->date)) == $month) {
                $set = array("status" => $leave_status, "comments" => $comment, "from_credit" => $credit_leave);
            } else {
                $set = array("status" => $leave_status, "comments" => $comment);
            }
            $condition = array("id" => $leave_id);
            $upd = $this->db->update_data('leaves', $set, $condition);
            if ($upd) {
                header("location:" . base_url . "Leaves/leaves");
            }
        }
    }
    //delete leaves
    public function delete_leaves()
    {
        if (isset($_REQUEST['did'])) {
            $id = $_REQUEST['did'];
            if (empty($id)) {
                echo "no record found to delete";
            } else {
                $wh = array("id" => $id);

                $del = $this->db->delete_data("leaves", $wh);
                if ($del) {
                    $this->leaves();
                } else {
                    echo "query failed";
                }
            }
        }
    }
}
