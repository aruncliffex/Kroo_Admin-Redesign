  <div class="profile">

            <form class="form-horizontal" id="setting_form">
            <fieldset>

          
            <legend>
             <a onclick="goBack()" href="javascript:void(0);" class="btn btn-default">   <i class="fa fa-long-arrow-left fa-lg"></i> </a>  Profile Settings</legend>
             <input type="hidden" name="user_id" id="user_id" value="<?php echo $user_id; ?>">

            <div class="form-group">
              <label class="col-md-4 control-label" for="user_name">Name</label>  
              <div class="col-md-5">
              <input id="user_name" name="user_name" placeholder="name" class="form-control input-md" type="text" value="<?php echo $user_name; ?>">
                
              </div>
            </div>

            <!-- Text input-->
            <div class="form-group">
              <label class="col-md-4 control-label" for="user_email">Email</label>  
              <div class="col-md-5">
              <input id="user_email" name="user_email" placeholder="email" class="form-control input-md" type="text" value="<?php echo $user_email; ?>" readonly >
                
              </div>
            </div>

            <div class="form-group">
              <label class="col-md-4 control-label" for="user_mobile">Mobile</label>  
              <div class="col-md-5">
              <?php 
                if($user_mobile!=0){
                    echo '<input id="user_mobile" name="user_mobile" placeholder="mobile" class="form-control input-md" value="'.$user_mobile.'" type="text">';
                }else{
                    echo '<input id="user_mobile" name="user_mobile" placeholder="mobile" class="form-control input-md" value="0" type="text">';
                }   
              ?>
              
                
              </div>
            </div>
            <!-- Text input-->

            <div class="form-group">
              <label class="col-md-4 control-label" for="user_role">Role</label>
              <div class="col-md-5">
                <select id="user_role" name="user_role" class="form-control">
                <?php  
                    if($user_role=='admin'){
                        echo '<option value="admin" selected>admin</option>';
                    }else{       
                        echo '<option value="user" selected>user</option>';
                        //echo '<option value="admin">admin</option>';
                    }

                ?>
                </select>
              </div>
            </div>

             <div class="form-group">
              <label class="col-md-4 control-label" for="user_address">Address</label>
              <div class="col-md-5">                     
                <textarea class="form-control" id="user_address" name="user_address" ><?php echo $user_address; ?></textarea>
              </div>
            </div>

            <div class="form-group">
              <label class="col-md-4 control-label" for="button1id"></label>
              <div class="col-md-8">
                <button id="btn_save_settings" name="button2id" class="btn btn-primary">Save Settings</button>
                <button id="button1id" name="button1id" class="btn btn-success" data-toggle="modal" data-target="#reset_pwd" >Change Password</button>

              </div>
            </div>
          

            </fieldset>
            </form>


</div>

<div class="modal fade bd-example-modal-sm" id="reset_pwd" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-sm">
                        <div class="modal-content">
                            <div class="modal-header">
                                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                                  <h4 class="modal-title">Reset Password</h4>
                            </div>

                            <div class="modal-body">
                                 <form id="pwd_reset_form">
                                    <div class="modal-body with-padding"> 

                                            <input type="hidden" name="p_user_id" id="p_user_id" value="<?php echo $user_id; ?>">

                                            <div class="form-group">
                                              <div class="row">
                                                
                                                <label>Old Password *</label>
                                                  <input type="password" id="old_password" name="old_password" class="form-control required">
                                                <div id="reg_old_password_err" class="error"></div>
                                                
                                              </div>
                                            </div> 


                                            <div class="form-group">
                                              <div class="row">
                                                
                                                <label>New Password *</label>
                                                  <input type="password" id="user_password" name="user_password" class="form-control required">
                                                <div id="reg_user_password_err" class="error"></div>
                                                
                                              </div>
                                            </div> 

                                            <div class="form-group">
                                              <div class="row">
                                                
                                                  <label>Confirm Password *</label>
                                                  <input type="password" id="user_c_password" name="user_c_password" class="form-control required">
                                                <div id="reg_user_c_password_err" class="error"></div>
                                                
                                              </div>
                                            </div> 


                                     </div>
                                    
                                    <div id="change_error" ></div>
                                
                              
                                   <button type="submit" id="btn_reset_password" class="btn btn-primary">Save</button>              
                                  
                                   <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                      
                                
                               
                                </form>   

                            </div>

                        </div>
                    </div>
                </div>

                <script>                  
                  function goBack() {
                      window.history.back();
                  }
                </script>