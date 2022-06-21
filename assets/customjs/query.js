$(document).ready(function () {
    // e.preventDefault();


    $('#login_btn').on('click', function () {
        $username = $('#username').val();
        $password = $('#password').val();

        $is_valid = true;
        if ($username == '') {
            $('#emailError').text('please enter your username').css('color', 'red');
            $is_valid = false;
        }else{
            $('#emailError').text('').css('color', 'red');
            
        }
        if ($password == '') {
            $('#passwordError').text('please enter your password').css('color', 'red');
            $is_valid = false;
        }else{
            $('#passwordError').text('').css('color', 'red');

        }


        if($is_valid){
            $.ajax({
                url : 'controller.php',
                type : 'post',
                data : {
                    username : $username,
                    password : $password
                },
                success : function(response){
                    console.log(response);
                }
            })
        }




    });

    // console.log('lskjkjskfsl');


});