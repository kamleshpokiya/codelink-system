<?php

class Leave extends loadFile
{
    public $db;

    public function __construct()
    {
        session_start();
        $this->db = $this->model('Model');
    }


    // Get user leave data from database(leaves) and show on leave table
    public function leaves()
    {
        // Get Users and Leaves table data
        if (isset($_SESSION)) {
            $id = $_SESSION['user']['id'];
            $users_where = "id = $id";
            $leaves_where = "user_id = $id";
            $leaves_records = $this->db->select_data('', 'leaves', NULL, $leaves_where);
            $users_records = $this->db->select_data('', 'users', NULL, $users_where);
        }

        $leaves_obj = [];
        // Store users table  data in array
        if (mysqli_num_rows($users_records) > 0) {
            $users_arr = mysqli_fetch_assoc($users_records);
        } else {
            $users_arr = '';
        }

        // Store leaves table data in array
        if (mysqli_num_rows($leaves_records) > 0) {
            while ($row = mysqli_fetch_assoc($leaves_records)) {
                array_push($leaves_obj, $row);
            }
        }
        $this->view('leaves', array("title" => 'User Leaves',  'users' => $users_arr, 'leaves' => $leaves_obj));
    }



    // Get user leaves data from database(leaves) and show on leave apply form
    public function applyLeave()
    {
        // Get Users and Leaves table data
        if (isset($_SESSION)) {
            $id = $_SESSION['user']['id'];
            $users_where = "id = $id";
            $users_records = $this->db->select_data('', 'users', NULL, $users_where);
        }

        // Store users table  data in array
        if (mysqli_num_rows($users_records) > 0) {
            $users_arr = mysqli_fetch_assoc($users_records);
        } else {
            $users_arr = '';
        }

        $this->view('applyLeave', array("title" => 'Apply for Leave',  'users' => $users_arr));
    }



    // Store leave application details to the database and send email to the Admin and HR for user leave
    public function sendLeave()
    {

        if (isset($_POST)) {
            $user_id = $_SESSION['user']['id'];
            $arr = array(
                'user_id' => $user_id
            );
            $credit_score = $_POST['credit_score'];
            unset($_POST['credit_score']);
            $_POST['date'] = date('Y-m-d');
            $_POST = array_merge($arr, $_POST);

            $records = $this->db->insert_data($_POST, 'leaves');
            if ($records) {

                /****
                 * 
                 *  $to_email = 'admin@gmail.com';
                 *  $subject = 'For leave';
                 *  $subject = 'For leave';
                 *  $body = "Hii, This is test mail send by php script in 2022 from mysite?id=$user_id";
                 *  $headers = 'From: narendrasinghks2019@gmail.com';
                 *  if (mail($to_email, $subject, $body, $headers)) {
                 *  echo 'mail sent';
                 *  } else {
                 *  echo 'main not sent';
                 *  }
                 * 
                 */

                $msg['insert_success'] = 'Leave applied successfull.';
                // update user credit score when he/she user credit for leave
                $set = array(
                    'credits' => (int)$credit_score - (int)$_POST['from_credit']
                );

                $condition = array(
                    'id' => $user_id
                );
                $updatecredit = $this->db->update_data('users', $set, $condition);
                if ($updatecredit) {
                    $msg['credit_updated'] = 'Credits updated successfully.';
                } else {
                    $msg['credit_not_updated'] = 'Credits not updated.';
                }
            } else {
                $msg['insert_leaves_failed'] = 'Leaves not applied.';
            }

            echo json_encode($msg);

        }
    }

    public function notFound(){
		$this -> view('sdklsfjkf');
	}
}
