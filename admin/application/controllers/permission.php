<?php
ob_start();
ob_clean();
class permission extends loadFile
{
    public $db;
    public function __construct()
    {
        session_start();
        $this->db = $this->model('Model');
    }
    public function permissionview()
    {

        $this->view("permission", array("title" => "Manage Permission"));
    }
    public function managepermission($id)
    {
        $role_id = $id;
        

         $permissions = array( 
                "User" => array ("view user" => 1, "edit user" => 2,"delate user" => 3, "add user" => 4),
                "Leaves" => array ("add leaves" => 1, "approve leaves" => 2, "delete leaves" => 3),
                "Policy" => array ("add Policy" => 1, "edit Policy" => 2, "view Policy" => 3, "delete Policy" => 4)
         );

        $this->view("managepermission", array("title" => "Manage Permission", "data" => $permissions, "id" =>$role_id));
    }
    public function updatepermission($id = null)
    {
        $id = $_POST['id'];
        
        if(isset($_POST['update'])){
            $permissions = $_POST['permission'];
            $moduls = array();
            $condition = array("role_id" => $id);
            $tbl = 'demo';

           $insert = array();
           foreach($permissions as $key => $value){
                // $insert['modules'] = $key;
                $insert['moduls'] = str_replace("'", "", $key);
                $obj1 = array();
                foreach($value as $k => $v){
                    $obj1[] = $v;
                }
                $insert['options'] = implode(',', $obj1);
           echo "<pre>";
            print_r($insert);

            $records = $this->db->update_data($tbl, $insert, $condition);
            print_r($records);
           }

        //    $set = array("date" => $date, "title" => $title, "description" => $description, "image" => $upload_file);

           
        }
        // $select = array("leaves.id", "users.first_name", "leaves.leave_type", "leaves.half_leave_type", "leaves.leave_subject", "leaves.from_credit", "leaves.from_non_credit","leaves.total","leaves.leave_from","leaves.leave_to","leaves.comments","leaves.status","leaves.date");
        // $tbl = 'leaves';
        // $option = array(
        //     "join" => array(
        //         array(
        //             "type" => "INNER JOIN",
        //             "table" => "users",
        //             "condition" => "leaves.user_id=users.id"
        //         )
        //     )
        //     //"GROUP_BY" => array("users.first_name")  
        //     // "HAVING" => array("salary > 20000"),
        //     // "ORDER_BY" => array("first_name ASC"),
        //     //"LIMIT" => array("3"),
        //     //"OFFSET" => ""
        // );
        // $where = '';
        // $records = $this->db->select_data($select, $tbl, $option, $where);



         

        // $this->view("managepermission", array("title" => "Manage Permission", "data" => $permissions));
    }
    
}
