
<header class="header" style="background-color: #f0f3f4;margin-top: 50px;position: fixed;">
    <div class="row" style="margin-bottom:20px;box-shadow:0 2px 3px #888888;background-color:white; padding-left:20px;">
           <div id="kroo_summary" style="float: left;">
                <div class="sm-st clearfix ">
                    <span class="sm-st-icon st-red"><i class="fa fa-rss-square"></i></span>
                    <div class="sm-st-info">
                        <span><?php echo $getNewsSummary[0]->total_Feeds; ?></span>
                        <h6>TOTAL FEEDS</h6>
                    </div>
                </div>


                <div class="sm-st clearfix ">
                    <span class="sm-st-icon st-violet"><i class="fa fa-paper-plane"></i></span>
                    <div class="sm-st-info publish_count">
                        <span><?php echo $getNewsSummary[0]->total_Published; ?></span>
                        <h6>PUBLISHED</h6>
                    </div>
                </div>


                <div class="sm-st clearfix ">
                    <span class="sm-st-icon st-blue"><i class="fa fa-bell"></i></span>
                    <div class="sm-st-info notify_count">
                        <span><?php echo $getNewsSummary[0]->total_Notifieds; ?></span>
                        <h6>NOTIFIED</h6>

                    </div>
                </div>                       
           </div>

           <div id="fantasy_summary" style="display: none; float: left;">

                <div class="sm-st clearfix ">
                    <span class="sm-st-icon st-red"><i class="fa fa-rss-square"></i></span>
                    <div class="sm-st-info">
                        <span><?php echo $getFantasySummary[0]->total_f_feeds; ?></span>
                        <h6>TOTAL FEEDS</h6>
                    </div>
                </div>


                <div class="sm-st clearfix ">
                    <span class="sm-st-icon st-violet"><i class="fa fa-paper-plane"></i></span>
                    <div class="sm-st-info">
                        <span><?php echo $getFantasySummary[0]->total_f_published; ?></span>
                        <h6>PUBLISHED</h6>
                    </div>
                </div>


           </div>

            <div id="article_summary" style="display: none; float: left;">

                <div class="sm-st clearfix ">
                    <span class="sm-st-icon st-red"><i class="fa fa-rss-square"></i></span>
                    <div class="sm-st-info">
                        <span><?php echo $getArticleSummary[0]->total_w_feeds; ?></span>
                        <h6>TOTAL FEEDS</h6>
                    </div>
                </div>


                <div class="sm-st clearfix ">
                    <span class="sm-st-icon st-violet"><i class="fa fa-paper-plane"></i></span>
                    <div class="sm-st-info">
                        <span><?php echo $getArticleSummary[0]->total_w_published; ?></span>
                        <h6>PUBLISHED</h6>
                    </div>
                </div>


           </div>

           <div id="search_bar" style="float: right; margin-right: 30px;">

                <div class="form-group" style="padding-top: 5px;"> 
                    <!-- <i class="fa fa-search"></i>      -->                           
                    <input class="form-control" id="news_search_box" type="text" autocomplete="off" style="width: 400px; border-radius: 20px;" placeholder="search news...">
                    <span class="glyphicon glyphicon-search" style="display: block; height: 34px; line-height: 42px; pointer-events: none; position: absolute;right: 20px; text-align: center;top: 0;width: 34px;z-index: 2;"></span>
                </div>

           </div>
        
        <div id="message_success" style="display:none;background-color: #27C24C;border-radius: 14px;color: #FFFFFF;left: 42%;padding-top: 6px; padding-left:20px; padding-right:20px; position: absolute;top: 50px;"><p id="message_text"><b>Updated Successfully !</b></p></div>

        <div id="message_loading" style="display:none;background-color: #ffdc99; padding-top:5px;border-radius: 10px;left: 45%; padding-left:10px;padding-right:10px; position: absolute;top: 50px;"><p id="message_text"><b>Loading...</b></p></div>

        <div id="message_success_insert" style="display:none;background-color: #27C24C;border-radius: 14px;color: #FFFFFF;left: 42%;padding-top: 6px; padding-left:20px; padding-right:20px; position: absolute;top: 63px;"><p id="message_text"><b>Saved Successfully !</b></p></div>
        <div id="message_success_update" style="display:none;background-color: #27C24C;border-radius: 14px;color: #FFFFFF;left: 42%;padding-top: 6px; padding-left:20px; padding-right:20px; position: absolute;top: 63px;"><p id="message_text"><b>Updated Successfully !</b></p></div>
        <div id="message_success_publish" style="display:none;background-color: #27C24C;border-radius: 14px;color: #FFFFFF;left: 42%;padding-top: 6px; padding-left:20px; padding-right:20px; position: absolute;top: 63px;"><p id="message_text"><b>published Successfully !</b></p></div>                


    </div>
</header>

