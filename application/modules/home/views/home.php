 
<!DOCTYPE html>
<html class="full" lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="#">
    <meta name="author" content="#">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo ASSETS?>favicon.ico">


    <title>Kroo Admin</title>

    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    
    <link href="<?php echo SITEURL?>assets/css/bootstrap.min.css" rel="stylesheet">

    
    <link href="<?php echo SITEURL?>assets/css/cover.css" rel="stylesheet">

      
  </head>

  <body>

      <div class="site-wrapper">
              <div class="site-wrapper-inner">
                  <div class="cover-container">

                      <div class="masthead clearfix">
                          <div class="inner">
                              <img src="<?php echo SITEURL?>assets/logo.png" alt="Brand"> 
                          </div>
                      </div>                 

                      <div class="inner cover" id="signin_page">
                          <h2 class="cover-heading">Sign in</h2>
                          
                          <form method="post" id="login">
                              <div class="form-group">
                                  <input type="email" name="username" class="form-control" placeholder="Email">
                                   <div id="login_username_err" class="error"></div>
                              </div>
                              <div class="form-group">
                                  <input type="password" name="password" class="form-control" placeholder="Password">
                              </div>

                              <button type="submit" style="margin-bottom:10px;" id="btn_login_page" class="btn btn-lg btn-primary btn-block">Submit</button>
                              <input type="hidden" name="timezoneoffset" value="0">
                              <button class="btn btn-primary btn-lg btn-block" style="display:none;" id="btn_loading_page"><i class="fa fa-refresh fa-spin"></i> Loading</button>

                              <div id="login_err" class="error pull-left" style="color:red;"></div>
                          </form>

                          <div style="display:none;" id="btn_forgot_pwd">
                            <a href="javascript:void(0);" id="btn_forgot_password">Forgot password?</a>
                          </div>
                          
                      </div>



                       <div class="inner cover" id="password_page" style="display:none;">
                          <h2 class="cover-heading">Reset Password !</h2>
                          
                          <form method="post" id="reset_pwd">
                              <div class="form-group">
                                  <input type="email" name="email" class="form-control" placeholder="Email">
                                   <div id="login_username_err" class="error"></div>
                              </div>
                             

                              <button type="submit" style="margin-bottom:10px;" id="btn_submit" class="btn btn-lg btn-primary btn-block">Submit</button>
                              <button class="btn btn-primary btn-lg btn-block" id="btn_loading"><i class="fa fa-refresh fa-spin"></i> Loading</button>
                              
                          </form>
                         
                      </div>



                      <div class="mastfoot">
                          <div class="inner">
                              <p><a href="#">Copyright &copy Kroo, 2016</a></p>
                          </div>
                      </div>

                  </div>
              </div>
          </div>

   
    
    <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    
<script type="text/javascript">
    $(function(){
      var d = new Date()
      var n = d.getTimezoneOffset();
      $('input[name="timezoneoffset"]').val(n);

    });

    $(document).on("submit","#login",function(e){
                e.preventDefault();
                $('.error').html('');
                $('#btn_login_page').hide();
                $('#btn_loading_page').show();
                var ele   = $('#login');
                var data  = ele.serialize();
                var url   = "<?php echo SITEURL;?>home/user_login";
                $.ajax({
                   data : data,
                   url : url,
                   method: 'POST'
                }).done(function(data){
                     if(data==1){            
                           window.location.href = "<?php echo SITEURL;?>dashboard/main";}
                           else if(data==0)
                           {
                              document.getElementById('login_err').innerHTML = "Username or Password Error";
                              $('#btn_forgot_pwd').show();
                              $('#btn_login_page').show();
                              $('#btn_loading_page').hide();
                           }
                    else 
                    {
                        if( typeof data.errors === 'object' ) 
                        {
                            $.each(data.errors, function(key, val) {
                            $('#login_'+key+'_err').html(val);
                        });

                            //$('#btn_forgot_pwd').show();
                       } 
                       
                    } 
                           
                });
          });

        $(document).on('click', '#btn_forgot_password', function(){
            $('#signin_page').hide();
            $('#password_page').show();
            $('#btn_loading').hide();
            //alert("test");
        });


        $(document).on("submit","#reset_pwd",function(e){
                e.preventDefault();
                $('.error').html('');
                $('#btn_submit').hide();
                $('#btn_loading').show();
                var ele   = $('#reset_pwd');
                var data  = ele.serialize();
                var url   = "<?php echo SITEURL;?>home/reset_pwd";
                $.ajax({
                   data : data,
                   url : url,
                   method: 'POST'
                }).done(function(data){
                    
                        if(data==true){
                            $('#signin_page').show();
                            $('#password_page').hide();
                        }
                        else{
                            $('#btn_loading').hide();
                            $('#btn_submit').show();
                            alert('email does not exits');
                        }
                      
                });
          });

    </script>

  </body>
</html>


