$(document).ready(function(){

      var f_name = $('#first_name').val();
      var first_name = $.trim(f_name);
      var l_name = $('#last_name').val();
      var last_name = $.trim(l_name);
      var em = $('#email').val();
      var email = $.trim(em);
      var pass = $('#password').val();
      var password = $.trim(pass);

          $.ajax({
            url: "add_users",
            type: "POST",
            data: {
              first_name: first_name,
              last_name: last_name,
              email: email,
              password: password
            },
            success:function(data) {
              console.log('status');
            }

          });


  });