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

            
            <button class="btn btn-default btn-add-Store" type="button" data-target="#myStoreModal" data-toggle="modal" style="margin-left: 61px; width: 191px;">Add Ticket
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
                                            <th class="col-md-1">Team1</th>
                                            <th class="col-md-1">Team2</th>
                                            <th class="col-md-2">Venue</th>
                                            <th class="col-md-1">Country</th>
                                            <th class="col-md-1">Credits</th>
                                            <th class="col-md-1">Pending</th>
                                            <th class="col-md-1">Approved</th>
                                            <th class="col-md-1">Rejected</th>
                                            <th class="col-md-1">Published</th>

                                            <th class="col-md-1">Action</th>
                                             
                                        </tr>
                                       </thead>
                                       <tbody>

                                        <?php 
                                        if(!empty($store)){ $i =1;
                                            foreach($store as $user){

                                                    echo '<tr id="row_'.$user['id'].'">';
                                                        echo '<td class="col-md-1">';
                                                            echo '<p>'.$i.'</p>'; 
                                                               
                                                        echo '</td>';
                                                      
                                                        echo '<td class="col-md-1">';
                                                            echo '<p id="team1name'.$user['id'].'">'.$user['team1'].'</p>';   
                                                        echo '</td>';


                                                        echo '<td class="col-md-1">';
                                                            echo '<p id="team2name'.$user['id'].'">'.$user['team2'].'</p>';   
                                                        echo '</td>';

                                                        echo '<td class="col-md-2">';
                                                            echo '<p id="venue'.$user['id'].'"><b>Venue: &nbsp;</b>'.$user['venue'].'<br><b>Date: &nbsp;</b>'.$user['date'].'<br><b>Time: &nbsp;</b>'.$user['time'].'</p>';   
                                                        echo '</td>';


                                                        echo '<td class="col-md-1 ">';
                                                            echo '<p id="country'.$user['id'].'">'.$user['country'].'</p>';   
                                                        echo '</td>';

                                                        echo '<td class="col-md-1 ">';
                                                            echo '<p id="points'.$user['id'].'">'.$user['points'].'</p>';   
                                                        echo '</td>';

                                                        echo '<td class="col-md-1 ">';
                                                            echo '<p id="pending'.$user['id'].'">'.$user['pending'].'</p>';   
                                                        echo '</td>';

                                                        echo '<td class="col-md-1 ">';
                                                            echo '<p id="approved'.$user['id'].'">'.$user['approved'].'</p>';   
                                                        echo '</td>';

                                                        echo '<td class="col-md-1 ">';
                                                            echo '<p id="rejected'.$user['id'].'">'.$user['rejected'].'</p>';   
                                                        echo '</td>';                                                        

                                                        echo '</td>'; 

                                                        echo '<td class="col-md-1 ">';
                                                            echo '<p id="channel_p'.$user['id'].'">'.$user['published_at'].'</p>';   
                                                        echo '</td>';                                                          

                                                        echo '<td class="col-md-1 ">';
                                                            echo '<p><button data-id="'.$user['id'].'" id="edit'.$user['id'].'" name="singlebutton" class="btn btn-primary edit-storeform-btn" data-toggle="modal" data-target="#myStoreModal">Edit</button>

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
                  <div class="modal fade" id="myStoreModal" role="dialog">
                    <div class="modal-dialog">
                    
                      <!-- Modal content-->
                      <div class="modal-content" style="width: 126%;">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                          <h4 class="modal-title" id="addStore"></h4>
                        </div>

                      <div class="">

                              <form class="form-horizontal" id="storeAdd" name="storeinfo">
                              <fieldset>

                            
                              <legend>

                              </legend>
                              <!-- Text input-->


                              <div class="form-group">
                                <input type="hidden" name="id" id="storeid">
                                <input type="hidden" name="country" id="country" value="United States of America">

                                <label class="col-md-2 control-label" for="user_email">League</label>  
                                <div class="col-md-5" style="">
                                  
                                  <select name="news_league_id" id="new_league_store" class="form-control news_league">
                                    <option value="0">select league</opton>
                                       <?php
                                          if(!empty($kroo_news['all_leagues'])){
                                            foreach($kroo_news['all_leagues'] as $news){
                                              echo '<option class="select_leagues" id="select_news_league" data-id="'.$news->id.'" value="'.$news->id.'">'.$news->name.'</option>';
                                              }

                                           }
                                      ?>

                                  </select> 
                                 
                                <div id="login_credits_err" class="error"></div>
                                </div>
                              </div> 
                              <!-- Text input-->
                              <div class="form-group">
                                <label class="col-md-2 control-label" for="user_email">Team1</label>  
                                <div class="col-md-5">
                                    <select id="add_store_team1" name="add_store_team1" class="form-control team1class">

                                  </select>  
                                    </select>                                
                                <div id="login_question_err" class="error"></div>
                                </div>
                              </div>
                              <div class="form-group">
                                <label class="col-md-2 control-label" for="user_email">Team2</label>  
                                <div class="col-md-5">                              
                                    <select id="add_store_team2" name="add_store_team2" class="form-control team2class"> 
                                    </select>                                
                                <div id="login_question_err" class="error"></div>
                                </div>
                              </div>

                              <div class="form-group">
                                <label class="col-md-2 control-label" for="user_email">Match Venue</label>  
                                <div class="col-md-7">
                                  <textarea id="venue" class="form-control" rows="3" maxlength="500" name="venue"></textarea> 
                                <div id="login_credits_err" class="error"></div>
                                </div>
                              </div>

                              <div class="form-group">
                                <label class="col-md-2 control-label" for="user_email">Credits Per Ticket</label>  
                                <div class="col-md-5">
                                <input id="points" name="points" placeholder="Credits" class="form-control input-md" type="text" value="">
                                <div id="login_credits_err" class="error"></div>
                                </div>
                              </div> 

                              <div class="form-group">                                   
                                     <label class="col-md-2 control-label" for="user_email">Match Date</label>
                                     <div class="col-md-5">
                                           <input type='text' name="date" placeholder="Date" class="form-control" id='datepicker' />
                                           <div id="login_datepicker_err" class="error"></div>
                                    </div>
                              </div>
                              <div class="form-group">                                   
                                     <label class="col-md-2 control-label" for="user_email">Match Time</label>
                                     <div class="col-md-5">
                                           <input type='text' name="time" placeholder="time" class="form-control" id='datetimepicker3' />
                                           <div id="login_datepicker_err" class="error"></div>
                                    </div>
                              </div>


                              </fieldset>
                              </form>

                              <div class="form-group" style="margin-left: 3%; margin-top:5px;">

                              </div>

                        </div>
                        <div class="modal-footer" style="text-align: left;">
                          <button class="btn btn-primary"  id="submit_store_form" style="width: 75px;" >Save</button>
                      
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
 
        $(document).on("click","#submit_store_form",function(e){ new_league_store
          var new_league_store = $('#new_league_store').val();
          var add_store_team1 = $('#add_store_team1').val();
          var add_store_team2 = $('#add_store_team2').val();
          var venue = $('#venue').val();
          var country = $('#country').val();
          var points = $('#points').val();
          var datepicker = $('#datepicker').val();
          var datetimepicker = $('#datetimepicker').val();
          var creditsNum= $.isNumeric($('#points').val());

          if(new_league_store==0 || new_league_store=="" ){
              alert("Select league");
          }else if(add_store_team1==0 || add_store_team1=="" ){ 
              alert("Select team1"); 
          }else if(add_store_team2==0 || add_store_team2=="" ){ 
              alert("Select team2");              
          }else if(venue==0 || venue=="" ){ 
              alert("Fill venue"); 
          }else if(country==0 || country=="" ){ 
              alert("Select country"); 
          }else if(points==0 || points=="" ){ 
              alert("Fill points");
          }else if(creditsNum==false){ 
              alert("Points should be number");                
          }else if(datepicker==0 || datepicker=="" ){ 
              alert("Select date");
          }else if(datetimepicker3==0 || datetimepicker3=="" ){ 
              alert("Select time");
          }else if(add_store_team1 == add_store_team2){ 
              alert("team1 and team2 should not same");                   

          }else{
               // e.preventDefault();
                var storeid= $('#storeid').val(); 
                if(storeid==0){
                    $('.error').html('');               
                    var ele   = $('#storeAdd');
                    var data  = ele.serialize();
                    var url   = "<?php echo SITEURL;?>game/insert_store";
                    $.ajax({
                       data : data,
                       url : url,
                       type: 'POST'
                    }).done(function(data){  
                      $('#myStoreModal').modal('hide');
                      location.reload();
                      $('#message_success_insert').css({'display':''});
                      $('#message_success_insert').delay(3000).fadeOut(400);                      
                               
                    });

                 }else{
                    $('.error').html('');               
                    var ele   = $('#storeAdd');
                    var data  = ele.serialize();
                    var url   = "<?php echo SITEURL;?>game/update_store";
                    $.ajax({
                       data : data,
                       url : url,
                       type: 'POST'
                    }).done(function(data){  
                      $('#myStoreModal').modal('hide');
                      location.reload();
                      $('#message_success_update').css({'display':''});
                      $('#message_success_update').delay(3000).fadeOut(400);                      
                               
                    });


                }
            }     
          });



      $(document).on("click",".edit-storeform-btn",function(e){
          $('form[id="storeAdd"]')[0].reset();
          var edittxt="Edit Ticket";
          $('#addStore').text(edittxt);
          var id = $(this).data("id"); 
          $('#storeid').val(id);

          var team_url = SITEURL + 'game/store_detail/'+id; 
          $.ajax({
            url:team_url,                    
          }).done(function(getdata){
              if(getdata !=null){ 

                  $.each(getdata,function(i,row){ 

                    var team1_id = row['team1'];
                    var team2_id = row['team2'];  
                    var venue = row['venue'];
                    var points = row['points'];
                    var storeDate = row['date'];
                    var storeTime = row['time'];
                    var league = row['league'];


                    var team_url = SITEURL + 'dashboard/get_news_team_detail/'+team1_id; 
                    $.ajax({
                      url:team_url,                    
                    }).done(function(getdata){
                      if(getdata !=null){
                         $.each(getdata.team,function(i,row){
                            if(row['league_team_id'] == team1_id){ 
                                  var all_league_team = '<option value="'+row['league_team_id']+'" selected>'+row['league_team_name']+'</option>';  
                                    }else{
                                        var all_league_team = '<option  value="'+row['league_team_id']+'">'+row['league_team_name']+'</option>';   
                                    }
                                     $('#add_store_team1').append(all_league_team);
                              });
                       }
                          });       


                    var team_url = SITEURL + 'dashboard/get_news_team_detail/'+team2_id; 
                    $.ajax({
                      url:team_url,                    
                    }).done(function(getdata){
                      if(getdata !=null){
                         $.each(getdata.team,function(i,row){
                            if(row['league_team_id'] == team2_id){ 
                                  var all_league_team = '<option value="'+row['league_team_id']+'" selected>'+row['league_team_name']+'</option>';  
                                    }else{
                                        var all_league_team = '<option  value="'+row['league_team_id']+'">'+row['league_team_name']+'</option>';   
                                    }
                                     $('#add_store_team2').append(all_league_team);
                              });
                       }
                          }); 


                    $('select[name="news_league_id"] option[value="'+league+'"]').attr('selected','selected');

                    $('#venue').val(venue);
                    $('#points').val(points);
                    $('#datepicker').val(storeDate);
                    $('#datetimepicker3').val(storeTime);

                });
              }
         });

     });



      $(document).on("click",".btn-add-Store",function(e){
          $('form[id="storeAdd"]')[0].reset();  
          $('.team1class option:selected').removeAttr('selected'); 
          $('.team2class option:selected').removeAttr('selected');
          $('.countryclass option:selected').removeAttr('selected');         
          $('#storeid').val(0); 
          var edittxt="Add Ticket";
          $('#addStore').text(edittxt);

          var date = new Date();  
          var hours = date.getHours();
          var minutes = date.getMinutes();
          var ampm = hours >= 12 ? 'pm' : 'am';
          hours = hours % 12;
          hours = hours ? hours : 12; // the hour '0' should be '12'
          minutes = minutes < 10 ? '0'+minutes : minutes;
          var currentTime = hours + ':' + minutes + ' ' + ampm;

          var d = new Date();
          var month = d.getMonth()+1;
          var day = d.getDate();
          var currentDate = 
          (month<10 ? '0' : '') + month + '/' +
          (day<10 ? '0' : '') + day+'/'+d.getFullYear() ;

          $('#datepicker').val(currentDate);
          $('#datetimepicker3').val(currentTime);

          
      });

$(function () {
      $('#datetimepicker').datetimepicker();
  });

$(document).on('change', '.news_league', function(){
    var league_id = $(this).find('option:selected').data("id");
    var url = SITEURL + "dashboard/select_news_league/"+league_id;
    $.ajax({
        url:url
    }).done(function(getdata){
        $('#add_store_team1').html('');
        $('#add_store_team1').append('<option value="0">Select Team</option>');
        $('#add_store_team2').html('');
        $('#add_store_team2').append('<option value="0">Select Team</option>');

        $.each(getdata.team,function(i,row){                           
            var all_league_team1 = '<option   value="'+row['league_team_id']+'">'+row['league_team_name']+'</option>';
            var all_league_team2 = '<option   value="'+row['league_team_id']+'">'+row['league_team_name']+'</option>';                               
            $('#add_store_team1').append(all_league_team1);
            $('#add_store_team2').append(all_league_team2);
        });
    });
});


</script>