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

            
            <button class="btn btn-default btn-add-actCredits" type="button" data-target="#myActCreditsModal" data-toggle="modal" style="margin-left: 61px; width: 191px;">Add Level
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
                                            <th class="col-md-1">S.No</th>
                                            <th class="col-md-1">Points Start</th>
                                            <th class="col-md-1">Points End</th>
                                            <th class="col-md-1">Multiplied</th>
                                            <th class="col-md-1">Credits</th>
                                            <th class="col-md-1">Action</th>
                                             
                                        </tr>
                                       </thead>
                                       <tbody>

                                        <?php 
                                        if(!empty($activity)){ $i =1;
                                            foreach($activity as $user){

                                                    echo '<tr id="row_'.$user['id'].'">';
                                                        echo '<td class="col-md-1">';
                                                            echo '<p>'.$i.'</p>'; 
                                                        echo '</td>';
                                                      
                                                        echo '<td class="col-md-1">';
                                                            echo '<p id="points_start'.$user['id'].'">'.$user['points_start'].'</p>';   
                                                        echo '</td>';


                                                        echo '<td class="col-md-1 ">';
                                                            echo '<p id="points_end'.$user['id'].'">'.$user['points_end'].'</p>';   
                                                        echo '</td>';

                                                        echo '<td class="col-md-1 ">';
                                                            echo '<p id="multiplied'.$user['id'].'">'.$user['multiplied'].'</p>';   
                                                        echo '</td>';

                                                        echo '<td class="col-md-1 ">';
                                                            echo '<p id="credits'.$user['id'].'">'.$user['credits'].'</p>';   
                                                        echo '</td>';



                                                        echo '<td class="col-md-1 ">';
                                                            echo '<p><button data-id="'.$user['id'].'" id="edit'.$user['id'].'" name="singlebutton" class="btn btn-primary edit-ActCreditsform-btn" data-toggle="modal" data-target="#myActCreditsModal">Edit</button>

                                                            </p>';   
                                                        echo '</td>';
                                                    echo '</tr>';
                                              $i++;  } 
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
                  <div class="modal fade" id="myActCreditsModal" role="dialog">
                    <div class="modal-dialog">
                    
                      <!-- Modal content-->
                      <div class="modal-content" style="width: 126%;">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                          <h4 class="modal-title" id="addActCredits"></h4>
                        </div>

                      <div class="">

                              <form class="form-horizontal" id="ActCreditsAdd" name="actCreditsinfo">
                              <fieldset>

                            
                              <legend>

                              </legend>
                              <!-- Text input-->
                              <div class="form-group">
                                <label class="col-md-2 control-label" for="user_email">Points Start</label>  
                                <div class="col-md-5">
                                <input type="hidden" name="id" id="ActCreditsId">
                                <input id="points_start" name="points_start" placeholder="points" class="form-control input-md" type="text" value="">
                                <div id="login_credits_err" class="error"></div>
                                </div>
                              </div> 

                              <div class="form-group">
                                <label class="col-md-2 control-label" for="user_email">Points End</label>  
                                <div class="col-md-5">
                                <input id="points_end" name="points_end" placeholder="points" class="form-control input-md" type="text" value="">
                                <div id="login_credits_err" class="error"></div>
                                </div>
                              </div> 

                              <div class="form-group">
                                <label class="col-md-2 control-label" for="user_email">Multiplied</label>  
                                <div class="col-md-5">
                                <input id="multiplied" name="multiplied" placeholder="points" class="form-control input-md" type="text" value="">
                                <div id="login_credits_err" class="error"></div>
                                </div>
                              </div> 
                              <div class="form-group">
                                <label class="col-md-2 control-label" for="user_email">Credits</label>  
                                <div class="col-md-5">
                                <input id="credits" name="credits" placeholder="points" class="form-control input-md" type="text" value="">
                                <div id="login_credits_err" class="error"></div>
                                </div>
                              </div> 

                              </fieldset>
                              </form>

                              <div class="form-group" style="margin-left: 3%; margin-top:5px;">

                              </div>

                        </div>
                        <div class="modal-footer" style="text-align: left;">
                          <button class="btn btn-primary"  id="submit_actCredits_form" style="width: 75px;" >Save</button>
                      
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
 
        $(document).on("click","#submit_actCredits_form",function(e){
               // e.preventDefault();
                var actCreditsId= $('#ActCreditsId').val();
                var points_start= $('#points_start').val(); 
                var points_end  = $('#points_end').val();  
                var multiplied  = $('#multiplied').val();  
                var credits     = $('#credits').val();  
               if(points_start ==""){
                  alert("fill points start");
               }else if(points_end ==""){
                  alert("fill points end");
               }else if(multiplied ==""){
                  alert("fill multiplied");
               }else if(credits ==""){
                  alert("fill credits");
               }else{

                  if(actCreditsId==0){   
                      $('.error').html('');               
                      var ele   = $('#ActCreditsAdd');
                      var data  = ele.serialize();
                      var url   = "<?php echo SITEURL;?>activitycredits/insert_activity_credits";
                      $.ajax({
                         data : data,
                         url : url,
                         type: 'POST'
                      }).done(function(data){  
                        $('#myActCreditsModal').modal('hide');
                        location.reload();
                        $('#message_success_insert').css({'display':''});
                        $('#message_success_insert').delay(3000).fadeOut(400);                        
                                 
                      });

                   }else{ 
                      $('.error').html('');               
                      var ele   = $('#ActCreditsAdd');
                      var data  = ele.serialize();
                      var url   = "<?php echo SITEURL;?>activitycredits/update_activity_credits";
                      $.ajax({
                         data : data,
                         url : url,
                         type: 'POST'
                      }).done(function(data){  
                        $('#myActCreditsModal').modal('hide');
                        location.reload();
                        $('#message_success_update').css({'display':''});
                        $('#message_success_update').delay(3000).fadeOut(400);
                                 
                      });


                  }
              }
          });



      $(document).on("click",".edit-ActCreditsform-btn",function(e){
          $('form[id="ActCreditsAdd"]')[0].reset();
          var edittxt="Edit Level";
          $('#addActCredits').text(edittxt); 
          var id = $(this).data("id"); 
          $('#ActCreditsId').val(id);

          var url = SITEURL + 'activitycredits/acititycredits_detail/'+id; 
          $.ajax({
            url:url,                    
          }).done(function(getdata){
              if(getdata !=null){ 

                  $.each(getdata,function(i,row){ 

                    var credits_start = row['points_start'];
                    var credits_end   = row['points_end']; 
                    var multiplied    = row['multiplied']; 
                    var credits       = row['credits']; 

                    $('#points_start').val(credits_start);
                    $('#points_end').val(credits_end);
                    $('#multiplied').val(multiplied);
                    $('#credits').val(credits);

                });
              }
          });

      });

      $(document).on("click",".btn-add-actCredits",function(e){
          $('form[id="ActCreditsAdd"]')[0].reset();  

          $('#ActCreditsId').val(0); 
          var edittxt="Add Points";
          $('#addActCredits').text(edittxt);
               // e.preventDefault();

      });



</script>