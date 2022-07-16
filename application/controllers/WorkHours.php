<?php

class WorkHours extends loadFile
{
    public $db;

    public function __construct()
    {
        session_start();
        $this->db = $this->model('Model');
    }


    // TO show User Working Hours
    public function workHours()
    {
        if (isset($_SESSION)) {
            $id = $_SESSION['user']['id'];
            $users_where = "id = $id";
            $user_in_out_where = "user_id = $id";

            
            $in_out_option = array(
                'ORDER_BY' => array(
                   'date DESC'
                )
            );


            $in_out_records = $this->db->select_data('', 'user_in_out', $in_out_option, $user_in_out_where);
            $users_records = $this->db->select_data('', 'users', NULL, $users_where);
        }

        $user_in_out_obj = [];
        // Store users table  data in array
        if (mysqli_num_rows($users_records) > 0) {
            $users_arr = mysqli_fetch_assoc($users_records);
        } else {
            $users_arr = '';
        }

        // Store leaves table data in array
        if (mysqli_num_rows($in_out_records) > 0) {
            while ($row = mysqli_fetch_assoc($in_out_records)) {
                array_push($user_in_out_obj, $row);
            }
        } else {
            $user_in_out_obj = '';
        }

        $this->view('workHours', array("title" => 'User Working Hours',  'users' => $users_arr,  'workingHours' => $user_in_out_obj));
    }


    // To seprate date and time from timestamp
    public function seprateTime($str)
    {
        $timestamp = $str;
        $splitTimeStamp = explode(" ", $timestamp);
        $date = $splitTimeStamp[0];
        $time = $splitTimeStamp[1];
        return ["$date", "$time"];
    }



    // To clock in user
    public function CheckIn($id)
    {
        date_default_timezone_set("Asia/Calcutta");
        $data = array(
            'user_id' => $id,
            'time_in' => date('H:i:s'),
            'time_out' => null,
            'date' => date('y/m/d')
        );

        if ($this->db->insert_data($data, 'user_in_out')) {
            $msg['check_in_success'] = 'Checked in successfully..';
            $_SESSION['checked_in'] = 'User checked in successfully..';
        } else {
            $msg['check_in_failed'] = 'Checked in failed..';
        }

        if (isset($msg)) {
            echo json_encode($msg);
        }
    }


    // To clock out user
    public function CheckOut($id)
    {

        $tbl = 'user_in_out';
        $select = 'id';
        $option = '';
        $where = "user_id	 = $id";
        $get_user_id = $this->db->select_data($select, $tbl, $option, $where);

        $last_inserted_ids = [];
        if (mysqli_num_rows($get_user_id) > 0) {

            while ($row = mysqli_fetch_assoc($get_user_id)) {
                $u_id = $row['id'];
                array_push($last_inserted_ids, $row['id']);
            }
            $u_id =  max($last_inserted_ids);

            $condition = array(
                'id' => $u_id
            );

            date_default_timezone_set("Asia/Calcutta");
            $set = array(
                'time_out' => date('H:i:s')
            );

            if ($this->db->update_data('user_in_out', $set, $condition)) {
                $msg['check_out_success'] = 'Checked out successfully..';
            } else {
                $msg['check_out_failed'] = 'Checked out failed..';
            }
        }


        if (isset($msg)) {
            echo json_encode($msg);
        }
    }
    

}
