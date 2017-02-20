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

                <button style="margin-left:-40px;" onclick="goBack()" class="btn btn-default">
                    <i class="fa fa-arrow-left fa-lg"></i>
                </button>

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
                                            <th class="col-md-5 ">Url<span class="glyphicon glyphicon-asterisk" aria-hidden="true"></span></th>
                                            <th class="col-md-4 ">Parent Url</th>
                                            <th class="col-md-1 ">Url Type</th>
                                            <th class="col-md-1">Failure Dates</th>
                                             
                                        </tr>
                                       </thead>
                                       <tbody>
                                        <?php 
                                        if(!empty($info)){
                                            foreach($info as $user){

                                                    echo '<tr id="user_row_'.$user['url_id'].'">';
                                                        echo '<td class="col-md-2 ">';
                                                            echo '<p>'.$user['url'].'</p>';    
                                                        echo '</td>';

                                                        echo '<td class="col-md-1 ">';
                                                            echo '<p>'.$user['parent_url'].'</p>';   
                                                        echo '</td>';

                                                        echo '<td class="col-md-1 ">';
                                                            echo '<p>'.$user['url_type'].'</p>';   
                                                        echo '</td>';

                                                        echo '<td class="col-md-1 ">';
                                                            echo '<p>'.$user['failure_date'].'</p>';   
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
                <div class="footer-main" style="bottom: 0; position: fixed; width: 100%;">
                    Copyright &copy Kroo, 2015
                </div>
            </aside><!-- /.right-side -->

           

        </div><!-- ./wrapper -->