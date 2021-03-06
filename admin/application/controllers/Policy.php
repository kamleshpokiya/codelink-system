<?php
ob_start();
ob_clean();
class policy extends loadFile
{
  public $db;
  public function __construct()
  {
    session_start();
    $this->db = $this->model('Model');

    $var = "";
        $all_permission_array = $this->permission();
        if(array_key_exists('Policy',$all_permission_array)){
            $var = $all_permission_array['Policy'];
        }
        $this->_has = $all_permission_array;
		$this->_auth = $var;
    
  }

  // To show all policies
  public function managePolicy()
  {
    $tbl = 'companypolicy';
    $select = '';
    $option = '';
    $where = '';
    $records = $this->db->select_data($select, $tbl, $option, $where);
    if (array_key_exists('Policy',$this->_has)) {
      if(in_array('1', $this->_auth)){
        $this->view("managePolicy", array("title" => "Manage Policy", "policy_data" => $records, 'recode'=> $this->_auth));
      }else {
        $this->single_view("error");
      }
    } else {
      $this->single_view("error");
    }
    
  }


  // To show add policy page
  public function addPolicy()
  {
    if (array_key_exists('Policy',$this->_has)) {
      if(in_array('3', $this->_auth)){
        $this->view("addPolicy", array("title" => "Manage Policy"));
      }else {
        $this->single_view("error");
      }
    } else {
      $this->single_view("error");
    }
    
  }

  // To add new policy
  public function addNewPolicy()
  {
    if (isset($_POST)) {
      $_POST['policy_image'] = $_FILES['file']['name'];

      $data = [
        $array = [
          "field" => "Title",
          "value" => $_POST['policy_title'],
          "required" => true,
        ],
        $array = [
          "field" => "Description",
          "value" => $_POST['policy_desc'],
          "required" => true,
        ],
        $array = [
          "field" => "Link",
          "value" => $_POST['policy_link'],
          "required" => true,
          "url" => true
        ],
        $array = [
          "field" => "Image",
          "value" => $_FILES['file']['name'],
          "required" => true
        ],
        $array = [
          "field" => "size",
          "value" => $_FILES['file']['size'],
          "required" => true
        ],
        $array = [
          "field" => "type",
          "value" =>  $_FILES['file']['type'],
          "required" => true
        ]
      ];

      
      $res = $this->Validate($data);

      if ($res == 1) {
        $insert_policy = $this->db->insert_data($_POST, 'companypolicy');
        if ($insert_policy) {
          $name = $_FILES['file']['name'];
          // $uploads_dir = site_url.'images/policyImages/'.$name;
          $tmp_name = $_FILES['file']['tmp_name'];
          if (file_exists("assets/images/policyImages/" . $name)) {
            if (unlink("assets/images/policyImages/" . $name));
          }
          if (move_uploaded_file($tmp_name, "assets/images/policyImages/" . $name)) {
            $msg['ins_policy_success'] = 'Policy Created successfully';
            echo json_encode($msg);
          }
        }
      }
    }
  }

  // To delete policy
  public function delPolicy()
  {
    if ((isset($_REQUEST['did'])) && (in_array('4', $this->_auth))) {
      $id = $_REQUEST['did'];
      $wh = array("id" => $id);
      $this->db->delete_data("companypolicy", $wh);
    }
  }
  


  // To show edit policy
  public function editPolicy($id)
  {
    $tbl = 'companypolicy';
    $select = '';
    $option = '';
    $where = "id = $id";
    $records = $this->db->select_data($select, $tbl, $option, $where);
    if (array_key_exists('Policy',$this->_has)) {
      if(in_array('2', $this->_auth)){
        $this->view("editPolicy", array("title" => "Update Your Policy", "policy_data" => $records));
      }else {
        $this->single_view("error");
      }
    } else {
      $this->single_view("error");
    }
    
  }

  // To edit old policy
  public function editOldPolicy()
  {
    if (isset($_POST)) {
      $old_img = $_POST['policy_old_image'];
      unset($_POST['policy_old_image']);

      if (isset($_FILES['file'])) {
        $_POST['policy_image'] = $_FILES['file']['name'];
      }

      $condition = array(
        'id' => $_POST['id']
      );

      $id = $_POST['id'];
      unset($_POST['id']);
      if ($this->db->update_data('companypolicy', $_POST, $condition)) {
        if (isset($_FILES['file'])) {
          $name = $_FILES['file']['name'];
          // $uploads_dir = site_url.'images/policyImages/'.$name;
          $tmp_name = $_FILES['file']['tmp_name'];
          if (file_exists(".././public/assets/images/policyImages/$name")) {
            unlink(".././public/assets/images/policyImages/$name");
          }
          if (move_uploaded_file($tmp_name, ".././public/assets/images/policyImages/$name")) {
            $msg['img_update_success'] = 'Policy image updated...';
            // echo json_encode(($msg));
          }
        }
      }
      $msg['update_success'] = 'Policy updated...';
      echo json_encode(($msg));
    }
  }
}
