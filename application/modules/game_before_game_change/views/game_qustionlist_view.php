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

            
            <button class="btn btn-default btn-add-game" type="button" data-target="#myAddModal" data-toggle="modal" style="margin-left: 61px; width: 191px;">Create Game </button>
 
            <div id="message_success_insert" style="display:none;background-color: #27C24C;border-radius: 14px;color: #FFFFFF;left: 42%;padding-top: 6px; padding-left:20px; padding-right:20px; position: absolute;top: 63px;"><p id="message_text"><b>Saved Successfully !</b></p></div>
            <div id="message_success_update" style="display:none;background-color: #27C24C;border-radius: 14px;color: #FFFFFF;left: 42%;padding-top: 6px; padding-left:20px; padding-right:20px; position: absolute;top: 63px;"><p id="message_text"><b>Updated Successfully !</b></p></div>
            <div id="message_success_publish" style="display:none;background-color: #27C24C;border-radius: 14px;color: #FFFFFF;left: 42%;padding-top: 6px; padding-left:20px; padding-right:20px; position: absolute;top: 63px;"><p id="message_text"><b>published Successfully !</b></p></div>                  
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
                                            <th class="col-md-1">s .no</th>
                                            <th class="col-md-3">Question</th>
                                            <th class="col-md-1">Credits</th>
                                            <th class="col-md-1">League</th>
                                            <th class="col-md-1">Team</th>
                                            <th class="col-md-1">Time to publish</th>
                                            <th class="col-md-1">Won</th>
                                            <th class="col-md-1">Lost</th>
                                            <th class="col-md-1">Timeout</th>
                                            <th class="col-md-1">Action</th>
                                             
                                        </tr>
                                       </thead>
                                       <tbody>

                                        <?php 
                                        if(!empty($game)){  $i=0;
                                            foreach($game as $user){ 


                                                    echo '<tr id="">';

                                                      echo '<td class="col-md-1"><p>'.$i.'</p>';
                                                      echo '</td>';


                                                        echo '<td class="col-md-1">';

                                                            echo '<p id="qus'.$user['id'].'">'.$user['questions'].'</p>';   
                                                        echo '</td>';


                                                        echo '<td class="col-md-1 ">';
                                                            echo '<p id="cre'.$user['id'].'">'.$user['credits'].'</p>';   
                                                        echo '</td>';

                                                        echo '<td class="col-md-1 ">';
                                                            echo '<p id="league'.$user['id'].'">'.$user['lname'].'</p>';   
                                                        echo '</td>';


                                                        echo '<td class="col-md-1 ">';
                                                            echo '<p id="team'.$user['id'].'">'.$user['tname'].'</p>';   
                                                        echo '</td>';

                                                        echo '<td class="col-md-1 ">';
                                                        $ptime=strtotime($user['time_to_publish']) + ($this->session->userdata('timezoneoffset')*60*-1);
                                                            echo '<p id="time_to_publish'.$user['id'].'">'.date('Y-m-d H:i:s',$ptime).'</p>';   
                                                        echo '</td>';


                                                        echo '<td class="col-md-1 ">';
                                                            echo '<p id="won'.$user['id'].'">'.$user['won'].'</p>';   
                                                        echo '</td>';

                                                        echo '<td class="col-md-1 ">';
                                                            echo '<p id="lost'.$user['id'].'">'.$user['lost'].'</p>';   
                                                        echo '</td>';

                                                        echo '<td class="col-md-1 ">';
                                                            echo '<p id="timeout'.$user['id'].'">'.$user['timeout'].'</p>';   
                                                        echo '</td>';

                                                        
                                                        echo '<td class="col-md-1 ">';
                                                          echo '<p>';
                                                            if($user['status']==0) {
                                                             echo '<button data-id="'.$user['id'].'" id="edit'.$user['id'].'" name="singlebutton" class="btn btn-primary edit-form-btn" data-toggle="modal" data-target="#myAddModal">Edit</button>
                                                                <button id="delete'.$user['id'].'" name="singlebutton" data-id="'.$user['id'].'" class="btn btn-primary delete-form-btn">Delete</button>';
                                                           }else{
                                                               echo '<button id="view'.$user['id'].'" name="singlebutton" data-id="'.$user['id'].'" class="btn btn-primary view-form-btn" data-toggle="modal" data-target="#myviewModal">view</button>';
                                                           }

                                                      echo '</p>';
                                                    echo '</td>';

                                                   
                                                    echo '</tr>';
                                               $i++; } 
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
                <div id="imgModal" class="reveal-modal modal fade" align="center">
                  <h2>Select Image To Crop</h2>
                  <div>
                    <img src="" id="thumbnail" alt="Edit Image" />
                    <div id="thumb_preview_holder">
                      <img src=""  alt="Thumbnail Preview" id="thumb_preview" />
                    </div>
                    <div class="clear"></div>
                    <input type="hidden" name="filename" value="" id="filename" />
                    <input type="hidden" name="x1" value="" id="x1" />
                    <input type="hidden" name="y1" value="" id="y1" />
                    <input type="hidden" name="x2" value="" id="x2" />
                    <input type="hidden" name="y2" value="" id="y2" />
                    <input type="hidden" name="w" value="" id="w" />
                    <input type="hidden" name="h" value="" id="h" />
                    <input type="submit" name="upload_thumbnail" value="Crop & Save" id="save_thumb" class="button" />
                    <input type="button" name="cancel" value="X" class="close-reveal-modal" id="cancel_button"/>
                  </div>
                </div> <!-- end modal box-->
                  <div class="modal fade" id="myAddModal" role="dialog">
                    <div class="modal-dialog">
                    
                      <!-- Modal content-->
                      <div class="modal-content" style="width: 128%;">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                          <h4 class="modal-title" id="add"></h4>
                        </div>

                        <div class="">

                              <form class="form-horizontal" id="gameAdd" name="gameinfo">
                              <fieldset>                            
                              <legend>   </legend>

                              <div class="form-group">
                                <label class="col-md-2 control-label">Game Type</label>  
                                <div class="col-md-9" style="padding-left: 0px;">
                                  <div class="col-md-4">
                                  <select name="select_game_category" id="select_game_category" class="form-control">
                                    <option class="select_leagues" data-id="1" value="1" selected="selected">Generic</option>
                                    <option class="select_leagues" data-id="2" value="2">News Feed Based</option>
                                  </select> 
                                  </div>
                                  <div id="difficulty_block" style="display:block;">
                                    <label class="col-md-2 control-label">Difficulty</label>
                                    <div class="col-md-4">
                                      <select id="select_difficulty" name="select_difficulty" class="form-control"> 
                                        <option class="select_leagues" data-id="1" value="1">Easy</option>
                                        <option class="select_leagues" data-id="2" value="2">Medium</option>
                                        <option class="select_leagues" data-id="3" value="3">Hard</option>  
                                      </select>                                
                                    </div>
                                  </div>
                                </div>
                              </div>

                              <!-- Text input-->
                              <div class="form-group">
                                <label class="col-md-2 control-label" for="user_email">Question</label>  
                                <div class="col-md-7">
                                <input type="hidden" name="id" id="gameid">
                                <input type="hidden" name="publish_id" id="publish_id">
                                <input type="hidden" name="NowPublishDate" id="NowPublishDate">
                                <input type="hidden" name="NowPublishTime" id="NowPublishTime">
                                
                                <textarea id="question" name="question" class="form-control" placeholder="question" rows="3" maxlength="500" value="" onKeyDown="limitText(this,100);" onKeyUp="limitText(this,300);"></textarea>
                                <p style="font-size: 11px;">Max 100 characters allowed</p>
                                <div id="login_question_err" class="error"></div>
                                </div>
                              </div>

                              <div class="col-md-8" style="margin-left: 30px;" id="radio_list">

                                  <label class="" style="width: 55px;">Options</label>

                                  <label id="option_1" class="radio-inline">
                                      <span>1</span>
                                      <input id="ansTxtOpt1" name="ans_opt1" placeholder="option1" class="" type="text" value="" style="height: 35px; margin-left: 12px;width: 381px; border: 1px solid #ccc; border-radius: 4px;" onKeyDown="limitText(this,40);" onKeyUp="limitText(this,100);">
                                  </label>
                                  <br>
                                  <label id="option_2" class="radio-inline">
                                    <span>2</span>
                                      <input id="ansTxtOpt2" type="text" name="ans_opt2" placeholder="option2" style="height
                                    : 35px; margin-left: 12px;width: 381px; border: 1px solid #ccc; border-radius: 4px; margin-bottom: 12px;" onKeyDown="limitText(this,40);" onKeyUp="limitText(this,40);">
                                  </label>
                                  <br>
                                  <label id="option_3" class="radio-inline">
                                    <span>3</span>
                                    <input id="ansTxtOpt3" type="text" name="ans_opt3" placeholder="option3" style="height
                                    : 35px; margin-left: 12px;width: 381px; border: 1px solid #ccc; border-radius: 4px; margin-bottom: 12px;" onKeyDown="limitText(this,40);" onKeyUp="limitText(this,40);">
                                  </label>
                                  <br>                
                                  <label id="option_4" class="radio-inline" style="margin-bottom: 6px;">
                                    <span>4</span>
                                    <input id="ansTxtOpt4" type="text" name="ans_opt4" placeholder="option4" style="height
                                    : 35px; margin-left: 12px;width: 381px; border: 1px solid #ccc; border-radius: 4px; margin-bottom: 3px;" onKeyDown="limitText(this,40);" onKeyUp="limitText(this,40);">
                                   <div style="font-size: 9px; margin-left: 21px;">Max 40 characters allowed</div>
                                  </label>
                                  
                                  <br>
                              </div> 
                              
                              <div> 
                                <label class="" style="width: 139px; margin-top: 6px;">Choose answer</label> 
                                <br>
                                  <label id="option_1" class="radio-inline" style="">
                                    <input id="option1" type="radio" class="chexbox" name="optradio" value="1" style="margin-left: 11px;">
                                  </label>
                                  <br>
                                  <label id="option_2" class="radio-inline" style="margin-top: 22px;">
                                    <input id="option2" type="radio" class="chexbox" name="optradio" value="2" style="margin-left: 11px;">
                                  </label>
                                  <br> 
                                  <label id="option_3" class="radio-inline " style="margin-top: 28px;">
                                    <input id="option3" type="radio" class="chexbox" name="optradio" value="3" style="margin-left: 11px;">
                                  </label> 
                                  <br>                              
                                  <label id="option_4" class="radio-inline" style="margin-top: 26px;">
                                    <input id="option4" type="radio" class="chexbox" name="optradio" value="4" style="margin-left: 11px;">
                                  </label> 
                                
                              </div>
                              <hr>



                              <div class="form-group">
                                <label class="col-md-2 control-label" for="user_email">Image</label>  
                                <div class="col-md-4">
                                  <!-- <input type ="file" name="userfiles" id="imgs" >  
                                <div id="login_credits_err" class="error"></div> -->
                                <div class="product_image">
                                <img class="thumbnl" src="assets/Artboard1.png">
                                <input type="hidden" name="news_img" value="">
                              </div>
                              <div id="file-uploader">
                                  <button id="upload">Change Image</button>
                                  <noscript> <p>Please enable JavaScript to use file uploader.</p> </noscript> 
                                 </div>
                                </div>
                              </div> 

                              <div class="form-group">
                                <label class="col-md-2 control-label" for="user_email">Credits</label>  
                                <div class="col-md-4">
                                <select name="credits" id="credits" class="form-control"></select> 
                                </div>
                              </div> 


                              <div class="form-group">
                                <label class="col-md-2 control-label" for="user_email">League</label>  
                                <div class="col-md-9" style="padding-left: 0px;">
                                  <div class="col-md-4">
                                  <select name="news_league_id" id="" class="form-control news_leagues ">
                                    <option value="0">select league</opton>
                                       <?php
                                          if(!empty($kroo_news['all_leagues'])){
                                            foreach($kroo_news['all_leagues'] as $news){
                                              echo '<option class="select_leagues" id="select_news_league" data-id="'.$news->id.'" value="'.$news->id.'">'.$news->name.'</option>';
                                              }

                                           }
                                      ?>

                                  </select> 
                                  </div>
                                  <label class="col-md-2 control-label" for="user_email">Team</label>
                                  <div class="col-md-4">
                                    <select id="add_news_team" name="news_team_id" class="form-control new_team">   
                                    </select>                                

                                  </div>
                                <div id="login_credits_err" class="error"></div>
                                </div>
                              </div> 

                              <div class="form-group">
                                <label class="col-md-2 control-label" for="user_email">Sponsor</label>  
                                <div class="col-md-9" style="padding-left: 0px;">
                                  <div class="col-md-4">
                                  <select name="sponser" id="sponser_id" class="form-control sponser_class">
                                    <option value="0">select sponsor</opton>
                                       <?php
                                          if(!empty($sponser)){
                                            foreach($sponser as $spon){ 
                                              echo '<option class="" id="" data-id="'.$spon[id].'" value="'.$spon[id].'">'.$spon[label].'</option>';
                                              }

                                           }
                                      ?>

                                  </select> 
                                  </div>
                                <div id="login_credits_err" class="error"></div>
                                </div>
                              </div> 


                              <div class="form-group">
                                <label class="col-md-2 control-label" for="user_email">Link</label>  
                                <div class="col-md-6">
                                  <input id="linkid" name="link" placeholder="Link" class="form-control input-md" type="text" value="">
                                <div id="login_credits_err" class="error"></div>
                                </div>
                              </div>


                              <div class="form-group">
                                <label class="col-md-2 control-label" for="user_email">Explaination</label>  
                                <div class="col-md-7">
                                  <textarea id="explanation_answer" class="form-control" rows="3" maxlength="500" name="exp_answer" onKeyDown="limitText(this,100);" onKeyUp="limitText(this,300);"></textarea> 
                                <p style="font-size: 11px;">Max 100 characters allowed</p>  
                                <div id="login_credits_err" class="error"></div>
                                </div>
                              </div>

                               <div class="form-group">
                                <label class="col-md-2 control-label" for="user_email">Time to live(TTL)</label>  
                                <div class="col-md-10" style="padding-left: 0px;">
                                  <div class="col-md-5" style="padding-left: 0px;">
                                    <div class="col-md-6">
                                      <select id="TTL-hour" name="TTL-hour" class="form-control TTL-hour">
                                      <option  value="0">hour</option>
                                        <?php
                                        $i=1;
                                        for($i=1; $i<=24; $i++){
                                          echo'<option value="'.str_pad($i, 2, "0", STR_PAD_LEFT) .'">'.$i.' hour</option>'; 
                                        }
                                        ?>
                                      </select>
                                    </div>
                                    <div class="col-md-6">
                                      <select id="TTL-min" name="TTL-min" class="form-control TTL-min">
                                        <option value="0">min</option>   
                                        <?php
                                        $i=1;
                                        for($i=1; $i<=60; $i++){
                                          echo'<option value="'.str_pad($i, 2, "0", STR_PAD_LEFT) .'">'.$i.' min</option>'; 
                                        }
                                        ?>
                                      </select>
                                    </div>
                                  </div>

                                  <div class="col-md-6" style="margin-left: 27px; width: 54%;">
                                    <label class="col-md-8 control-label" for="user_email" style="margin-left: -55px;">Time to Answer (TTA)</label>
                                    <div class="col-md-6" style="width: 38%;">
                                    <input type="hidden" id="TTA-min" name="TTA-min" value="00">
                                      <select id="TTA-sec" name="TTA-sec" class="form-control TTA-sec"> 
                                        <option value="0">sec</option>
                                        <?php
                                        $i=10;
                                        for($i=10; $i<=60; $i++){

                                          echo'<option value="'.str_pad($i, 2, "0", STR_PAD_LEFT) .'">'.$i.' sec</option>'; 
                                        }
                                        ?>

                                      </select>
                                    </div>
                                  </div>                                  
                                <div id="login_duration_err" class="error"></div>
                                </div>
                              </div>  

                              <div class="form-group">
                                     
                                     <label class="col-md-2 control-label" for="user_email">Time to publish(TTP)</label>
                                     <div class="col-md-9">
                                         <div class="col-md-5" style="padding-left: 0px;">                     
                                           <input type='text' name="time_to_publish_date" placeholder="Date" class="form-control" id='datepicker' />
                                           <div id="login_datepicker_err" class="error"></div>
                                         </div>
                                         <div class="col-md-4">
                                            <input type="text" name="time_to_publish_time" placeholder="Time" class="form-control" id="datetimepicker3">

                                         </div>
                                    </div>
                                       

                              </div>

                              </fieldset>
                              <input type="hidden" name="timezoneoffset" value="0">
                              </form>

                              <div class="form-group" style="margin-left: 3%; margin-top:5px;">

                              </div>

                        </div>
                        <div class="modal-footer" style="text-align: left;">
                          <button class="btn btn-primary"  id="submit_form" style="width: 75px;" value="0">Save</button>
                          <button class="btn btn-primary"  id="submit_publish_form" style="width: 100px;" value="2" >Publish Later</button>
                          <button class="btn btn-primary"  id="submit_now_form" style="width: 94px;" value="3" >Publish Now</button>
                          
                          <button type="button" class=" btn btn-default" style="width: 75px; margin-left: 2px;" data-dismiss="modal">Close</button>
                        </div>
                      </div>
                      
                    </div>
                  </div> 
                  
                <!-- Add game modal End----------------> 


                <!-- view game Modal start -->

                  <div class="modal fade" id="myviewModal" role="dialog">
                    <div class="modal-dialog">
                    
                      <!-- Modal content-->
                      <div class="modal-content" style="width: 128%;">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                          <h4 class="modal-title" id="">Game View</h4>
                        </div>

                        <div class="">

                              <form class="form-horizontal" id="" name="">
                              <fieldset>
                            
                              <legend></legend>

                              <div class="form-group">
                                <label class="col-md-2 control-label">Game Type</label>  
                                <div class="col-md-9" style="padding-left: 0px;">
                                  <div class="col-md-4">
                                  <select name="select_game_category" id="select_game_category" class="form-control">
                                    <option class="select_leagues" data-id="1" value="1" selected="selected">Generic</option>
                                    <option class="select_leagues" data-id="2" value="2">News Feed Based</option>
                                  </select> 
                                  </div>
                                  <div id="difficulty_block" style="display:block;">
                                    <label class="col-md-2 control-label">Difficulty</label>
                                    <div class="col-md-4">
                                      <select id="select_difficulty" name="select_difficulty" class="form-control"> 
                                        <option class="select_leagues" data-id="1" value="1">Easy</option>
                                        <option class="select_leagues" data-id="2" value="2">Medium</option>
                                        <option class="select_leagues" data-id="3" value="3">Hard</option>  
                                      </select>                                
                                    </div>
                                  </div>
                                </div>
                              </div>

                              <!-- Text input-->
                              <div class="form-group">
                                <label class="col-md-2 control-label" for="user_email">Question</label>  
                                <div class="col-md-7">
                                <textarea id="questionView" name="question" class="form-control" placeholder="question" rows="3" maxlength="500" value="" onKeyDown="limitText(this,100);" onKeyUp="limitText(this,300);" disabled></textarea>
                                <div id="login_question_err" class="error"></div>
                                </div>
                              </div>

                              <div class="col-md-8" style="margin-left: 30px;" id="radio_list">

                                  <label class="" style="width: 55px;">Options</label>

                                  <label id="option_1" class="radio-inline">
                                      <span>1</span>
                                      <input id="ansTxtOpt1View" name="ans_opt1" placeholder="option1" class="" type="text" value="" style="height: 35px; margin-left: 12px;width: 381px; border: 1px solid #ccc; border-radius: 4px;" onKeyDown="limitText(this,40);" onKeyUp="limitText(this,100);" disabled>
                                  </label>
                                  <br>
                                  <label id="option_2" class="radio-inline">
                                    <span>2</span>
                                      <input id="ansTxtOpt2View" type="text" name="ans_opt2" placeholder="option2" style="height
                                    : 35px; margin-left: 12px;width: 381px; border: 1px solid #ccc; border-radius: 4px; margin-bottom: 12px;" onKeyDown="limitText(this,40);" onKeyUp="limitText(this,40);" disabled>
                                  </label>
                                  <br>
                                  <label id="option_3" class="radio-inline">
                                    <span>3</span>
                                    <input id="ansTxtOpt3View" type="text" name="ans_opt3" placeholder="option3" style="height
                                    : 35px; margin-left: 12px;width: 381px; border: 1px solid #ccc; border-radius: 4px; margin-bottom: 12px;" onKeyDown="limitText(this,40);" onKeyUp="limitText(this,40);" disabled>
                                  </label>
                                  <br>                
                                  <label id="option_4" class="radio-inline" style="margin-bottom: 6px;">
                                    <span>4</span>
                                    <input id="ansTxtOpt4View" type="text" name="ans_opt4" placeholder="option4" style="height
                                    : 35px; margin-left: 12px;width: 381px; border: 1px solid #ccc; border-radius: 4px; margin-bottom: 3px;" onKeyDown="limitText(this,40);" onKeyUp="limitText(this,40);" disabled>
                                  </label>
                                  
                                  <br>
                              </div> 
                              
                              <div> 
                                <label class="" style="width: 139px; margin-top: 6px;">Choose answer</label> 
                                <br>
                                  <label id="option_1" class="radio-inline" style="">
                                    <input id="option1View" type="radio" class="chexbox" name="optradio" value="1" style="margin-left: 11px;" disabled>
                                  </label>
                                  <br>
                                  <label id="option_2" class="radio-inline" style="margin-top: 22px;">
                                    <input id="option2View" type="radio" class="chexbox" name="optradio" value="2" style="margin-left: 11px;" disabled>
                                  </label>
                                  <br> 
                                  <label id="option_3" class="radio-inline " style="margin-top: 28px;">
                                    <input id="option3View" type="radio" class="chexbox" name="optradio" value="3" style="margin-left: 11px;" disabled>
                                  </label> 
                                  <br>                              
                                  <label id="option_4" class="radio-inline" style="margin-top: 26px;">
                                    <input id="option4View" type="radio" class="chexbox" name="optradio" value="4" style="margin-left: 11px;" >
                                  </label> 
                                
                              </div>
                              <hr>



                              <div class="form-group">
                                <label class="col-md-2 control-label" for="user_email">Image</label>  
                                <div class="col-md-4">
                                  <!-- <input type ="file" name="userfiles" id="imgs" >  
                                <div id="login_credits_err" class="error"></div> -->
                                <div class="product_image">
                                <img class="thumbn2" src="assets/Artboard1.png">
                              </div>
                              <div id="file-uploader">
                                 </div>
                                </div>
                              </div> 

                              <div class="form-group">
                                <label class="col-md-2 control-label" for="user_email">Credits</label>  
                                <div class="col-md-4">
                                <input id="creditsView" name="credits" placeholder="Credits" class="form-control input-md" type="text" value="" disabled>
                                <div id="login_credits_err" class="error"></div>
                                </div>
                              </div> 


                              <div class="form-group">
                                <label class="col-md-2 control-label" for="user_email">League</label>  
                                <div class="col-md-9" style="padding-left: 0px;">
                                  <div class="col-md-4">
                                  <select name="news_league_id" id="" class="form-control news_leagues " disabled>
                                    <option value="0">select league</opton>
                                       <?php
                                          if(!empty($kroo_news['all_leagues'])){
                                            foreach($kroo_news['all_leagues'] as $news){
                                              echo '<option class="select_leagues" id="select_news_league" data-id="'.$news->id.'" value="'.$news->id.'">'.$news->name.'</option>';
                                              }

                                           }
                                      ?>

                                  </select> 
                                  </div>
                                  <label class="col-md-2 control-label" for="user_email">Team</label>
                                  <div class="col-md-5">
                                    <select id="add_news_teamView" name="news_team_id" class="form-control new_team" disabled>   
                                    </select>                                

                                  </div>
                                <div id="login_credits_err" class="error"></div>
                                </div>
                              </div> 

                              <div class="form-group">
                                <label class="col-md-2 control-label" for="user_email">Sponsor</label>  
                                <div class="col-md-9" style="padding-left: 0px;">
                                  <div class="col-md-4">
                                  <select name="sponser" id="sponser_id" class="form-control sponser_class" disabled>
                                    <option value="0">select sponsor</opton>
                                       <?php
                                          if(!empty($sponser)){
                                            foreach($sponser as $spon){ 
                                              echo '<option class="" id="" data-id="'.$spon[id].'" value="'.$spon[id].'">'.$spon[label].'</option>';
                                              }

                                           }
                                      ?>

                                  </select> 
                                  </div>
                                <div id="login_credits_err" class="error"></div>
                                </div>
                              </div> 


                              <div class="form-group">
                                <label class="col-md-2 control-label" for="user_email">Link</label>  
                                <div class="col-md-6">
                                  <input id="linkidView" name="link" placeholder="Link" class="form-control input-md" type="text" value="" disabled>
                                <div id="login_credits_err" class="error"></div>
                                </div>
                              </div>


                              <div class="form-group">
                                <label class="col-md-2 control-label" for="user_email">Explaination</label>  
                                <div class="col-md-7">
                                  <textarea id="explanation_answerView" class="form-control" rows="3" maxlength="500" name="exp_answer" disabled></textarea> 
                                <div id="login_credits_err" class="error"></div>
                                </div>
                              </div>

                               <div class="form-group">
                                <label class="col-md-2 control-label" for="user_email">Time to live(TTL)</label>  
                                <div class="col-md-10" style="padding-left: 0px;">
                                  <div class="col-md-5" style="padding-left: 0px;">
                                    <div class="col-md-6">
                                      <select id="TTL-hour" name="TTL-hour" class="form-control TTL-hour" disabled>
                                      <option  value="0">hour</option>
                                        <?php
                                        $i=1;
                                        for($i=1; $i<=24; $i++){
                                          echo'<option value="'.str_pad($i, 2, "0", STR_PAD_LEFT) .'">'.$i.' hour</option>'; 
                                        }
                                        ?>
                                      </select>
                                    </div>
                                    <div class="col-md-6">
                                      <select id="TTL-min" name="TTL-min" class="form-control TTL-min" disabled>
                                        <option value="0">min</option>   
                                        <?php
                                        $i=1;
                                        for($i=1; $i<=60; $i++){
                                          echo'<option value="'.str_pad($i, 2, "0", STR_PAD_LEFT) .'">'.$i.' min</option>'; 
                                        }
                                        ?>
                                      </select>
                                    </div>
                                  </div>

                                  <div class="col-md-6" style="margin-left: 27px; width: 54%;">
                                    <label class="col-md-4 control-label" for="user_email" style="margin-left: -55px;">Time to Answer (TTA)</label>
                                    <div class="col-md-6" style="width: 38%;">
                                      <select id="TTA-sec" name="TTA-sec" class="form-control TTA-sec" disabled> 
                                        <option value="0">sec</option>
                                        <?php
                                        $i=1;
                                        for($i=1; $i<=60; $i++){

                                          echo'<option value="'.str_pad($i, 2, "0", STR_PAD_LEFT) .'">'.$i.' sec</option>'; 
                                        }
                                        ?>

                                      </select>
                                    </div>
                                  </div>                                  
                                <div id="login_duration_err" class="error"></div>
                                </div>
                              </div>  

                              <div class="form-group">
                                     
                                     <label class="col-md-2 control-label" for="user_email">Time to publish(TTP)</label>
                                     <div class="col-md-9">
                                         <div class="col-md-5" style="padding-left: 0px;">                     
                                           <input type='text' name="time_to_publish_date" placeholder="Date" class="form-control" id='datepicker'  disabled>
                                           <div id="login_datepicker_err" class="error"></div>
                                         </div>
                                         <div class="col-md-4">
                                            <input type="text" name="time_to_publish_time" placeholder="Time" class="form-control" id="datetimepicker3" disabled>

                                         </div>
                                    </div>
                                       

                              </div>

                              </fieldset>
                              </form>

                              <div class="form-group" style="margin-left: 3%; margin-top:5px;">

                              </div>

                        </div>
                        <div class="modal-footer" style="text-align: left;">
                          <button type="button" class=" btn btn-default" style="width: 75px; margin-left: 2px;" data-dismiss="modal">Close</button>
                        </div>
                      </div>
                      
                    </div>
                  </div> 
                  
                <!-- view game modal End----------------> 


                <div class="footer-main" style="bottom: 0; position: fixed; width: 100%;">
                    Copyright &copy Kroo, 2015
                </div>
            </aside><!-- /.right-side -->

        </div><!-- ./wrapper -->

 <script type="text/javascript">
    $(function(){
      var d = new Date()
      var n = d.getTimezoneOffset();
      $('input[name="timezoneoffset"]').val(n);
      
        // image upload on edit news
      var thumb = $(".thumbnl");
        $('#save_thumb').click(function() {
            var tab_index = $('.nav-tabs > li.active').index();
            var myImgPath = '<?php echo newsimage; ?>';
            var x1 = $('#x1').val();
            var y1 = $('#y1').val();
            var x2 = $('#x2').val();
            var y2 = $('#y2').val();
            var w = $('#w').val();
            var h = $('#h').val();
            if(x1=="" || y1=="" || x2=="" || y2=="" || w=="" || h==""){
                alert("You must make a selection first");
                return false;
            }
            else{
                $.ajax({
                    type : 'POST',
                    url: SITEURL+"crop.php",
                    data: "filename="+$('#filename').val()+"&x1="+x1+"&x2="+x2+"&y1="+y1+"&y2="+y2+"&w="+w+"&h="+h+"&tab_index="+tab_index,
                    success: function(data){
                        if(data!=''){
                            imgSRC =myImgPath+data;
                            thumb.attr('src', imgSRC);
                            $('.close-reveal-modal').click();
                            $('#thumbnail').imgAreaSelect({ hide: true, x1: 0, y1: 0, x2: 0, y2: 0 });
                            // let's clear the modal
                            $('#thumbnail').attr('src', '');
                            $('#thumb_preview').attr('src', '');
                            $('#filename').attr('value', '');
                            $('input[name="news_img"]').val(data);
                        }else{
                            alert('There is some problem in upload, please try again!')
                        }
                    }
                });

                return true;
            }
        });
    });
</script>