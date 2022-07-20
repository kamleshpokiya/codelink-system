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
        $all_permission_array = $this->permission();
		$permition[] = $all_permission_array[0]->options;
		$permition_option_array =explode(',',$permition[0]);
		$this->_auth = $permition_option_array;
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
        $permissions = array(
            "User" => array("View User list" => 1, "Edit user" => 2, "Add user" => 3, "Delate User" => 4,"View User profile "=> 5),
            "Leaves" => array("View leaves " => 1, "approve/decline leaves" => 2, "Delete leaves" => 3),
            "Policy" => array("View Policy" => 1, "Edit Policy" => 2, "Add Policy" => 3, "delete Policy" => 4),
			"Holiday" => array("View Holiday" => 1, "Edit Holiday" => 2, "Add Holiday" => 3, "Delete Holiday" => 4),
			"permission" => array("Manage Permission" => 1)
        );
        $this->view("managepermission", array("title" => "Manage Permission", "data" => $permissions, "id" => $role_id, 'records'=> $records));
    }
    public function updatepermission()
    {
        $id = $_POST['id'];
        if (isset($_POST['update'])) {
            $this->db->delete_data('permissions', array('role_id' => $id));
            $permissions = $_POST['permission'];
            foreach ($permissions as $key => $value) {
                $modules = $key;
                $insert_array = array("moduls" => $modules, "options" => implode(',', $value), "role_id" => $id);
                $this->db->insert_data($insert_array, 'permissions');
            }
            header("location:" . base_url . "/permission/permissionview");
        }
    }
}
