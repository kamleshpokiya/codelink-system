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
        $tbl = 'permissions';
		$select = '';
		$option = '';
		$where = 'role_id =' .$role_id;

		$records = $this->db->select_data($select, $tbl, $option, $where);
        // echo '<pre>';
        // print_r($records);
        
        $permissions = array(
            "User" => array("View User" => 1, "Edit user" => 2, "Add user" => 3, "Delate User" => 4,"Extra"=> 5),
            "Leaves" => array("add leaves" => 1, "approve leaves" => 2, "delete leaves" => 3),
            "Policy" => array("add Policy" => 1, "edit Policy" => 2, "view Policy" => 3, "delete Policy" => 4)
        );

        $this->view("managepermission", array("title" => "Manage Permission", "data" => $permissions, "id" => $role_id, 'records'=> $records));
    }
    public function updatepermission($id = null)
    {
        $id = $_POST['id'];
        if (isset($_POST['update'])) {
            $this->db->delete_data('permissions', array('role_id' => $id));
            $permissions = $_POST['permission'];
            foreach ($permissions as $key => $value) {
                $modules = $key;
                // $modules = str_replace("'", "", $key);
                // print_r($key);
                $insert_array = array("moduls" => $modules, "options" => implode(',', $value), "role_id" => $id);
                $this->db->insert_data($insert_array, 'permissions');
            }
            header("location:" . base_url . "/permission/permissionview");
        }
    }
}
