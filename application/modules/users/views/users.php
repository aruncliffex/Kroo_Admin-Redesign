<div class="wrapper row-offcanvas row-offcanvas-left">
            <aside><!-- <aside class="right-side"> -->

                <button style="margin-left:10px;" onclick="goBack()" class="btn btn-default">
                    <i class="fa fa-arrow-left fa-lg"></i>
                </button>
                <button data-target="#myModal" class="btn btn-default" data-toggle="modal">
                        <i class="fa fa-user-plus"></i>
                        <a href="<?php echo SITEURL ?>dashboard/main">
                                <span class="teamName">Add User</span>
                        </a>
                </button>
         
                <section class="content">

                    <div class="row">
                        <div class="col-xs-12">

                            <div class="panel">
                               
                                <div class="panel-body table-responsive">

                                <!--  <div class="round-button" style="position:fixed; top:825px; right:85px; z-index:100;"><div class="round-button-circle"><a href="" class="round-button" data-toggle="modal" data-target="#myModal"><img src="<?php echo ASSETS ?>add.png" style="width:25px;"></a></div></div> -->

                                   <table class="table table-bordered table-striped example1" id="users_list">
                                       <thead>
                                       <tr>
                                            <th class="col-md-1"><span class="glyphicon glyphicon-asterisk" aria-hidden="true"></span></th>              
                                            <th class="col-md-2 ">Name</th>
                                            <th class="col-md-2 ">Email</th>
                                            <th class="col-md-1 ">Role</th>
                                             <th class="col-md-1">Read</th>
                                              <th class="col-md-1">Edit</th>
                                               <th class="col-md-1">Publish</th>
                                                <th class="col-md-1">Notify</th>
                                                <th class="col-md-1">Delete</th>
                                            <th class="col-md-* text-right"><span class="glyphicon glyphicon-flag" aria-hidden="true"></span></th>
                                        </tr>
                                       </thead>
                                       <tbody>
                                        <?php 
                                        if(!empty($info)){
                                            foreach($info as $user){

                                                    echo '<tr id="user_row_'.$user['user_id'].'">';
                                                        echo '<td class="col-md-1"><label class="checkbox"><input type="checkbox"></label></td>';
                                                        echo '<td class="col-md-2 ">';
                                                            echo '<div class="media">';
                                                                echo '<i class="fa fa-user fa-lg"></i>&nbsp;&nbsp;';
                                                                echo '<a data-id="'.$user['user_id'].'" href="'.SITEURL.'users/profile/'.$user['user_id'].'">';
                                                                echo '<span>'.$user['name'].'</span>';
                                                                echo '</a>';
                                                            echo '</div>';
                                                        echo '</td>';

                                                        echo '<td class="col-md-2 ">';
                                                            echo '<p>'.$user['email'].'</p>';    
                                                        echo '</td>';

                                                        echo '<td class="col-md-1 ">';
                                                            echo '<p>'.$user['role'].'</p>';   
                                                        echo '</td>';

                                                        echo '<td class="col-md-1 ">';
                                                            echo '<p>'.$user['read'].'</p>';   
                                                        echo '</td>';

                                                        echo '<td class="col-md-1 ">';
                                                            echo '<p>'.$user['edit'].'</p>';   
                                                        echo '</td>';

                                                        echo '<td class="col-md-1 ">';
                                                            echo '<p>'.$user['publish'].'</p>';   
                                                        echo '</td>';

                                                        echo '<td class="col-md-1 ">';
                                                            echo '<p>'.$user['notify'].'</p>';   
                                                        echo '</td>';

                                                        echo '<td class="col-md-1 ">';
                                                            echo '<p>'.$user['delete'].'</p>';   
                                                        echo '</td>';
                                                        $myId = $this->session->userdata('id');
                                                        if($user['user_id'] != $myId){

                                                                echo '<td class="text-right">';
                                                                echo '<div class="dropdown">';
                                                                    echo '<a aria-expanded="false" aria-haspopup="true" role="button" data-toggle="dropdown" class="dropdown-toggle" href="#" id="menu1">Action<span class="caret"></span> </a>';
                                                                    echo '<ul style="text-align:center;" class="dropdown-menu" role="menu" aria-labelledby="menu1">';
                                                                        echo '<li role="presentation"><a class="btn_reset_password" data-toggle="modal" data-target="#reset_pwd" data-id="'.$user['user_id'].'" href="javascript:void(0);">Reset Password</a></li>';
                                                                        // echo '<li role="presentation"><a href="#">Reset Username</a></li>';
                                                                        echo '<li role="presentation"><a class="btn_delete_account" data-id="'.$user['user_id'].'" href="javascript:void(0);">Delete Account</a></li>';
                                                         
                                                         
                                                                    echo '</ul>';
                                                                echo '</div>';
                                                            echo '</td>';
                                                        }else{
                                                            echo '<th class="col-md-* text-right"></th>';
                                                        }
                                                       
                                                    echo '</tr>';
                                                }
                                            }
                                        ?>

                                          </tbody>
                                        
                                        
                                        
                                    </table>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
                        </div>
                    </div>
                </section><!-- /.content -->
                <div class="footer-main" style="bottom: 0; position: fixed; width: 100%;">
                    Copyright &copy Kroo, 2015
                </div>
            </aside><!-- /.right-side -->

           

        </div><!-- ./wrapper -->

                <div class="modal fade" id="myModal" role="dialog">
                    <div class="modal-dialog">
                    
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                          <h4 class="modal-title">Add New User</h4>
                        </div>
                        <div class="modal-body">
                            <form id="register_form">
                                  <div class="modal-body with-padding"> 

                                  <div class="form-group">
                                      <div class="row">
                                        
                                          <label>Name *</label>
                                          <input type="text" id="user_name" name="user_name" class="form-control required">
                                          <div id="reg_user_name_err" class="error"></div>
                                        
                                      </div>
                                    </div>

                                    <div class="form-group">
                                      <div class="row">
                                       
                                          <label>Email *</label>
                                          <input type="email" id="user_email" name="user_email" class="form-control required email">
                                          <div id="reg_user_email_err" class="error"></div>
                                       
                                      </div>
                                    </div>

                                    <div class="form-group">
                                      <div class="row">
                                        
                                        <label>Role *</label>
                                            <select class="form-control" id="user_role" name="user_role">
                                                <option>Select Role</option>
                                                <option>Admin</option>
                                                <option>User</option>
                                                
                                            </select>
                                        <div id="reg_user_role_err" class="error"></div>
                                        
                                      </div>
                                    </div> 

                                  </div>
                               <div id="reg_err" class="error"></div>
                                
                              
                               <button type="submit" id="btn_add_user" class="btn btn-primary">Register</button>              
                              
                               <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                               
                        </form>          
                        </div>
                      </div>
                      
                    </div>
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

                                            <input type="hidden" name="p_user_id" id="p_user_id">
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


        $(document).on("click","#btn_add_user",function(e){
                e.preventDefault();
                $('.error').html('');
                var ele = $('#register_form');
                var data = ele.serialize();
                var url = '<?php echo SITEURL ?>users/register_do';
                $.ajax({
                    data:data,
                    url : url,
                    type : 'post'
                }).done(function(getdata){
                     if( typeof getdata.errors === 'object' ) 
                        {
                            $.each(getdata.errors, function(key, val) {
                            $('#reg_'+key+'_err').html(val);
                           });
                        } 
                    if(getdata==true){
                        $('#myModal').modal('hide');
                        location.reload(true);
                    }
                });
        });


        $(document).on('click','.btn_delete_account',function(){
            var user_id = $(this).data('id');
            var url = '<?php echo SITEURL ?>users/delete_user/'+user_id;
            var r = confirm("Do you want to delete ?");
            if(r==true)
            {
                $.ajax({
                    url : url
                }).done(function(getdata){
                    $('#user_row_'+user_id).hide();
                });
            }
        });

        $(document).on('click','.btn_reset_password',function(){
            var user_id = $(this).data('id');
            $('#p_user_id').val(user_id);
        });


         $(document).on("click","#btn_reset_password",function(e){
                e.preventDefault();
                $('.error').html('');
                var user_id = $('#p_user_id').val();
                var ele = $('#pwd_reset_form');
                var data = ele.serialize();
                var url = '<?php echo SITEURL ?>users/reset_pwd/'+user_id;
                $.ajax({
                    data:data,
                    url : url,
                    type : 'post'
                }).done(function(getdata){
                        if( typeof getdata.errors === 'object' ) 
                        {
                            $.each(getdata.errors, function(key, val) {
                            $('#reg_'+key+'_err').html(val);
                           });
                        } 
                        if(getdata==true){
                           $('#reset_pwd').modal('hide'); 
                        }
                    // if(getdata==true){
                    //     
                    // }
                });
        });

        </script>
