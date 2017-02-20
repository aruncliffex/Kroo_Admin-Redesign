 <div class="wrapper row-offcanvas row-offcanvas-left">
            <!-- Left side column. contains the logo and sidebar -->
            <aside class="left-side sidebar-offcanvas" style="display:none;">
                <!-- sidebar: style can be found in sidebar.less -->

      
                <section class="sidebar">
                    <!-- Sidebar user panel -->
                    <div class="user-panel">
                        <div class="pull-left image">
                            <img src="<?php echo ASSETS?>images/avatar3.png" class="img-circle" alt="User Image" />
                        </div>
                        <div class="pull-left info">
                            <p><?php echo $this->session->userdata('name');  ?></p>
                        </div>
                    </div>
                    <!-- search form -->
                    <form action="#" method="get" class="sidebar-form">
                        <div class="input-group">
                            <input type="text" name="q" class="form-control" placeholder="Search..."/>
                            <span class="input-group-btn">
                                <button type='submit' name='seach' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
                            </span>
                        </div>
                    </form>
                    <ul class="sidebar-menu">
                        <li class="">
                            <a href="<?php echo SITEURL ?>dashboard/main">
                                <img class="exSp img-circle" style="background-color:#FFFFFF" src="<?php echo ASSETS?>images/Anaheim-Ducks.png" width="35px"><span class="teamName">DASHBOARD</span>
                            </a>
                        </li>

                    </ul>
                </section>
                <!-- /.sidebar -->
            </aside>

            <aside><!-- <aside class="right-side"> -->

            
            <button class="btn btn-default btn-add-sponser" type="button" data-target="#mySponserModal" data-toggle="modal" style="margin-left: 61px; width: 191px;">Add sponsor
            </button>
            <div id="message_success_insert" style="display:none;background-color: #27C24C;border-radius: 14px;color: #FFFFFF;left: 42%;padding-top: 6px; padding-left:20px; padding-right:20px; position: absolute;top: 63px;"><p id="message_text"><b>Saved Successfully !</b></p></div>
            <div id="message_success_update" style="display:none;background-color: #27C24C;border-radius: 14px;color: #FFFFFF;left: 42%;padding-top: 6px; padding-left:20px; padding-right:20px; position: absolute;top: 63px;"><p id="message_text"><b>Updated Successfully !</b></p></div>
          
               <!--  <a onclick="goBack()" href="javascript:void(0);">
                        <i class="fa fa-arrow-left"></i>
                </a> -->
                <section class="content">

                    <div class="row">

                        <div class="col-xs-12">

                            <div class="panel"> 
                               
                                <div class="panel-body table-responsive">

                                <!--  <div class="round-button" style="position:fixed; top:825px; right:85px; z-index:100;"><div class="round-button-circle"><a href="" class="round-button" data-toggle="modal" data-target="#myModal"><img src="<?php echo ASSETS ?>add.png" style="width:25px;"></a></div></div> -->

                                   <table class="table table-bordered table-striped example1" id="users_list">
                                       <thead>
                                        <tr>
                                            
                                            <th class="col-md-1">Images</th>
                                            <th class="col-md-1">label</th>
                                            <th class="col-md-1">Link</th>
                                            <th class="col-md-1">Action</th>

                                             
                                        </tr>
                                       </thead>
                                       <tbody>

                                        <?php 
                                        if(!empty($sponser)){ 
                                            foreach($sponser as $user){

                                                    echo '<tr id="row_'.$user['id'].'">';

                                                      
                                                        echo '<td class="col-md-1">';


                                                        echo '<img id="images'.$user['id'].'" src="'.S3_PATH.'sponsers/'.$user['logo'].'" style="width:120px;" data-id="images'.$user['id'].'">';

                                                        echo '</td>';

                                                        echo '<td class="col-md-1">';
                                                            echo '<p id="label'.$user['id'].'">'.$user['label'].'</p>';   
                                                        echo '</td>';

                                                        echo '<td class="col-md-1">';
                                                            echo '<p id="link'.$user['id'].'">'.$user['link'].'</p>';   
                                                        echo '</td>';


                                                        echo '<td class="col-md-1 ">';
                                                            echo '<p><button data-id="'.$user['id'].'" id="edit'.$user['id'].'" name="singlebutton" class="btn btn-primary edit-sponser-btn" data-toggle="modal" data-target="#mySponserModal">Edit</button>

                                                            </p>';   
                                                        echo '</td>';
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



                <!-- Add game Modal start -->
                  <div class="modal fade" id="mySponserModal" role="dialog">
                    <div class="modal-dialog">
                    
                      <!-- Modal content-->
                      <div class="modal-content" style="width: 126%;">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                          <h4 class="modal-title" id="addSponser"></h4>
                        </div>

                      <div class="">

                              <form class="form-horizontal" enctype="multipart/form-data" accept-charset="utf-8"  method="post" action="" id="SponserAdd" name="Sponserinfo">
                              <fieldset>

                            
                              <legend>

                              </legend>
                              <!-- Text input-->
                              <div class="form-group">
                                <label class="col-md-2 control-label" for="user_email">label</label>  
                                <div class="col-md-5">
                                <input type="hidden" name="id" id="sponserId">
                                <input id="label" name="label" placeholder="label" class="form-control input-md" type="text" value="">
                                <div id="label_error" class="error" style="color: red; display: none;">This label already filled. please fill unique</div>
                                
                                </div>
                              </div>

                              <div class="form-group">
                                <label class="col-md-2 control-label" for="user_email">Link</label>  
                                <div class="col-md-5">
                                <input id="link" name="link" placeholder="link" class="form-control input-md" type="text" value="">
                                <div id="login_credits_err" class="error"></div>
                                </div>
                              </div> 


                             <div class="form-group">
                                <label class="col-md-2 control-label" for="user_email">upload</label>
                                <input type ="hidden" name="logo" id="logo" >  
                                <div class="col-md-5">                              
                                  <input type ="file" name="userfile" id="img" >  
                                  <div id="img_error"  style="color: red;  display: none;">upload image maximum height should be  60px and  width 60px </div>
                                </div>
                              </div>



                              </fieldset>
                              </form>

                              <div class="form-group" style="margin-left: 3%; margin-top:5px;">

                              </div>

                        </div>
                        <div class="modal-footer" style="text-align: left;">
                          <button class="btn btn-primary"  id="submit_sponser_form" style="width: 75px;" >Save</button>
                      
                          <button type="button" class=" btn btn-default" style="width: 75px; margin-left: 2px;" data-dismiss="modal">Close</button>
                        </div>
                      </div>
                      
                    </div>
                  </div> 
                <!-- Add game modal End----------------> 







                <div class="footer-main" style="bottom: 0; position: fixed; width: 100%;">
                    Copyright &copy Kroo, 2015
                </div>
            </aside><!-- /.right-side -->

        </div><!-- ./wrapper -->

<script type="text/javascript">  
 
        $(document).on("click","#submit_sponser_form",function(e){
               // e.preventDefault();
                var sponserId= $('#sponserId').val();
                var label= $('#label').val();

                var url = SITEURL + 'sponser/get_sponser_label/'+label+'/'+sponserId;   
                $.ajax({
                url : url,
                type : 'post'
                }).done(function(getdata){ 

                  if(getdata ==""){   

                      if(sponserId==0){   
      
                          $('.error').html('');
                         // var ele   = $('#SponserAdd');
                          var frmdata=new FormData($('form[name="Sponserinfo"]')[0]);
                          var url   = "<?php echo SITEURL;?>sponser/insert_sponser";
                          $.ajax({
                          data: frmdata,
                          url : url,
                          async: false,
                          type: 'POST',
                          cache: false,
                          contentType: false,
                          processData: false
                          }).done(function(data){  
                            if(data !=null){  
                              var error= data.error['error'];
                              $('#img_error').show().text();

                            }else{
                              $('#mySponserModal').modal('hide');
                              location.reload();
                              $('#message_success_insert').css({'display':''});
                              $('#message_success_insert').delay(3000).fadeOut(400);                          
                            }

                                     
                          });

                       }else{ 
                          $('.error').html('');               
                         // var ele   = $('#SponserAdd');
                          var frmdata=new FormData($('form[name="Sponserinfo"]')[0]);
                          var url   = "<?php echo SITEURL;?>sponser/update_sponser";
                          $.ajax({
                          data: frmdata,
                          url : url,
                          async: false,
                          type: 'POST',
                          cache: false,
                          contentType: false,
                          processData: false
                          }).done(function(data){ 
                            if(data !=null){  
                              var error= data.error['error'];
                              $('#img_error').show().text();

                            }else{
                              $('#mySponserModal').modal('hide');
                              location.reload();
                              $('#message_success_update').css({'display':''});
                              $('#message_success_update').delay(3000).fadeOut(400);                          
                            }
                                     
                          });


                      }
                }else{
                  $('#label_error').show();
                }
              });  
          });



      $(document).on("click",".edit-sponser-btn",function(e){
          $('form[id="SponserAdd"]')[0].reset();
          var edittxt="Edit Sponser";
          $('#addSponser').text(edittxt); 
          var id = $(this).data("id"); 
          $('#sponserId').val(id);

          var url = SITEURL + 'sponser/sponser_detail/'+id; 
          $.ajax({
            url:url,                    
          }).done(function(getdata){
              if(getdata !=null){ 

                  $.each(getdata,function(i,row){ 

                    var label = row['label'];
                    var logo = row['logo'];
                    var link = row['link']; 
                    $('#label').val(label);
                    $('#logo').val(logo);
                    $('#link').val(link);

                });
              }
          });

      });

      $(document).on("click",".btn-add-sponser",function(e){
          $('form[id="SponserAdd"]')[0].reset();  

          $('#sponserId').val(0); 
          var edittxt="Add Sponser";
          $('#addSponser').text(edittxt);
               // e.preventDefault();

      });



</script>