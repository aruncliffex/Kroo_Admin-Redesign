
        <div class="wrapper row-offcanvas row-offcanvas-left">
            <aside><!-- <aside class="right-side"> -->

                <button onclick="goBack()" class="btn btn-default">
                    <i class="fa fa-arrow-left fa-lg"></i>
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
                                                <th class="col-md-1 ">Success</th>
                                                <th class="col-md-1 ">Failure</th>
                                                <th class="col-md-1 ">Copied</th>
                                                <th class="col-md-1">Total Urls</th>
                                                <th class="col-md-1 ">Type</th>
                                                <th class="col-md-1">Date</th>
                                                 
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php 
                                        if(!empty($info)){
                                            foreach($info as $user){

                                                    echo '<tr id="user_row_'.$user['id'].'">';
                                                        echo '<td class="col-md-1"><label class="checkbox"><input type="checkbox"></label></td>';
                                                       

                                                        echo '<td class="col-md-2 ">';
                                                            echo '<p>'.$user['success'].'</p>';    
                                                        echo '</td>';

                                                        echo '<td class="col-md-1 ">';
                                                            echo '<p>'.$user['failure'].'</p>';   
                                                        echo '</td>';

                                                        echo '<td class="col-md-1 ">';
                                                            echo '<p>'.$user['copied'].'</p>';   
                                                        echo '</td>';

                                                        echo '<td class="col-md-1 ">';
                                                            echo '<p>'.$user['totalUrls'].'</p>';   
                                                        echo '</td>';

                                                        echo '<td class="col-md-1 ">';
                                                            echo '<p>'.$user['type'].'</p>';   
                                                        echo '</td>';

                                                        echo '<td class="col-md-1 ">';
                                                            echo '<p>'.$user['date'].'</p>';   
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

               