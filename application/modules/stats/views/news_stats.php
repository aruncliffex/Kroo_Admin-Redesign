
        <header class="header" style="background-color: #f0f3f4;margin-top: 50px;position: sticky;">
            
        </header>

        <div class="wrapper row-offcanvas row-offcanvas-left">
                   
            <aside class="right-side strech" style="margin-top: 0px;">

                <div style="margin-left:17px; margin-right:17px; padding-bottom: 35px;">

  
                      <ul class="nav nav-tabs" role="tablist" id="news_tab">
                        <li role="presentation" class="active"><a href="#kroo" aria-controls="kroo" role="tab" data-toggle="tab"><span style="font-size:12px;"><b>KROO CAST</b></span></a></li>
                         <li role="presentation"><a href="#headlines" aria-controls="kroo" role="tab" data-toggle="tab"><span style="font-size:12px;"><b>HEADLINES</b></span></a></li>
                        <li role="presentation"><a href="#fantasy" aria-controls="fantasy" role="tab" data-toggle="tab"><span style="font-size:12px;"><b>FANTASY CAST</b></span></a></li> 
                        <li role="presentation"><a href="#article" aria-controls="article" role="tab" data-toggle="tab"><span style="font-size:12px;"><b>WAIVER NEWS</b></span></a></li> 
                       
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
                                        if(!empty($leagues['all_leagues'])){
                                            echo '<ul class="dropdown-menu">';
                                            echo '<li style="text-align:center"><a class="select_league" data-id="" data-name="All League" href="javascript:void(0);"><span>All League</span></a></li>';                                            
                                             foreach($leagues['all_leagues'] as $news){
                                                echo '<li style="text-align:center"><a class="select_league" data-id="'.$news->id.'" data-name="'.$news->name.'" href="javascript:void(0);"><span>'.$news->name.'</span></a></li>';
                                            }
                                            echo '</ul>';
                                        }
                                    ?>
                                </div>

                                
                                 <div style="padding-left:10px;">
                                       <form class="form-inline" id="news_date_form">
                                           <div class="form-group">
                                               <input type="text" class="form-control datepicker datepicker1" autocomplete="off" placeholder="From Date" id="datepicker1" name="datepicker1" />
                                           </div>
                                           
                                           <button id="btn_get_date" class="btn btn-default">Get News</button>
                                       </form>
                                </div>
                                <div style="padding-left:10px;" class="cronReports"> </div>
                                <div style="padding-left:10px;" class="cronReportsToday"> </div>
                                <div class="dropdown" style="padding-right:10px; float: right; margin-left:auto;">
                                    <button class="btn btn-default clr-fltr" type="button">Clear Filter</button>
                                </div>
                               
                            </div>

                            <br>
                               
                            <div>

                                 <table class="table table-bordered table-striped example12 kroo_data_table">
                                     <thead>
                                        <tr>
                                            
                                            <th class="col-md-3 ">League</th>
                                            <th class="col-md-3 ">Team</th>
                                            <th class="col-md-3 ">Date</th>
                                            <th class="col-md-3">Count</th>
                                             
                                        </tr>       
                                    </thead>
                                    <tbody>
                                        
                                    </tbody>    
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
                                        if(!empty($leagues['all_leagues'])){
                                            echo '<ul class="dropdown-menu">';
                                            echo '<li style="text-align:center"><a class="select_league" data-id="" data-name="All League" href="javascript:void(0);"><span>All League</span></a></li>';                                            
                                             foreach($leagues['all_leagues'] as $news){
                                                echo '<li style="text-align:center"><a class="select_league" data-id="'.$news->id.'" data-name="'.$news->name.'" href="javascript:void(0);"><span>'.$news->name.'</span></a></li>';
                                            }
                                            echo '</ul>';
                                        }
                                    ?>
                                </div>
                                
                                <div style="padding-left:10px;">
                                    <form class="form-inline" id="headline_date_form">
                                        <div class="form-group">
                                            <input type="text" class="form-control datepicker datepicker1" autocomplete="off" placeholder="From Date" id="datepicker1" name="datepicker1" />
                                        </div>

                                        <button id="btn_get_date" class="btn btn-default">Get News</button>
                                    </form>
                                </div>     
                                <div style="padding-left:10px;" class="cronReports"> </div>
                                <div style="padding-left:10px;" class="cronReportsToday"> </div>
                                <div class="dropdown" style="padding-right:10px; float: right; margin-left:auto;">
                                    <button class="btn btn-default clr-fltr" type="button">Clear Filter</button>
                                </div>

                            </div>

                            <br>
                               
                            <div>

                                 <table class="table table-bordered table-striped example12 kroo_data_table">
                                     <thead>
                                        <tr>
                                            
                                            <th class="col-md-5 ">League</th>
                                            <th class="col-md-4 ">Team</th>
                                            <th class="col-md-1 ">Date</th>
                                            <th class="col-md-1">Count</th>
                                             
                                        </tr>       
                                    </thead>
                                    <tbody>
                                        
                                    </tbody>    
                                    </table>
                                </div>
                        </div>


                        



                        <div role="tabpanel" class="tab-pane" id="fantasy">

                            <div style="display:flex; padding-top:20px; padding-left:20px;" id="left_filters">


                                <div class="dropdown">
                                    <button class="btn btn-default dropdown-toggle select_league_text" type="button" data-toggle="dropdown">Select League
                                    <span class="caret"></span></button>
                                    <?php
                                        if(!empty($leagues['all_leagues'])){
                                            echo '<ul class="dropdown-menu">';
                                            echo '<li style="text-align:center"><a class="select_league" data-id="" data-name="All League" href="javascript:void(0);"><span>All League</span></a></li>';                                            
                                             foreach($leagues['all_leagues'] as $news){
                                                echo '<li style="text-align:center"><a class="select_league" data-id="'.$news->id.'" data-name="'.$news->name.'" href="javascript:void(0);"><span>'.$news->name.'</span></a></li>';
                                            }
                                            echo '</ul>';
                                        }
                                    ?>
                                </div>

                               
                                
                               

                                <div style="padding-left:10px;">
                                   <form class="form-inline" id="news_date_form">
                                       <div class="form-group">
                                           <input type="text" class="form-control datepicker datepicker1" autocomplete="off" placeholder="From Date" id="datepicker1" name="datepicker1" />
                                       </div>
                                       
                                       <button id="btn_get_date" class="btn btn-default">Get News</button>
                                   </form>
                                </div>
                                <div style="padding-left:10px;" class="cronReports"> </div>
                                <div style="padding-left:10px;" class="cronReportsToday"> </div>
                                <div class="dropdown" style="padding-right:10px; float: right; margin-left:auto;">
                                    <button class="btn btn-default clr-fltr" type="button">Clear Filter</button>
                                </div>
                            </div>

                            <br>
                               
                            <div>

                               <table class="table table-bordered table-striped example12 kroo_data_table">
                                     <thead>
                                        <tr>
                                            
                                            <th class="col-md-5 ">League</th>
                                            <th class="col-md-4 ">Team</th>
                                            <th class="col-md-1 ">Date</th>
                                            <th class="col-md-1">Count</th>
                                             
                                        </tr>       
                                    </thead>
                                    <tbody>
                                        
                                    </tbody>    
                                    </table>
                                </div>
                        </div>



                        <div role="tabpanel" class="tab-pane" id="article">

                            <div style="display:flex; padding-top:20px; padding-left:20px;" id="left_filters">


                                <div class="dropdown">
                                    <button class="btn btn-default dropdown-toggle select_league_text" type="button" data-toggle="dropdown">Select League
                                    <span class="caret"></span></button>
                                    <?php
                                        if(!empty($leagues['all_leagues'])){
                                            echo '<ul class="dropdown-menu">';
                                            echo '<li style="text-align:center"><a class="select_league" data-id="" data-name="All League" href="javascript:void(0);"><span>All League</span></a></li>';                                            
                                             foreach($leagues['all_leagues'] as $news){
                                                echo '<li style="text-align:center"><a class="select_league" data-id="'.$news->id.'" data-name="'.$news->name.'" href="javascript:void(0);"><span>'.$news->name.'</span></a></li>';
                                            }
                                            echo '</ul>';
                                        }
                                    ?>
                                </div>
                                
                                <div style="padding-left:10px;">
                                    <form class="form-inline" id="headline_date_form">
                                        <div class="form-group">
                                            <input type="text" class="form-control datepicker datepicker1" autocomplete="off" placeholder="From Date" id="datepicker1" name="datepicker1" />
                                        </div>

                                        <button id="btn_get_date" class="btn btn-default">Get News</button>
                                    </form>
                                </div>     
                                <div style="padding-left:10px;" class="cronReports"> </div>
                                <div style="padding-left:10px;" class="cronReportsToday"> </div>
                                <div class="dropdown" style="padding-right:10px; float: right; margin-left:auto;">
                                    <button class="btn btn-default clr-fltr" type="button">Clear Filter</button>
                                </div>
                            </div>

                            <br>
                               
                            <div>

                                   <table class="table table-bordered table-striped example12 kroo_data_table">
                                     <thead>
                                        <tr>
                                            
                                            <th class="col-md-5 ">League</th>
                                            <th class="col-md-4 ">Team</th>
                                            <th class="col-md-1 ">Date</th>
                                            <th class="col-md-1">Count</th>
                                             
                                        </tr>       
                                    </thead>
                                    <tbody>
                                        
                                    </tbody>    
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



        <script>
            $(document).ready(function () {
                // Load listing first time
                getList('',0,0); //KROO CAST
                getList('',1,0); //headlines 
                getList('',3,0);
                getList('',2,0);



                $('.clr-fltr').on('click',function(){
                    var tab_index = $('.nav-tabs > li.active').index();
                    setCookie('statsFLTR', '', '-5', tab_index);
                    location.reload(); 
                });

            });
        </script>
