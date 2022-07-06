$(document).ready(function () {

    $(document).on('click', '#change_pswd', function () {
        $('.toggle').toggle();
    })

    $(document).on('click', '#open_file_input', function () {
        console.log('clicked');
        $('.file_toggle').toggle();
    })

    $(document).on('click', '#update', function () {
        var is_valid = true;
        console.log('update button clicked');

        $id = $('#user_id').val();
        $fname = $('#first_name').val();
        $lname = $('#last_name').val();
        $email = $('#email').val();
        $dob = $('#dob').val();
        $contact = $('#contact').val();
        $alt_contact = $('#alt_contact').val();
        $address = $('#address').val()

        var border = '1px solid white';
        var iborder = 'none';
        var shadow = '0px 0px 2px white';
        var ishadow = 'none';

        if ($fname == '') {
            $('#first_name').css({ 'border': border, 'box-shadow': shadow });
            is_valid = false;
        }
        else {
            $('#first_name').css({ 'border': iborder, 'box-shadow': ishadow });
        }
        if ($lname == '') {
            $('#last_name').css({ 'border': border, 'box-shadow': shadow });
            is_valid = false;
        }
        else {
            $('#last_name').css({ 'border': iborder, 'box-shadow': ishadow });
        }
        if ($email == '') {
            $('#email').css({ 'border': border, 'box-shadow': shadow });
            is_valid = false;
        }
        else {
            $('#email').css({ 'border': iborder, 'box-shadow': ishadow });
        }
        if ($dob == '') {
            $('#dob').css({ 'border': border, 'box-shadow': shadow });
            is_valid = false;
        }
        else {
            $('#dob').css({ 'border': iborder, 'box-shadow': ishadow });
        }
        if ($contact == '') {
            $('#contact').css({ 'border': border, 'box-shadow': shadow });
            is_valid = false;
        }
        else {
            $('#contact').css({ 'border': iborder, 'box-shadow': ishadow });
        }
        if ($alt_contact == '') {
            $('#alt_contact').css({ 'border': border, 'box-shadow': shadow });
            is_valid = false;
        }
        else {
            $('#alt_contact').css({ 'border': iborder, 'box-shadow': ishadow });
        }
        if ($address == '') {
            $('#address').css({ 'border': border, 'box-shadow': shadow });
            is_valid = false;
        }
        else {
            $('#address').css({ 'border': iborder, 'box-shadow': ishadow });
        }


        if (is_valid) {

            var fd = new FormData();
            var files = $('#profile_pic')[0].files[0];

            if (files != undefined) {
                fd.append('file', files);
            }


            const data = [
                { 'first_name': $fname },
                { 'last_name': $lname },
                { 'email': $email },
                { 'dob': $dob },
                { 'contact': $contact },
                { 'alt_contact': $alt_contact },
                { 'address': $address }
            ];

            if ($('#change_pswd')[0].checked) {
                new_password = $('#update_new_pass').val();
                confirm_password = $('#update_confirm_pass').val();

                if (new_password == '' || confirm_password == '') {
                    msg_empty = '  -) Please enter your password';
                    $('#pswd_msg').text(msg_empty).css({ 'color': 'red' });
                    is_valid = false;
                } else {
                    $('#pswd_msg').text('');
                    if (new_password != confirm_password) {
                        msg_match = '  -) Password does not match';
                        $('#pswd_msg').text(msg_match).css({ 'color': 'red' });
                        is_valid = false;
                    } else {
                        $('#pswd_msg').text('');
                        data.push({
                            'password': new_password
                        })

                    }
                }
            } else {
                $('#pswd_msg').append('').css({ 'color': '#6c7293' });
            }

            $.each(data, function () {
                $.each(this, function (name, value) {
                    fd.append(name, value);
                });
            });

            if (is_valid) {
                console.log('here');
                $.ajax({
                    url: 'profile_update.php',
                    type: 'POST',
                    data: fd,
                    processData: false,
                    contentType: false,

                    success: function (response) {

                        jsonResponse = JSON.parse(response);
                        // console.log(jsonResponse);

                        // first_name error msg
                        // if (jsonResponse.req_first_name) {
                        //     $('#first_name_msg').text(jsonResponse.req_first_name).css('color', 'red');
                        // } else if (jsonResponse.invalid_first_name) {
                        //     $('#first_name_msg').text(jsonResponse.invalid_first_name).css('color', 'red');
                        // } else {
                        //     $('#first_name_msg').text('');
                        // }
                        // // last_name error msg
                        // if (jsonResponse.req_last_name) {
                        //     $('#last_name_msg').text(jsonResponse.req_last_name).css('color', 'red');
                        // } else if (jsonResponse.invalid_last_name) {
                        //     $('#last_name_msg').text(jsonResponse.invalid_last_name).css('color', 'red');
                        // } else {
                        //     $('#last_name_msg').text('');
                        // }
                        // // email error msg
                        // if (jsonResponse.req_email) {
                        //     $('#email_msg').text(jsonResponse.req_email).css('color', 'red');
                        // } else if (jsonResponse.invalid_email) {
                        //     $('#email_msg').text(jsonResponse.invalid_email).css('color', 'red');
                        // } else {
                        //     $('#email_msg').text('');
                        // }
                        // // dob error msg
                        // if (jsonResponse.req_dob) {
                        //     $('#dob_msg').text(jsonResponse.req_dob).css('color', 'red');
                        // } else {
                        //     $('#dob_msg').text('');
                        // }

                        // // contact error msg
                        // if (jsonResponse.req_contact) {
                        //     $('#contact_msg').text(jsonResponse.req_contact).css('color', 'red');
                        // } else if (jsonResponse.invalid_contact) {
                        //     $('#contact_msg').text(jsonResponse.invalid_contact).css('color', 'red');
                        // } else if (jsonResponse.limit_contact) {
                        //     $('#contact_msg').text(jsonResponse.limit_contact).css('color', 'red');
                        // } else {
                        //     $('#contact_msg').text('');
                        // }
                        // // alt_contact error msg
                        // if (jsonResponse.req_alt_contact) {
                        //     $('#alt_contact_msg').text(jsonResponse.req_alt_contact).css('color', 'red');
                        // } else if (jsonResponse.invalid_alt_contact) {
                        //     $('#alt_contact_msg').text(jsonResponse.invalid_alt_contact).css('color', 'red');
                        // } else if (jsonResponse.limit_alt_contact) {
                        //     $('#alt_contact_msg').text(jsonResponse.limit_alt_contact).css('color', 'red');
                        // } else {
                        //     $('#alt_contact_msg').text('');
                        // }

                        // // address error msg
                        // if (jsonResponse.req_address) {
                        //     $('#address_msg').text(jsonResponse.req_address).css('color', 'red');
                        // } else {
                        //     $('#address_msg').text('');
                        // }


                        // //image error msg
                        // if (jsonResponse.img_type_error) {
                        //     $('#img_msg').text(jsonResponse.img_type_error).css('color', 'red');
                        // } else if (jsonResponse.img_size_error) {
                        //     $('#img_msg').text(jsonResponse.img_size_error).css('color', 'red');
                        // } else {
                        //     $('#img_msg').text('');
                        // }

                        // //password error msg
                        // if (jsonResponse.req_password) {
                        //     $('#password_msg').text(jsonResponse.req_password).css('color', 'red');
                        // } else if (jsonResponse.invalid_password) {
                        //     $('#password_msg').text(jsonResponse.invalid_password).css('color', 'red');
                        // } else {
                        //     $('#password_msg').text('');
                        // }


                        // if (jsonResponse.updation_success) {
                        //     var load = location.reload();
                        // }
                        // else if (jsonResponse.updation_failed) {
                        //     $('#update_msg').html(` <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        //     Profile not  updated.
                        //     <button type="button" class="btn-close"  data-bs-dismiss="alert" aria-label="Close"></button>
                        //     </div>`);
                        // }

                    }
                });
            }
        }

    })


});
