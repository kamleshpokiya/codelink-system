$(document).ready(function () {

    $(".view_user_comments").click(function () {
        $comments = $(this).find('span').text();
        $(".myModal_content").text($comments);
        $("#myModal").modal('show');
    });

    $(".view_admin_comments").click(function () {
        $comments = $(this).find('span').text();
        $(".myModal_content").text($comments);
        $("#myModal").modal('show');
    });
    //Event when (half day) option checked
    $('#leave_type_half_day').click(function () {
        if ($('#leave_type_half_day').is(':checked')) {
            $('#options_half_day_label').css({ 'display': 'block' })
            $('#options_half_day_input').css({ 'display': 'block' })
            $('#half_day_date').css({ 'display': 'none' })
            $('#from_to_date').css({ 'display': 'none' })
            $('#half_leave_type_option').css({ 'display': 'block' })
        }
    });

    //Event when (full day) option checked
    $('#leave_type_full_day').click(function () {
        if ($('#leave_type_full_day').is(':checked')) {
            $('#options_half_day_label').css({ 'display': 'none' })
            $('#options_half_day_input').css({ 'display': 'none' })
            $('#from_to_date').css({ 'display': 'block' })
            $('#half_leave_type_option').css({ 'display': 'none' })

        }
    });


    //To select credit leave option
    $(document).on('click', '.credit_val', function () {
        if ($('.credit_val').hasClass('active')) {
            // $(this).removeClass('active');
            if ($(this).hasClass('active')) {
                $(this).removeClass('active');
                // console.log('this');
            }else{
                if ($('.credit_val').removeClass('active')) {
                    $(this).addClass('active');
                    console.log('any active');
                }
            }
        } else {
            $(this).addClass('active');
        }
    });


    // Apply leave 
    $(document).on('click', '#apply_leave', function () {

        var is_valid = true;

        if ($('#leave_type_full_day').is(':checked')) {

            $leave_type = parseInt($('input[name="leave_type"]:checked').val());
            $half_leave_type = parseInt('');
            $from_date = $('#from_date').val();
            $to_date = $('#to_date').val();
            $subject = $('textarea#subject').val();
            $credit = parseInt($('.credit_val.active').text());
            $non_credit = parseInt($('#non_credit').val());
        } else if ($('#leave_type_half_day').is(':checked')) {

            $leave_type = parseInt($('input[name="leave_type"]:checked').val());
            $half_leave_type = parseInt($('input[name = "half_leave_type"]:checked').val());
            $from_date = $('#half_day_from_date').val();
            $to_date = '';
            $subject = $('textarea#subject').val();
            $credit = parseInt($('.credit_val.active').text());
            $non_credit = parseInt($('#non_credit').val());
        }


        $credit_score = parseInt($('#credit_score').val());
        // Leave form validation
        var border = '1px solid white';
        var iborder = 'none';
        var shadow = '0px 0px 2px white';
        var ishadow = 'none';


        if ($from_date == '') {
            $('#half_day_from_date').css({ 'border': border, 'box-shadow': shadow });
            is_valid = false;
        } else {
            $('#half_day_from_date').css({ 'border': iborder, 'box-shadow': ishadow });
        }
        if ($from_date == '') {
            $('#from_date').css({ 'border': border, 'box-shadow': shadow });
            is_valid = false;
        } else {
            $('#from_date').css({ 'border': iborder, 'box-shadow': ishadow });
        }
        if ($('#leave_type_full_day').is(':checked')) {
            if ($to_date == '') {
                $('#to_date').css({ 'border': border, 'box-shadow': shadow });
                is_valid = false;
            } else {
                $('#to_date').css({ 'border': iborder, 'box-shadow': ishadow });
            }
        }
        if ($subject == '') {
            $('#subject').css({ 'border': border, 'box-shadow': shadow });
            is_valid = false;
        } else {
            $('#subject').css({ 'border': iborder, 'box-shadow': ishadow });
        }


        if(isNaN($credit)){
            $credit = parseInt('0');
        }
        if(isNaN($non_credit)){
            $non_credit = parseInt('0');
        }

        var fd = new FormData();
        fd.append('leave_type', $leave_type);
        fd.append('half_leave_type', $half_leave_type);
        fd.append('leave_from', $from_date);
        fd.append('leave_to', $to_date);
        fd.append('leave_subject', $subject);
        fd.append('from_credit', $credit);
        fd.append('from_non_credit', $non_credit);
        fd.append('total', $credit + $non_credit);
        fd.append('credit_score', $credit_score);

        if (is_valid) {
            $.ajax({
                url: 'sendLeave',
                type: 'POST',
                data: fd,
                processData: false,
                contentType: false,
                success: function (response) {
                    jsonResponse = JSON.parse(response);
                    if (jsonResponse.insert_success) {
                        $('#success_msg').html(`<div class="alert alert-success alert-dismissible fade show" role="alert"><strong>Congrats !</strong> Your leave applied successfully.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>`);
                    }
                    console.log(response);
                }
            });
        }
    });


    //Show change password fields
    $(document).on('click', '#change_pswd', function () {
        $('.toggle').toggle();
    })

    //Show uplaod image file option
    $(document).on('click', '#open_file_input', function () {
        console.log('clicked');
        $('.file_toggle').toggle();
    })

    //Update profile
    $(document).on('click', '#update', function () {
        var is_valid = true;
        $id = $('#user_id').val();
        $fname = $('#first_name').val();
        $lname = $('#last_name').val();
        $email = $('#email').val();
        $dob = $('#dob').val();
        $contact = $('#contact').val();
        $alt_contact = $('#alt_contact').val();
        $address = $('#address').val()


        //Update form validation
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
                { 'id': $id },
                { 'first_name': $fname },
                { 'last_name': $lname },
                { 'email': $email },
                { 'dob': $dob },
                { 'contact': $contact },
                { 'alt_contact': $alt_contact },
                { 'address': $address }
            ];

            if ($('#change_pswd')[0].checked) {
                old_password = $('#old_pass').val();
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
                            'password': new_password,
                            'old_password': old_password
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
                $.ajax({
                    url: 'update_user',
                    type: 'POST',
                    data: fd,
                    processData: false,
                    contentType: false,

                    success: function (response) {

                        jsonResponse = JSON.parse(response);
                        console.log(jsonResponse);

                        // first_name error msg
                        if (jsonResponse.req_first_name) {
                            $('#first_name_msg').text(jsonResponse.req_first_name).css('color', 'red');
                        } else if (jsonResponse.invalid_first_name) {
                            $('#first_name_msg').text(jsonResponse.invalid_first_name).css('color', 'red');
                        } else {
                            $('#first_name_msg').text('');
                        }

                        // last_name error msg
                        if (jsonResponse.req_last_name) {
                            $('#last_name_msg').text(jsonResponse.req_last_name).css('color', 'red');
                        } else if (jsonResponse.invalid_last_name) {
                            $('#last_name_msg').text(jsonResponse.invalid_last_name).css('color', 'red');
                        } else {
                            $('#last_name_msg').text('');
                        }

                        // email error msg
                        if (jsonResponse.req_email) {
                            $('#email_msg').text(jsonResponse.req_email).css('color', 'red');
                        } else if (jsonResponse.invalid_email) {
                            $('#email_msg').text(jsonResponse.invalid_email).css('color', 'red');
                        } else {
                            $('#email_msg').text('');
                        }

                        // dob error msg
                        if (jsonResponse.req_dob) {
                            $('#dob_msg').text(jsonResponse.req_dob).css('color', 'red');
                        } else {
                            $('#dob_msg').text('');
                        }

                        // contact error msg
                        if (jsonResponse.req_contact) {
                            $('#contact_msg').text(jsonResponse.req_contact).css('color', 'red');
                        } else if (jsonResponse.invalid_contact) {
                            $('#contact_msg').text(jsonResponse.invalid_contact).css('color', 'red');
                        } else if (jsonResponse.limit_contact) {
                            $('#contact_msg').text(jsonResponse.limit_contact).css('color', 'red');
                        } else {
                            $('#contact_msg').text('');
                        }

                        // alt_contact error msg
                        if (jsonResponse.req_alt_contact) {
                            $('#alt_contact_msg').text(jsonResponse.req_alt_contact).css('color', 'red');
                        } else if (jsonResponse.invalid_alt_contact) {
                            $('#alt_contact_msg').text(jsonResponse.invalid_alt_contact).css('color', 'red');
                        } else if (jsonResponse.limit_alt_contact) {
                            $('#alt_contact_msg').text(jsonResponse.limit_alt_contact).css('color', 'red');
                        } else {
                            $('#alt_contact_msg').text('');
                        }

                        // address error msg
                        if (jsonResponse.req_address) {
                            $('#address_msg').text(jsonResponse.req_address).css('color', 'red');
                        } else {
                            $('#address_msg').text('');
                        }


                        //image error msg
                        if (jsonResponse.img_type_error) {
                            $('#img_msg').text(jsonResponse.img_type_error).css('color', 'red');
                        } else if (jsonResponse.img_size_error) {
                            $('#img_msg').text(jsonResponse.img_size_error).css('color', 'red');
                        } else {
                            $('#img_msg').text('');
                        }

                        //password error msg
                        if (jsonResponse.req_password) {
                            $('#password_msg').text(jsonResponse.req_password).css('color', 'red');
                        } else if (jsonResponse.invalid_password) {
                            $('#password_msg').text(jsonResponse.invalid_password).css('color', 'red');
                        } else if (jsonResponse.Incorect_old_password) {
                            $('#password_msg').text(jsonResponse.Incorect_old_password).css('color', 'red');
                            console.log(jsonResponse.Incorect_old_password);
                        } else {
                            $('#password_msg').text('');
                        }


                        if (jsonResponse.updation_success) {
                            var load = location.reload();
                        }
                        else if (jsonResponse.updation_failed) {
                            $('#update_msg').html(` <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            Profile not  updated.
                            <button type="button" class="btn-close"  data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>`);
                        }
                    }
                });
            }
        }

    })


});
