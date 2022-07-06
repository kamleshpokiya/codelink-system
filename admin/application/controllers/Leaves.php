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

    public function leaves()
    {
        $select = array("leaves.id", "users.first_name", "leaves.leave_type", "leaves.after_before_leave", "leaves.leave_desc", "leaves.credit_leave", "leaves.extra_leave","leaves.from_date","leaves.to_date","leaves.admin_reason","leaves.status");
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
    public function approve_leave($id)
    {
        $leave_id = $id;
        $this->view("approve_leave", array("title" => "approve leave"));
        if (isset($_POST['edit'])) {
            $leave_status = $this->db->escape_string($_POST['status']);
            $description = $this->db->escape_string($_POST['description']);
            $set = array("status" => $leave_status, "admin_reason" => $description);
            $condition = array("id" => $leave_id);
            $upd = $this->db->update_data('leaves', $set, $condition);
            if ($upd) {
                header("location:" . base_url . "Leaves/leaves");
            }
        }
    }
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
