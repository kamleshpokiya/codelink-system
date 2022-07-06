<?php
class loadFile
{

    public function view($viewName, $data = [])
    {
        if ($viewName == 'login' && file_exists("../application/views/" . $viewName . ".php")) {
            include "../application/views/login.php";
        }elseif($viewName == 'recoverpassword' && file_exists("../application/views/" . $viewName . ".php")){
            include "../application/views/recoverpassword.php";
        } elseif($viewName == 'resetpassword' && file_exists("../application/views/" . $viewName . ".php")){
            include "../application/views/resetpassword.php";
        } elseif($viewName == 'notFound' && file_exists("../application/views/" . $viewName . ".php")){
            include "../application/views/notFound.php";
        }elseif (file_exists("../application/views/" . $viewName . ".php")) {
            include "../application/views/header.php";
            include "../application/views/sidebar.php";
            require_once "../application/views/$viewName.php";
            include "../application/views/footer.php";
        } else {
            include "../application/views/notFound.php";
            // echo "Sorry $viewName page not found";
        }
    }
    public function model($model)
    {
        if (file_exists("../application/model/" . $model . ".php")) {
            require_once "../application/model/$model.php";
            return new $model;
        } else {
            echo "$model this model not exist";
        }
    }


    public function Validate($data)
    {
        $img_types = array('image/jpg', 'image/png', 'image/jpeg');
        $is_valid = true;

        function test_input($data_value)
        {
            $data_value = trim($data_value);
            $data_value = stripslashes($data_value);
            $data_value = htmlspecialchars($data_value);
            return $data_value;
        }

        for ($i = 0; $i < count($data); $i++) {

            $data[$i]['value'] = test_input($data[$i]['value']);
            $value = $data[$i]['value'];
            $field = $data[$i]['field'];


            // required method
            if (isset($data[$i]['required'])) {
                if ($value == '') {
                    $error_msg['req_' . $field] = $field . ' is required';
                    $is_valid = false;
                }
            }


            // is_number method
            if (isset($data[$i]['is_number']) && !$value == '') {
                if (!is_numeric($data[$i]['value']) && !empty($data[$i]['value'])) {
                    $error_msg['invalid_' . $field] = $field . ' should be in digits';
                    $is_valid = false;
                }
            }


            // mob_number method
            if (isset($data[$i]['mob_number']) && !$value == '') {
                if (!is_numeric($value)) {
                    $error_msg['invalid_' . $field] = $field . ' number should be in digit format';
                    $is_valid = false;
                } else {
                    if ((int) (log($data[$i]['value'], 10) + 1) !== 10) {
                        $error_msg['limit_' . $field] = $field . ' number should be 10 digits only';
                        $is_valid = false;
                    }
                }
            }


            // email method
            if (isset($data[$i]['email']) && !$value == '') {
                if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
                    $error_msg['invalid_' . $field] = $field . ' address is not valid';
                    $is_valid = false;
                }
            }


            // password(pswd) method
            if (isset($data[$i]['pswd']) && !$value == '') {

                $uppercase = preg_match('@[A-Z]@', $value);
                $lowercase = preg_match('@[a-z]@', $value);
                $number    = preg_match('@[0-9]@', $value);

                if (!$uppercase || !$lowercase || !$number || strlen($value) < 8) {
                    $error_msg['invalid_' . $field] = 'Password should be one upper case one lower case one number and greater than 8 character';
                    $is_valid = false;
                }
            }


            // username method
            if (isset($data[$i]['user_name']) && !$value == '') {
                if (!preg_match('/^[a-z_\-\d]{5,15}$/i', $value)) {
                    $error_msg['invalid_' . $field] = 'Username is not valid ';
                    $is_valid = false;
                }
            }

            // name method
            if (isset($data[$i]['is_string']) && !$value == '') {
                if (ctype_alpha(str_replace(' ', '', $value)) === false) {
                    $error_msg['invalid_' . $field] = $field . ' must contain letters and spaces only ';
                    $is_valid = false;
                }
            }

            // image_type method
            if (isset($data[$i]['type']) && !$value == '') {
                if (!in_array($value, $img_types)) {
                    $error_msg['img_type_error'] = 'Only (jpg - png - jpeg) Image files are allowed.';
                    $is_valid = false;
                }
            }
            // image_size method
            if (isset($data[$i]['size']) && !$value == '') {
                if ($value > 5000) {
                    $error_msg['img_size_error'] = 'Image should be less than 5MB.';
                    $is_valid = false;
                }
            }
        }

        if ($is_valid) {
            return true;
        } else {
            if (isset($error_msg)) {
                return json_encode($error_msg);
            }
        }
    }
}




/***
 * All methods
 *
 * required --> for required field
 * is_number --> for number field only
 * mob_number --> for mobile number only
 * email --> for email
 * pswd --> for password
 * username --> for username
 * Is_string --> for contains string only
 * Image_type --> for image type validation
 * Image size --> for image size validation
 *
 ***/

/*****
 *  As parameter
 * 
 *  $array = [
 *      $array = [
 *          "field" => "name",
 *          "value" => 'narendra singh',
 *          "required" => true,
 *          "is_string" => true
 *       ]
 *  ];
 */