<div class="wrapper row-offcanvas row-offcanvas-left" style="margin-top: 120px;">

    <aside class="right-side strech" style="margin-top: 0px;">

       <div style="margin-left:17px; margin-right:17px;">


            <ul class="nav nav-tabs" role="tablist" id="news_tab">
               <li role="presentation" class="active"><a href="#kroo" aria-controls="kroo" role="tab" data-toggle="tab"><span style="font-size:12px;"><b>KROO CAST</b></span></a></li>
               <li role="presentation"><a href="#headlines" aria-controls="kroo" role="tab" data-toggle="tab"><span style="font-size:12px;"><b>HEADLINES</b></span></a></li>
               <li role="presentation"><a href="#fantasy" aria-controls="fantasy" role="tab" data-toggle="tab"><span style="font-size:12px;"><b>FANTASY CAST</b></span></a></li> 
               <li role="presentation"><a href="#article" aria-controls="article" role="tab" data-toggle="tab"><span style="font-size:12px;"><b>WAIVER NEWS</b></span></a></li> 
               <li role="presentation"><a href="#krooCastVideo" aria-controls="krooCastVideo" role="tab" data-toggle="tab"><span style="font-size:12px;"><b>KROO CAST VIDEO</b></span></a></li> 

            </ul>

            <ul class="nav nav-tabs" role="tablist" id="search_tab" style="display: none;">
                 <li role="presentation" class="active"><a href="#kroo" aria-controls="kroo" role="tab" data-toggle="tab"><span style="font-size:12px;"><b>Search Result</b></span></a></li>
                 <li role="presentation"> <a href="javascript:void(0);" onclick="location.reload();"><span style="font-size:12px;"><b>Back</b></span></a></li>
            </ul>

             <div class="tab-content" style="background-color:#FFFFFF;margin-left:1px;">

               <div role="tabpanel" class="tab-pane active" id="kroo">

                   <div style="display:flex; padding-top:20px; padding-left:20px;" id="left_filters">
                     


                       <div class="dropdown">
                           <button class="btn btn-default dropdown-toggle select_league_text" type="button" data-toggle="dropdown">Select League
                           <span class="caret"></span></button>
                           <?php
                               if(!empty($kroo_news['all_leagues'])){
                                   echo '<ul class="dropdown-menu">';
                                   echo '<li style="text-align:center"><a class="select_league" data-id="" data-name="All League" href="javascript:void(0);"><span>All League</span></a></li>';
                                   foreach($kroo_news['all_leagues'] as $news){
                                       echo '<li style="text-align:center"><a class="select_league" data-id="'.$news->id.'" data-name="'.$news->name.'" href="javascript:void(0);"><span>'.$news->name.'</span></a></li>';
                                   }
                                   echo '</ul>';
                               }
                           ?>
                       </div>

                       <div class="dropdown" style="padding-left:10px;">
                           <button class="btn btn-default dropdown-toggle select_team_text" type="button" data-toggle="dropdown">Select Team
                           <span class="caret"></span></button>
                           <ul class="dropdown-menu" id="select_team" style="height: auto; max-height: 500px; overflow-x:hidden; ">
                               <li style="text-align:center"><h4>Select League</h4></li>
                           </ul>
                       </div>                     
                      

                       <div class="dropdown" style="padding-left:10px;">

                           <button class="btn btn-default dropdown-toggle select_news_type" type="button" data-toggle="dropdown">Select News
                           <span class="caret"></span></button>
                           <ul class="dropdown-menu">
                               <li style="text-align:center"><a class="get_publish" href="javascript:void(0);" data-id="2" data-name="All News">All News</a></li>
                               <li style="text-align:center"><a class="get_publish" href="javascript:void(0);" data-id="1" data-name="Published">Published</a></li>
                               <li style="text-align:center"><a class="get_publish" href="javascript:void(0);" data-id="0" data-name="Not Published">Not Published</a>
                               </li>
                               <li style="text-align:center"><a class="get_publish" id="notified_sort" href="javascript:void(0);" data-id="3" data-name="Notified">Notified</a></li>
                           </ul>

                       </div>

                       <div style="padding-left:10px;">
                           <form class="form-inline" id="news_date_form">
                               <div class="form-group">
                                   <input type="text" class="form-control datepicker datepicker1" autocomplete="off" placeholder="From Date" id="datepicker1" name="datepicker1" />
                               </div>
                               <div class="form-group">
                                   <input type="text" class="form-control datepicker datepicker2" autocomplete="off" placeholder="To Date" id="datepicker2" name="datepicker2" />
                               </div>
                               <button id="btn_get_date" class="btn btn-default">Get News</button>
                           </form>
                       </div>

                       <div class="dropdown" style="padding-right:10px; float: right; margin-left:auto;">
                           <button class="btn btn-default btn-add-news" data-toggle="modal" data-target="#myAddNewsModel" type="button">Add News</button>
                       </div>

                       <div class="dropdown" style="padding-right:10px; float: right;">
                           <button class="btn btn-default clr-fltr" type="button">Clear Filter</button>
                       </div>

                       <div style="padding-right:10px; float: right;">
                           <a href="javascript:void(0);" id="mass_publish" class="btn btn-default">Publish Selected</a>
                       </div>

                        <div class="dropdown" style="padding-right:10px; float: right;">
                           <button class="btn btn-default dropdown-toggle select_channel_text" type="button" data-toggle="dropdown">Select Channel
                           <span class="caret"></span></button>
                           <?php
                               if(!empty($channel2)){
                                   echo '<ul class="dropdown-menu">';
                                    foreach($channel2 as $row){
                                       echo '<li style="text-align:center"><a class="select_channel" data-id="'.$row['id'].'" data-name="'.$row['name'].'" href="javascript:void(0);"><span>'.$row['name'].'</span></a></li>';
                                   }
                                   echo '</ul>';
                               }
                           ?>
                       </div>



                   </div>

                   <br>

                   <div>

                       <table class="table table-hover kroo_data_table" id="kroo_team_news">
                           <thead>
                               <tr>
                                   <th class="col-md-*"><input type="checkbox" class="checkall" />
                                       <input type="hidden" id="listCNT0" value="0">
                                       <input type="hidden" id="listTYPE0" autocomplete="off" value="">
                                   </th>
                                   <th class="col-md-*">Team</th>
                                   <th class="col-md-8">Feeds</th>
                                   <th class="col-md-2 text-center">Actions</th>
                                   <th class="col-md-* text-right" style="padding-right:40px;"><span class="glyphicon glyphicon-flag" aria-hidden="true"></span></th>
                               </tr>
                           </thead> 
                           <tbody></tbody>   
                           </table>
                       </div>
               </div>

               <!-- HEADLINES CONTENT -->
               <div role="tabpanel" class="tab-pane" id="headlines">

                   <div style="display:flex; padding-top:20px; padding-left:20px;" id="left_filters">

                      
                       <div class="dropdown">
                           <button class="btn btn-default dropdown-toggle select_league_text" type="button" data-toggle="dropdown">Select League
                           <span class="caret"></span></button>
                           <?php
                               if(!empty($kroo_news['all_leagues'])){
                                   echo '<ul class="dropdown-menu">';
                                   echo '<li style="text-align:center"><a class="select_league" data-id="" data-name="All League" href="javascript:void(0);"><span>All League</span></a></li>';
                                    foreach($kroo_news['all_leagues'] as $news){
                                       echo '<li style="text-align:center"><a class="select_league" data-id="'.$news->id.'" data-name="'.$news->name.'" href="javascript:void(0);"><span>'.$news->name.'</span></a></li>';
                                   }
                                   echo '</ul>';
                               }
                           ?>
                       </div>

                      <!--  <div class="dropdown" style="padding-left:10px;">
                           <button class="btn btn-default dropdown-toggle select_team_text" type="button" data-toggle="dropdown">Select Team
                           <span class="caret"></span></button>
                           <ul class="dropdown-menu" id="select_team" style="height: auto; max-height: 500px; overflow-x:hidden; ">
                               <li style="text-align:center"><h4>Select League</h4></li>
                           </ul>
                       </div> -->
                      <div class="dropdown" style="padding-left:10px;">

                           <button class="btn btn-default dropdown-toggle select_news_type" type="button" data-toggle="dropdown">Select News
                           <span class="caret"></span></button>
                           <ul class="dropdown-menu">
                               <li style="text-align:center"><a class="get_publish" href="javascript:void(0);" data-id="2" data-name="All News">All News</a></li>
                               <li style="text-align:center"><a class="get_publish" href="javascript:void(0);" data-id="1" data-name="Published">Published</a></li>
                               <li style="text-align:center"><a class="get_publish" href="javascript:void(0);" data-id="0" data-name="Not Published">Not Published</a>
                               </li>
                               <li style="text-align:center"><a class="get_publish" id="notified_sort" href="javascript:void(0);" data-id="3" data-name="Notified">Notified</a></li>
                           </ul>

                       </div>

                       <div style="padding-left:10px;">
                           <form class="form-inline" id="headline_date_form">
                               <div class="form-group">
                                   <input type="text" class="form-control datepicker datepicker1" autocomplete="off" placeholder="From Date" id="datepicker1" name="datepicker1" />
                               </div>
                               <div class="form-group">
                                   <input type="text" class="form-control datepicker datepicker2" autocomplete="off" placeholder="To Date" id="datepicker2" name="datepicker2" />
                               </div>
                               <button id="btn_get_date" class="btn btn-default">Get News</button>
                           </form>
                       </div>
                       <div class="dropdown" style="padding-right:10px; float: right; margin-left:auto;">
                           <button class="btn btn-default btn-add-news" data-toggle="modal" data-target="#myAddNewsModel" type="button">Add News</button>
                       </div>


                       <div class="dropdown" style="padding-right:10px; float: right;">
                           <button class="btn btn-default clr-fltr" type="button">Clear Filter</button>
                       </div>

                       <div style="padding-right:10px; float: right;">
                           <a href="javascript:void(0);" id="mass_publish" class="btn btn-default">Publish Selected</a>
                       </div>

                       <div class="dropdown" style="padding-right:10px; float: right;">
                           <button class="btn btn-default dropdown-toggle select_channel_text" type="button" data-toggle="dropdown">Select Channel
                           <span class="caret"></span></button>
                           <?php
                               if(!empty($channel31)){
                                   echo '<ul class="dropdown-menu">';
                                    foreach($channel31 as $row){
                                       echo '<li style="text-align:center"><a class="select_channel" data-id="'.$row['id'].'" data-name="'.$row['name'].'" href="javascript:void(0);"><span>'.$row['name'].'</span></a></li>';
                                   }
                                   echo '</ul>';
                               }
                           ?>
                       </div>

                   </div>

                   <br>

                   <div>

                        <table class="table table-hover kroo_data_table" id="kroo_headlines">
                           <thead>
                               <tr>
                                   <th class="col-md-*"><input type="checkbox" class="checkall" />
                                       <input type="hidden" id="listCNT1" value="0">
                                       <input type="hidden" id="listTYPE1" autocomplete="off" value="">
                                   </th>
                                   <th class="col-md-*">League</th>
                                   <th class="col-md-8">Feeds</th>
                                   <th class="col-md-2 text-center">Actions</th>
                                   <th class="col-md-* text-right" style="padding-right:40px;"><span class="glyphicon glyphicon-flag" aria-hidden="true"></span></th>
                               </tr>
                           </thead> 
                           <tbody></tbody>   
                           </table>
                       </div>
               </div>

                <!-- Add game Modal start -->
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
                              <legend>  </legend>

                              <div class="form-group">
                                <label class="col-md-2 control-label">Game Type</label>  
                                <div class="col-md-9" style="padding-left: 0px;">
                                  <div class="col-md-4">
                                  <select name="select_game_category" id="select_game_category" class="form-control">
                                    <option class="select_leagues" data-id="1" value="1">Generic</option>
                                    <option class="select_leagues" data-id="2" value="2" selected="selected">News Feed Based</option>
                                  </select> 
                                  </div>
                                  <div id="difficulty_block" style="display:none;">
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
                                <span id="hiddenId"><input type="hidden"  name="id" id="qus_id"></span>
                                <label class="col-md-2 control-label" for="user_email">Question</label>  
                                <div class="col-md-7">
                                <input type="hidden" name="news_id" id="news_id">
                                <input type="hidden" name="publish_id" id="publish_id">

                                <input id="NowPublishDate" name="NowPublishDate" value="" type="hidden">
                                <input id="NowPublishTime" name="NowPublishTime" value="" type="hidden">
                                <span id="qustions">
                                <textarea id="question" name="question" class="form-control" placeholder="question" rows="3" maxlength="500" value="" onKeyDown="limitText(this,100);" onKeyUp="limitText(this,300);"></textarea>
                                </span>
                                <p style="font-size: 11px;">Max 100 characters allowed</p>
                                <div id="login_question_err" class="error"></div>
                                </div>
                              </div>

                              <div class="col-md-8" style="margin-left: 30px;" id="radio_list">

                                  <label class="" style="width: 55px;">Options</label>

                                  <label id="option_1" class="radio-inline">
                                      <span>1</span>
                                      <input id="ansTxtOpt1" name="ans_opt1" placeholder="option1" class="" type="text" value="" style="height: 35px; margin-left: 12px;width: 383px; border: 1px solid #ccc; border-radius: 4px;" onKeyDown="limitText(this,40);" onKeyUp="limitText(this,100);">
                                  </label>
                                  <br>
                                  <label id="option_2" class="radio-inline">
                                    <span>2</span>
                                      <input id="ansTxtOpt2" type="text" name="ans_opt2" placeholder="option2" style="height
                                    : 35px; margin-left: 12px;width: 383px; border: 1px solid #ccc; border-radius: 4px; margin-bottom: 12px;" onKeyDown="limitText(this,40);" onKeyUp="limitText(this,40);">
                                  </label>
                                  <br>
                                  <label id="option_3" class="radio-inline">
                                    <span>3</span>
                                    <input id="ansTxtOpt3" type="text" name="ans_opt3" placeholder="option3" style="height
                                    : 35px; margin-left: 12px;width: 383px; border: 1px solid #ccc; border-radius: 4px; margin-bottom: 12px;" onKeyDown="limitText(this,40);" onKeyUp="limitText(this,40);">
                                  </label>
                                  <br>                
                                  <label id="option_4" class="radio-inline" style="margin-bottom: 6px;">
                                    <span>4</span>
                                    <input id="ansTxtOpt4" type="text" name="ans_opt4" placeholder="option4" style="height
                                    : 35px; margin-left: 12px;width: 383px; border: 1px solid #ccc; border-radius: 4px; margin-bottom: 3px;" onKeyDown="limitText(this,40);" onKeyUp="limitText(this,40);">
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
                                <img class="thumbnl" src="">
                                <input type="hidden" name="news_img" value="">
                              </div>
                              <div id="file-uploader-myAddModal">
                                  <button id="upload">Change Image</button>
                                  <noscript> <p>Please enable JavaScript to use file uploader.</p> </noscript> 
                                 </div>
                                </div>
                              </div> 

                              <div class="form-group">
                                <label class="col-md-2 control-label" for="user_email">Credits</label>  
                                <div class="col-md-4" id="creditpnt">
                                <!-- <input id="credits" name="credits" placeholder="Credits" class="form-control input-md" type="text" value="">
                                <div id="login_credits_err" class="error"></div> -->
                                <select name="credits" id="credits" class="form-control"></select> 
                                </div>
                              </div> 


                              <div class="form-group">
                                <label class="col-md-2 control-label" for="user_email">League</label>  
                                <div class="col-md-9" style="padding-left: 0px;">
                                  <div class="col-md-4">
                                  <select name="news_league_id" id="" class="form-control game_leagues">
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
                                    <select id="add_game_team" name="news_team_id" class="form-control new_team">   
                                    </select>                                

                                  </div>
                                <div id="login_credits_err" class="error"></div>
                                </div>
                              </div> 

                              <div class="form-group">
                                <label class="col-md-2 control-label" for="user_email">Sponsor </label>  
                                <div class="col-md-9" style="padding-left: 0px;">
                                  <div class="col-md-4">
                                  <select name="sponser" id="sponser_id" class="form-control sponser_class">
                                    <option value="0">select sponsor </opton>
                                       <?php
                                          if(!empty($kroo_news['sponser'])){
                                            foreach($kroo_news['sponser'] as $sponser){ 
                                              echo '<option class="" id="" data-id="'.$sponser->id.'" value="'.$sponser->id.'">'.$sponser->label.'</option>';
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
                                <div class="col-md-6" id="link">
                                  <input id="linkid" name="link" placeholder="Link" class="form-control input-md" type="text" value="">
                                <div id="login_credits_err" class="error"></div>
                                </div>
                              </div>


                              <div class="form-group">
                                <label class="col-md-2 control-label" for="user_email">Explanation</label>  
                                <div class="col-md-7" id="exp">
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
                                          echo'<option value="'. str_pad($i, 2, "0", STR_PAD_LEFT) .'">'.$i.' hour</option>'; 
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
                                          echo'<option value="'. str_pad($i, 2, "0", STR_PAD_LEFT) .'">'.$i.' min</option>'; 
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
                                          echo'<option value="'. str_pad($i, 2, "0", STR_PAD_LEFT) .'">'.$i.' sec</option>'; 
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
                          <button class="btn btn-primary"  id="submit_form" style="width: 75px;" >Save</button>
                          <button class="btn btn-primary"  id="submit_publish_form" style="width: 100px;:"; value="2" >Publish Later</button> 
                          <button class="btn btn-primary"  id="submit_now_form"style="width: 94px;:"; value="3" > Publish Now</button>                                                   
                      
                          <button type="button" class=" btn btn-default" style="width: 75px; margin-left: 2px;" data-dismiss="modal">Close</button>
                        </div>
                      </div>
                      
                    </div>
                  </div> 
                  
                <!-- Add game modal End----------------> 


                 <!-- ..................Modal  Start...................... -->
               <div class="modal fade" id="myModal" role="dialog">
                   <div class="modal-dialog">                            
                         <!-- Modal content-->
                           <div class="modal-content">
                               <div class="modal-header">
                                 <button type="button" class="close" data-dismiss="modal">&times;</button>
                                 <h4 class="modal-title"><b>Edit News</b></h4>
                                 <p style="margin-bottom: -10px;color:gray;font-size:11px;" id="edit_news_at"></p> 

                               </div>

                               <div class="modal-body">
                                   <div id="edit_activity_detail"></div>  
                                  <form id="edit_form" enctype="multipart/form-data" accept-charset="utf-8" name="fileinfo">
                                       <input type="hidden" name="edit_tab_index" id="edit_tab_index" class="form-control">
                                       <input type="hidden" name="edit_news_id" id="edit_news_id" class="form-control">
                                       <input type="hidden" name="news_image_url" id="news_image_url" class="form-control">

                                       <p>Title: <span id="rss_title"></span></p>
                                       <input type="text" class="form-control" name="edit_news_title" id="edit_news_title" placeholder="Title">

                                       <p>Summary: <span id="rss_summary"></span></p>
                                       <p><b>NOTE :</b> Max 300 characters allowed</p>
                                       <textarea class="form-control" name="edit_news_summary" id="edit_news_summary" maxlength="300" rows="3"></textarea>

                                       <p>Url: <a id="news_url" target="_blank"><span id="rss_url"></span></a></p>
                                       <input type="text" class="form-control" name="edit_news_url" id="edit_news_url" placeholder="Url">

                                       <p>Image</p>
                                       
                                       <img id="news_image" class="thumbnl" style="width: 250px;" src="">
                                       <img id="original_news_image" style="width: 250px;" class="pull-right" src="">
                                       <input type="hidden" name="news_img" value="">
                                       <div style="clear: both;">
                                       <div id="file-uploader-myModal">
                                        <button id="upload">Change Image</button>
                                        <noscript> <p>Please enable JavaScript to use file uploader.</p> </noscript> 
                                       </div>
                                       <button id="Search_From_Getty">Getty</button>
                                       <button id="useOriginal">Use Original</button>
                                       </div>
                                       <hr>

                                       <p>Source: <span id="rss_source"></span></p>
                                       <!-- <input type="text" class="form-control" name="edit_news_source" id="edit_news_source" placeholder="Source"> -->

                                       <div style="display: none;" id="edit_league_team">
                                           <div>
                                               <p>League</p>
                                               <select name="news_league_ids" class="form-control news_leagues news_leagues" required="required">  
                                               <option value="0">Select League</option>      
                                               <?php
                                                    echo '<li style="text-align:center"><a class="select_league" data-id="" data-name="All League" href="javascript:void(0);"><span>All League</span></a></li>';
                                                       if(!empty($kroo_news['all_leagues'])){

                                                            foreach($kroo_news['all_leagues'] as $news){
                                                               //echo '<li style="text-align:center"><a class="select_league" data-id="'.$news->id.'" data-name="'.$news->name.'" href="javascript:void(0);"><span>'.$news->name.'</span></a></li>';
                                                               echo '<option id="select_news_league" data-id="'.$news->id.'" value="'.$news->id.'">'.$news->name.'</option>';
                                                           }

                                                       }
                                               ?>                                           
                                               </select>                                                                                         
                                           </div>

                                           <div style="margin-left: 30px;">                                                       
                                               <p>Team</p>
                                               <select id="news_league_id" name="news_league_id" class="form-control" required>   
                                               </select>
                                           </div>

                                       </div>

                                       <hr>

                                       <button type="submit" id="btn_update" class="btn btn-primary">Update</button>
                                       <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

                                   </form>
                               </div>

                           </div>

                   </div>
               </div>

               <!--  Detail modal box start -->
                <div class="modal fade" id="myDetailModal" role="dialog">
                   <div class="modal-dialog">                            
                         <!-- Modal content-->
                           <div class="modal-content">
                               <div class="modal-header">
                                 <button type="button" class="close" data-dismiss="modal">&times;</button>
                                 <h4 id="modal_title" class="modal-title"><b>Detail</b></h4>                                
                               </div>

                               <div class="modal-body">
                                  <div id="edit_activity_detail"></div>  
                                    <form enctype="multipart/form-data" accept-charset="utf-8" name="detailInfo">
                                      <input type="hidden" name="detail_id" id="detail_id" class="form-control">
                                      <p>Title: <span id="m_news_detail"></span></p>
                                      <p>Detail: <span id=""></span></p>
                                      <textarea name="editor1" id="editor1" rows="5" cols="60"> 
                                      </textarea>
                                      <hr>
                                       <button type="submit" id="btn_detail_update" class="btn btn-primary">Update</button>
                                       <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

                                   </form>
                               </div>

                           </div>

                   </div>
               </div>

               <div class="modal fade" id="myAddNewsModel" role="dialog">
                   <div class="modal-dialog">                            
                         <!-- Modal content-->
                           <div class="modal-content">
                               <div class="modal-header">
                                 <button type="button" class="close" data-dismiss="modal">&times;</button>
                                 <h4 class="modal-title"><b>Add News</b></h4>
                                 <p style="margin-bottom: -10px;color:gray;font-size:11px;" id="edit_news_at"></p> 

                               </div>

                               <div class="modal-body">                                    
                                  <form id="edit_form" enctype="multipart/form-data" accept-charset="utf-8" name="Addfileinfo">                                     

                                       <p>Title: <span id="rss_title"></span></p>
                                       <input type="text" class="form-control" name="news_title" id="news_title" placeholder="Title" required>

                                       <p>Summary: <span id="rss_summary"></span></p>
                                       <p><b>NOTE :</b> Max 300 characters allowed</p>
                                       <textarea class="form-control" name="news_summary" id="news_summary" maxlength="300" rows="3"></textarea>
                                       <p>Url: <a id="news_url" target="_blank"><span id="rss_url"></span></a></p>
                                       <input type="text" class="form-control" name="news_url" id="news_url" placeholder="Url">
                                       <p>Image</p>
                                       <img id="news_image" class="thumbnl" style="width: 250px;" src="">
                                       <input type="hidden" name="news_img" value="">
                                       <div style="clear: both;">
                                       <div id="file-uploader-myAddNewsModel">
                                        <button id="upload">Change Image</button>
                                        <noscript> <p>Please enable JavaScript to use file uploader.</p> </noscript> 
                                       </div>
                                      
                                       </div>
                                       <hr>

                                       <div  id="edit_league_team">
                                           <div>
                                               <p>League</p>
                                               <select name="news_league_id" class="form-control news_leagues ">  
                                               <option value="select">Select League</option>      
                                               <?php
                                                       if(!empty($kroo_news['all_leagues'])){

                                                            foreach($kroo_news['all_leagues'] as $news){
                                                               //echo '<li style="text-align:center"><a class="select_league" data-id="'.$news->id.'" data-name="'.$news->name.'" href="javascript:void(0);"><span>'.$news->name.'</span></a></li>';
                                                               echo '<option id="select_news_league" data-id="'.$news->id.'" value="'.$news->id.'">'.$news->name.'</option>';
                                                           }

                                                       }
                                               ?>                                           
                                               </select>                                                                                         
                                           </div>

                                           <div>                                                       
                                               <p>Team</p>
                                               <select id="add_news_team" name="news_team_id" class="form-control">   
                                               </select>
                                           </div>

                                       </div>

                                       <hr>

                                       <button type="submit" id="btn_add_news" class="btn btn-primary">Add News</button>
                                       <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

                                   </form>
                               </div>

                           </div>

                   </div>
               </div>

               <div class="modal fade" id="gettyModal" role="dialog">
                   <div class="modal-dialog">                            
                         <!-- Modal content-->
                           <div class="modal-content">
                               <div class="modal-header">
                                 <button type="button" class="close" data-dismiss="modal">&times;</button>
                                 <h4 class="modal-title"><b>Search Image from Getty</b></h4>
                               </div>

                               <div class="modal-body">
                                  <form id="getty_form" enctype="multipart/form-data" accept-charset="utf-8" name="fileinfo">
                                       <input type="hidden" name="edit_tab_index" id="edit_tab_index" class="form-control">
                                       <input type="hidden" name="edit_news_id" id="edit_news_id" class="form-control">
                                       <input type="hidden" name="news_image_url" id="news_image_url" class="form-control">

                                       <p>Title: <span id="rss_title"></span></p>
                                       <input type="text" class="form-control" id="serch" placeholder="Search" style="width:80%; float:left; margin-right:20px;"> 
                                       <button type="submit" class="btn btn-success">Search</button>
                                  </form>
                                  <hr>
                                  <div id="getImgList" style="min-height:200px; max-height:500px; overflow-y:scroll;"></div>
                               </div>

                           </div>

                   </div>
               </div>

               <div class="modal fade" id="myAddPlayerNewsModel" role="dialog">
                   <div class="modal-dialog">                            
                         <!-- Modal content-->
                           <div class="modal-content">
                               <div class="modal-header">
                                 <button type="button" class="close" data-dismiss="modal">&times;</button>
                                 <h4 class="modal-title"><b>Add News</b></h4>
                                 <p style="margin-bottom: -10px;color:gray;font-size:11px;" id="edit_news_at"></p> 

                               </div>

                               <div class="modal-body">                                    
                                  <form id="edit_form" enctype="multipart/form-data" accept-charset="utf-8" name="addPlayerNews">                                     

                                       <p>Title: <span id="rss_title"></span></p>
                                       <input type="text" class="form-control" name="news_title" id="news_title" placeholder="Title">

                                       <p>Summary: <span id="rss_summary"></span></p>
                                       <p><b>NOTE :</b> Max 300 characters allowed</p>
                                       <textarea class="form-control" name="news_summary" id="news_summary" maxlength="300" rows="3"></textarea>

                                       <p>Url: <a id="news_url" target="_blank"><span id="rss_url"></span></a></p>
                                       <input type="text" class="form-control" name="news_url" id="news_url" placeholder="Url">

                                       <p>Image</p>
                                       
                                       <img id="news_image" class="thumbnl" style="width: 250px;" src="">
                                       <input type="hidden" name="news_img" value="">
                                       <div style="clear: both;">
                                       <div id="file-uploader-myAddPlayerNewsModel">
                                        <button id="upload">Upload Image</button>
                                        <noscript> <p>Please enable JavaScript to use file uploader.</p> </noscript> 
                                       </div>
                                      
                                       </div>
                                       <hr>

                                      
                                       <!-- <input type="text" class="form-control" name="edit_news_source" id="edit_news_source" placeholder="Source"> -->

                                       <div  id="edit_league_team">
                                           <div>
                                               <p>League</p>
                                               <select name="news_league_id" id="news_league_id" class="form-control">  
                                               <option value="0">Select League</option>      
                                               <?php
                                                       if(!empty($kroo_news['all_leagues'])){

                                                            foreach($kroo_news['all_leagues'] as $news){
                                                               //echo '<li style="text-align:center"><a class="select_league" data-id="'.$news->id.'" data-name="'.$news->name.'" href="javascript:void(0);"><span>'.$news->name.'</span></a></li>';
                                                               echo '<option id="select_player_league" data-id="'.$news->id.'" value="'.$news->id.'">'.$news->name.'</option>';
                                                           }

                                                       }
                                               ?>                                           
                                               </select>                                                                                         
                                           </div>

                                           <div>                                                       
                                               <p>Player Name</p>
                                                <input type="text" class="form-control" name="txt_player_name" id="txt_player_name" placeholder="start type to search">
                                                <div id="suggesstion-box">                                                    
                                                      <ul id="country-list"> 

                                                      </ul>
                                                </div>
                                                <p>Team Code</p>
                                                <input type="text" class="form-control" name="txt_player_code" id="txt_player_code">
                                           </div>

                                       </div>

                                       <hr>

                                       <button type="submit" id="btn_add_player_news" class="btn btn-primary">Add News</button>
                                       <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

                                   </form>
                               </div>

                           </div>

                   </div>
               </div>

                <div class="modal fade" id="myCopyModal" role="dialog">
                   <div class="modal-dialog">                            
                         <!-- Modal content-->
                           <div class="modal-content">
                               <div class="modal-header">
                                 <button type="button" class="close" data-dismiss="modal">&times;</button>
                                 <h4 id="modal_title" class="modal-title"><b>Copy To Headlines</b></h4>                                

                               </div>

                               <div class="modal-body">
                                  <div id="edit_activity_detail"></div>  
                                  <form enctype="multipart/form-data" accept-charset="utf-8" name="copyInfo">
                                      <input type="hidden" name="copy_news_id" id="copy_news_id" class="form-control">
                                       <div style="display: flex;" id="copy_team_list">
                                           <div>
                                               <p>Team</p>
                                               <select name="copy_team_id" id="copy_team_id" class="form-control">  
                                               <option value="0">Select Team</option>     
                                                                                      
                                               </select>                                                                                         
                                           </div>
                                       </div>

                                       <hr>

                                       <button type="submit" id="btn_copy_update" class="btn btn-primary">Confirm</button>
                                       <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

                                   </form>
                               </div>

                           </div>

                   </div>
               </div>

              <!-- modal box -->
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

               <!-- ..................Modal  End...................... -->

               <div role="tabpanel" class="tab-pane" id="fantasy">

                   <div style="display:flex; padding-top:20px; padding-left:20px;" id="left_filters">
                       <div class="dropdown">
                           <button class="btn btn-default dropdown-toggle select_league_text" type="button" data-toggle="dropdown">Select League
                           <span class="caret"></span></button>
                           <?php
                               if(!empty($kroo_news['all_leagues'])){
                                   echo '<ul class="dropdown-menu">';
                                   echo '<li style="text-align:center"><a class="select_league" data-id="" data-name="All League" href="javascript:void(0);"><span>All League</span></a></li>';
                                    foreach($kroo_news['all_leagues'] as $news){
                                       echo '<li style="text-align:center"><a class="select_league" data-id="'.$news->id.'" data-name="'.$news->name.'" href="javascript:void(0);"><span>'.$news->name.'</span></a></li>';
                                   }
                                   echo '</ul>';
                               }
                           ?>
                       </div>

                       <div class="dropdown" style="padding-left:10px;">
                           <button class="btn btn-default dropdown-toggle select_team_text" type="button" data-toggle="dropdown">Select Team
                           <span class="caret"></span></button>
                           <ul class="dropdown-menu" id="select_team" style="height: auto; max-height: 500px; overflow-x:hidden; ">
                               <li style="text-align:center"><h4>Select Team</h4></li>
                           </ul>
                       </div>

                        <div class="dropdown" style="padding-left:10px;">
                           <button class="btn btn-default dropdown-toggle select_player_text" type="button" data-toggle="dropdown">Select Player
                           <span class="caret"></span></button>
                           <ul class="dropdown-menu" id="select_player" style="height: auto; max-height: 500px; overflow-x:hidden; ">
                               <li style="text-align:center"><h4>Select Player</h4></li>
                           </ul>
                       </div>

                       <div class="dropdown" style="padding-left:10px;">
                           <button class="btn btn-default dropdown-toggle select_position_text" type="button" data-toggle="dropdown">Select Position
                           <span class="caret"></span></button>
                           <ul class="dropdown-menu" id="select_position" style="height: auto; max-height: 500px; overflow-x:hidden; ">
                               <li style="text-align:center"><h4>Select Position</h4></li>
                           </ul>
                       </div>



                       <div class="dropdown" style="padding-left:10px;">

                           <button class="btn btn-default dropdown-toggle select_news_type" type="button" data-toggle="dropdown">Select News
                           <span class="caret"></span></button>
                           <ul class="dropdown-menu">
                               <li style="text-align:center"><a class="get_publish" href="javascript:void(0);" data-id="2" data-name="All News">All News</a></li>
                               <li style="text-align:center"><a class="get_publish" href="javascript:void(0);" data-id="1" data-name="Published">Published</a></li>
                               <li style="text-align:center"><a class="get_publish" href="javascript:void(0);" data-id="0" data-name="Not Published">Not Published</a>
                               </li>
                               <li style="text-align:center"><a class="get_publish" id="notified_sort" href="javascript:void(0);" data-id="3" data-name="Notified">Notified</a></li>
                           </ul>

                       </div>

                       <div style="padding-left:10px;">
                           <form class="form-inline" id="news_date_form">
                               <div class="form-group">
                                   <input type="text" class="form-control datepicker datepicker1" autocomplete="off" placeholder="From Date" id="datepicker1" name="datepicker1" />
                               </div>
                               <div class="form-group">
                                   <input type="text" class="form-control datepicker datepicker2" autocomplete="off" placeholder="To Date" id="datepicker2" name="datepicker2" />
                               </div>
                               <button id="btn_get_date" class="btn btn-default">Get News</button>
                           </form>
                       </div>

                      <div class="dropdown" style="padding-right:10px; float: right; margin-left:auto;">
                           <button class="btn btn-default btn-addplayer-news" data-toggle="modal" data-target="#myAddPlayerNewsModel" type="button">Add News</button>
                       </div>

                       <div class="dropdown" style="padding-right:10px; float: right;">
                           <button class="btn btn-default clr-fltr" type="button">Clear Filter</button>
                       </div>

                       <div style="padding-right:10px; float: right;">
                           <a href="javascript:void(0);" id="mass_publish" class="btn btn-default">Publish Selected</a>
                       </div>
                   </div>

                   <br>

                   <div>

                       <table class="table table-hover kroo_data_table">
                           <thead>
                               <tr>
                                   <th class="col-md-*"><input type="checkbox" class="checkall" />
                                       <input type="hidden" id="listCNT2" value="0">
                                       <input type="hidden" id="listTYPE2" autocomplete="off" value="">
                                   </th>
                                   <th class="col-md-*">League</th>
                                   <th class="col-md-8">Feeds</th>
                                   <th class="col-md-2 text-center">Actions</th>
                                   <th class="col-md-* text-right" style="padding-right:40px;"><span class="glyphicon glyphicon-flag" aria-hidden="true"></span></th>
                               </tr>
                           </thead> 
                           <tbody></tbody>   
                           </table>
                       </div>
               </div>

               <div role="tabpanel" class="tab-pane" id="article">

                   <div style="display:flex; padding-top:20px; padding-left:20px;" id="left_filters">
                       <div class="dropdown">
                           <button class="btn btn-default dropdown-toggle select_league_text" type="button" data-toggle="dropdown">Select League
                           <span class="caret"></span></button>
                           <?php
                               if(!empty($kroo_news['all_leagues'])){
                                   echo '<ul class="dropdown-menu">';
                                   echo '<li style="text-align:center"><a class="select_league" data-id="" data-name="All League" href="javascript:void(0);"><span>All League</span></a></li>';
                                    foreach($kroo_news['all_leagues'] as $news){
                                       echo '<li style="text-align:center"><a class="select_league" data-id="'.$news->id.'" data-name="'.$news->name.'" href="javascript:void(0);"><span>'.$news->name.'</span></a></li>';
                                   }
                                   echo '</ul>';
                               }
                           ?>
                      </div>

                      <div class="dropdown" style="padding-left:10px;">

                           <button class="btn btn-default dropdown-toggle select_news_type" type="button" data-toggle="dropdown">Select News
                           <span class="caret"></span></button>
                           <ul class="dropdown-menu">
                               <li style="text-align:center"><a class="get_publish" href="javascript:void(0);" data-id="2" data-name="All News">All News</a></li>
                               <li style="text-align:center"><a class="get_publish" href="javascript:void(0);" data-id="1" data-name="Published">Published</a></li>
                               <li style="text-align:center"><a class="get_publish" href="javascript:void(0);" data-id="0" data-name="Not Published">Not Published</a>
                               </li>
                               <li style="text-align:center"><a class="get_publish" id="notified_sort" href="javascript:void(0);" data-id="3" data-name="Notified">Notified</a></li>
                           </ul>

                      </div>

                       <div style="padding-left:10px;">
                           <form class="form-inline" id="headline_date_form">
                               <div class="form-group">
                                   <input type="text" class="form-control datepicker datepicker1" autocomplete="off" placeholder="From Date" id="datepicker1" name="datepicker1" />
                               </div>
                               <div class="form-group">
                                   <input type="text" class="form-control datepicker datepicker2" autocomplete="off" placeholder="To Date" id="datepicker2" name="datepicker2" />
                               </div>
                               <button id="btn_get_date" class="btn btn-default">Get News</button>
                           </form>
                       </div>

                        <div class="dropdown" style="padding-right:10px; float: right; margin-left:auto;">
                           <button class="btn btn-default btn-addplayer-news" data-toggle="modal" data-target="#myAddPlayerNewsModel" type="button">Add News</button>
                       </div>

                       <div class="dropdown" style="padding-right:10px; float: right;">
                           <button class="btn btn-default clr-fltr" type="button">Clear Filter</button>
                       </div>

                       <div style="padding-right:10px; float: right;">
                           <a href="javascript:void(0);" id="mass_publish" class="btn btn-default">Publish Selected</a>
                       </div>

                   </div>

                   <br>

                   <div>

                        <table class="table table-hover kroo_data_table">
                           <thead>
                               <tr>
                                   <th class="col-md-*"><input type="checkbox" class="checkall" />
                                       <input type="hidden" id="listCNT3" value="0">
                                       <input type="hidden" id="listTYPE3" autocomplete="off" value="">
                                   </th>
                                   <th class="col-md-*">League</th>
                                   <th class="col-md-8">Feeds</th>
                                   <th class="col-md-2 text-center">Actions</th>
                                   <th class="col-md-* text-right" style="padding-right:40px;"><span class="glyphicon glyphicon-flag" aria-hidden="true"></span></th>
                               </tr>
                           </thead> 
                           <tbody></tbody>   
                           </table>
                       </div>
               </div>

              <div role="tabpanel" class="tab-pane" id="krooCastVideo">

                   <div style="display:flex; padding-top:20px; padding-left:20px;" id="left_filters">
                       <div class="dropdown">
                           <button class="btn btn-default dropdown-toggle select_league_text" type="button" data-toggle="dropdown">Select League
                           <span class="caret"></span></button>
                           <?php
                               if(!empty($kroo_news['all_leagues'])){
                                   echo '<ul class="dropdown-menu">';
                                   echo '<li style="text-align:center"><a class="select_league" data-id="" data-name="All League" href="javascript:void(0);"><span>All League</span></a></li>';
                                   foreach($kroo_news['all_leagues'] as $news){
                                       echo '<li style="text-align:center"><a class="select_league" data-id="'.$news->id.'" data-name="'.$news->name.'" href="javascript:void(0);"><span>'.$news->name.'</span></a></li>';
                                   }
                                   echo '</ul>';
                               }
                           ?>
                       </div>

                       <div class="dropdown" style="padding-left:10px;">
                           <button class="btn btn-default dropdown-toggle select_team_text" type="button" data-toggle="dropdown">Select Team
                           <span class="caret"></span></button>
                           <ul class="dropdown-menu" id="select_team" style="height: auto; max-height: 500px; overflow-x:hidden; ">
                               <li style="text-align:center"><h4>Select League</h4></li>
                           </ul>
                       </div>                     
                      

                       <div class="dropdown" style="padding-left:10px;">

                           <button class="btn btn-default dropdown-toggle select_news_type" type="button" data-toggle="dropdown">Select News
                           <span class="caret"></span></button>
                           <ul class="dropdown-menu">
                               <li style="text-align:center"><a class="get_publish" href="javascript:void(0);" data-id="2" data-name="All News">All News</a></li>
                               <li style="text-align:center"><a class="get_publish" href="javascript:void(0);" data-id="1" data-name="Published">Published</a></li>
                               <li style="text-align:center"><a class="get_publish" href="javascript:void(0);" data-id="0" data-name="Not Published">Not Published</a>
                               </li>
                               <li style="text-align:center"><a class="get_publish" id="notified_sort" href="javascript:void(0);" data-id="3" data-name="Notified">Notified</a></li>
                           </ul>

                       </div>

                       <div style="padding-left:10px;">
                           <form class="form-inline" id="news_date_form">
                               <div class="form-group">
                                   <input type="text" class="form-control datepicker datepicker1" autocomplete="off" placeholder="From Date" id="datepicker1" name="datepicker1" />
                               </div>
                               <div class="form-group">
                                   <input type="text" class="form-control datepicker datepicker2" autocomplete="off" placeholder="To Date" id="datepicker2" name="datepicker2" />
                               </div>
                               <button id="btn_get_date" class="btn btn-default">Get News</button>
                           </form>
                       </div>

                       <div class="dropdown" style="padding-right:10px; float: right; margin-left:auto;">
                           
                       </div>

                       <div class="dropdown" style="padding-right:10px; float: right;">
                           <button class="btn btn-default clr-fltr" type="button">Clear Filter</button>
                       </div>

                       <div style="padding-right:10px; display:none; float: right;">
                           <a href="javascript:void(0);" id="mass_publish" class="btn btn-default">Publish Selected</a>
                       </div>

                        <div class="dropdown" style="padding-right:10px; float: right;">
                           <?php
                               if(!empty($channel2)){
                                   echo '<ul class="dropdown-menu">';
                                    foreach($channel2 as $row){
                                       echo '<li style="text-align:center"><a class="select_channel" data-id="'.$row['id'].'" data-name="'.$row['name'].'" href="javascript:void(0);"><span>'.$row['name'].'</span></a></li>';
                                   }
                                   echo '</ul>';
                               }
                           ?>
                       </div>



                   </div>

                   <br>

                   <div>

                       <table class="table table-hover kroo_data_table" id="kroo_team_news">
                           <thead>
                               <tr>
                                   <th class="col-md-*"><input type="checkbox" class="checkall" />
                                       <input type="hidden" id="listCNT4" value="0">
                                       <input type="hidden" id="listTYPE4" autocomplete="off" value="">
                                   </th>
                                   <th class="col-md-*">Team</th>
                                   <th class="col-md-8">Feeds</th>
                                   <th class="col-md-2 text-center">Actions</th>
                                   <th class="col-md-* text-right" style="padding-right:40px;"><span class="glyphicon glyphicon-flag" aria-hidden="true"></span></th>
                               </tr>
                           </thead> 
                           <tbody></tbody>   
                           </table>
                       </div>
               </div>

             </div>

       </div>

       <!-- <div class="footer-main load_image" style="margin:17px;">
          <img id="load_image" src="<?php //echo base_url()?>assets/preloader.gif" class="img-circle" alt="Load Image" /> 
       </div> -->
       <div class="footer-main" style="position: fixed;bottom: 0; width: 100%;">
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
            var myImgPath = (tab_index==3)?'<?php echo articleimage; ?>':'<?php echo newsimage; ?>';
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