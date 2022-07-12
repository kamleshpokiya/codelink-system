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
        $tbl = 'permission';
		$select = '';
		$option = '';
		// $where = 'role_id = .$id';
        // echo $where;
		// $records = $this->db->select_data($select, $tbl, $option, $where);
        
        $permissions = array(
            "User" => array("view user" => 1, "edit user" => 2, "delate user" => 3, "add user" => 4),
            "Leaves" => array("add leaves" => 1, "approve leaves" => 2, "delete leaves" => 3),
            "Policy" => array("add Policy" => 1, "edit Policy" => 2, "view Policy" => 3, "delete Policy" => 4)
        );

        $this->view("managepermission", array("title" => "Manage Permission", "data" => $permissions, "id" => $role_id));
    }
    public function updatepermission($id = null)
    {
        $id = $_POST['id'];
        if (isset($_POST['update'])) {
            $this->db->delete_data('permissions', array('role_id' => 2));
            $permissions = $_POST['permission'];
            foreach ($permissions as $key => $value) {
                $modules = $this->db->escape_string($key);
                $insert_array = array("moduls" => $modules, "options" => implode(',', $value), "role_id" => 2);
                $this->db->insert_data($insert_array, 'permissions');
            }
            header("location:" . base_url . "/permission/permissionview");
        }
    }
}
