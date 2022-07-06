<?php
ob_start();
ob_clean();
class Policy extends loadFile
{
  public $db;
  public function __construct()
  {
    session_start();
    $this->db = $this->model('Model');
  }



  // To show all policies
  public function managePolicy()
  {
    $tbl = 'companypolicy';
    $select = '';
    $option = '';
    $where = '';
    $records = $this->db->select_data($select, $tbl, $option, $where);
    $this->view("managePolicy", array("title" => "Manage Policy", "policy_data" => $records));
  }


  // To show add policy page
  public function addPolicy()
  {
    $this->view("addPolicy", array("title" => "Manage Policy"));
  }


  // To add new policy
  public function addNewPolicy()
  {
    if (isset($_POST)) {
      $_POST['policy_image'] = $_FILES['file']['name'];
      // echo "<pre?";
      // print_r($_POST);

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
          if (file_exists(".././public/assets/images/policyImages/$name")) {
            if (unlink(".././public/assets/images/policyImages/$name"));
          }
          if (move_uploaded_file($tmp_name, ".././public/assets/images/policyImages/$name")) {
            $msg['ins_policy_success'] = 'Policy Created successfully';
            echo json_encode($msg);
          }
        }
      }
    }
  }


  // To delete policy
  public function delPolicy($id)
  {
    $condition = array(
      'id' => $id
    );

    if ($this->db->delete_data('companypolicy', $condition)) {

      $msg['success'] = 'Policy deleted..';
      echo json_encode($msg);
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
    $this->view("editPolicy", array("title" => "Update Your Policy", "policy_data" => $records));
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
