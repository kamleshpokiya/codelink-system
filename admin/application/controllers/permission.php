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
        // $all_permission_array = $this->permission();
        
        // if(isset($all_permission_array[3]->options)){
        //     $permition[] = $all_permission_array[3]->options;
        //     $permition_option_array = explode(',', $permition[0]);
        //     $this->_auth = $permition_option_array;
        // }
        $var = "";
        $all_permission_array = $this->permission();
        if(array_key_exists('permission',$all_permission_array)){
            $var = $all_permission_array['permission'];
        }
        $this->_has = $all_permission_array;
		$this->_auth = $var;
    }
    public function permissionview()
    {
        
        if (array_key_exists('permission',$this->_has)) {
            if(in_array('1', $this->_auth)){
            $this->view("permission", array("title" => "Manage Permission",'recode'=> $this->_auth ));
            }else {
                $this->single_view("error");
            }
        } else {
            $this->single_view("error");
        }
    }
    public function managepermission($id)
    {
        $role_id = $id;
        $tbl = 'permissions';
        $select = '';
        $option = '';
        $where = 'role_id =' . $role_id;
        $records = $this->db->select_data($select, $tbl, $option, $where);
        $permissions = array(
            "User" => array("View User list" => 1, "Edit user" => 2, "Add user" => 3, "Delate User" => 4, "View User profile " => 5),
            "Leaves" => array("View leaves " => 1, "approve/decline leaves" => 2, "Delete leaves" => 3),
            "Policy" => array("View Policy" => 1, "Edit Policy" => 2, "Add Policy" => 3, "delete Policy" => 4),
            "Holiday" => array("View Holiday" => 1, "Edit Holiday" => 2, "Add Holiday" => 3, "Delete Holiday" => 4),
            "permission" => array("Manage Permission" => 1)
        );
       
        if (array_key_exists('permission', $this->_has)) {
            if(in_array('1', $this->_auth)){
            $this->view("managepermission copy", array("title" => "Manage Permission", "data" => $permissions, "id" => $role_id, 'records' => $records));
            }else {
                $this->single_view("error");
            }
        } else {
            $this->single_view("error");
        }
       
    }
    public function updatepermission()
    {
        $id = $_POST['id'];
        if (isset($_POST['update'])) {
            $this->db->delete_data('permissions', array('role_id' => $id));
            $permissions = $_POST['permission'];
            foreach ($permissions as $key => $value) {
                $modules = $key;
                $val = implode(',', $value);
                if(!empty($val)){ 
                $insert_array = array("moduls" => $modules, "options" => $val, "role_id" => $id);
                $this->db->insert_data($insert_array, 'permissions');
                }
                $val = '';
            }
            header("location:" . base_url . "/permission/permissionview");
        }
    }
}
