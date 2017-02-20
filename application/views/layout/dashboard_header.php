<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Kroo Admin</title>
        <link rel="icon" type="image/png" sizes="16x16" href="<?php echo ASSETS?>favicon.ico">

        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <meta name="description" content="Developed By M Abdur Rokib Promy">
        <meta name="keywords" content="Admin, Bootstrap 3, Template, Theme, Responsive">
        <!-- bootstrap 3.0.2 -->
        <link href="<?php echo ASSETS?>css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- font Awesome -->
        <link href="<?php echo ASSETS?>css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!-- Ionicons -->
        <link href="<?php echo ASSETS?>css/ionicons.min.css" rel="stylesheet" type="text/css" />
        <!-- google font -->
        <link href='http://fonts.googleapis.com/css?family=Lato' rel='stylesheet' type='text/css'>
        <!-- Theme style -->
        <link href="<?php echo ASSETS?>css/style.css" rel="stylesheet" type="text/css" />

        <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.min.css">

         <link href="<?php echo ASSETS?>css/imgareaselect-default.css" rel="stylesheet" type="text/css" />
         <!-- <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script> -->
         <script type="text/javascript" src="<?php echo ASSETS?>js/jquery-2.0.2.min.js"></script>
         <script> var SITEURL='<?php echo SITEURL; ?>'; var teamlogo='<?php echo teamlogo; ?>'; var ASSETS='<?php echo ASSETS; ?>';</script>

        
    </head>
    <body class="skin-black">
        <!-- header logo: style can be found in header.less -->
        
        <header class="header" style="position:fixed;">
           
            <nav class="navbar navbar-static-top" role="navigation" style="background-color:#1967F7; margin-left:0px;">
                <a class="navbar-brand" href="<?php echo SITEURL ?>">
                    <img alt="Brand" src="<?php echo SITEURL?>assets/logo.png"> 
                </a>

                 <!-- Sidebar toggle button-->
               
                <div class="navbar-right">
                   <ul class="nav navbar-nav">
                        <!-- Messages: style can be found in dropdown.less-->

                        <li class="user user-menu">

                            <a href="<?php echo SITEURL ?>game">                                
                                <span style="color:white;">Game</span>
                            </a>
                        </li>                        


                         <li class="user user-menu">

                            <a href="<?php echo SITEURL ?>game/game_store">                                
                                <span style="color:white;">Store</span>
                            </a>
                        </li>  


                         <li class="user user-menu">

                            <a href="<?php echo SITEURL ?>activitycredits">                                
                                <span style="color:white;">Users Level</span>
                            </a>
                        </li>  


                         <li class="user user-menu">

                            <a href="<?php echo SITEURL ?>game/tickets">                                
                                <span style="color:white;">Users Tickets</span>
                            </a>
                        </li>                        

                         <li class="user user-menu">

                            <a href="<?php echo SITEURL ?>sponser">                                
                                <span style="color:white;">Sponsor</span>
                            </a>
                        </li>                        


                         <li class="user user-menu">

                            <a href="<?php echo SITEURL ?>stats/news_stats">                                
                                <span style="color:white;">News Stats</span>
                            </a>
                        </li>
                        
                        <!-- User Account: style can be found in dropdown.less -->
                        <li class="dropdown user user-menu">

                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-user"></i>
                                <span style="color:white;"><?php echo $this->session->userdata('name'); ?> <i class="caret"></i></span>
                            </a>
                                <ul class="dropdown-menu dropdown-custom dropdown-menu-right" style="margin-top:55px;">
                                        <li class="dropdown-header text-center">Account</li>

                                        <li>
                                             <?php 
                                                if($this->session->userdata('is_admin')=='admin'){
                                                    echo '<a class="popUpC" href="'.SITEURL.'users"><i class="fa fa-user fa-fw pull-right"></i>Users</a>';
                                                }
                                            
                                            ?>
                                            <?php
                                                $myId = $this->session->userdata('id'); 
                                            ?>
                                            <a class="popUpC" href="<?php echo SITEURL ?>users/profile/<?php echo $myId; ?>"><i class="fa fa-user fa-fw pull-right"></i>Profile</a>
                                             <a class="popUpC" data-toggle="modal" href="<?php echo SITEURL ?>stats/index"><i class="fa fa-cog fa-fw pull-right"></i>Crone Stats</a>
                                              <a class="popUpC" data-toggle="modal" href="<?php echo SITEURL ?>stats/url"><i class="fa fa-cog fa-fw pull-right"></i>Failure URL's</a>
<!--                                            <a class="popUpC" data-toggle="modal" href="<?php echo SITEURL ?>settings"><i class="fa fa-cog fa-fw pull-right"></i>Settings</a>-->
                                        </li>

                                        <li class="divider"></li>

                                        <li>
                                            <a class="popUpC" href="<?php echo SITEURL ?>home/logout"><i class="fa fa-ban fa-fw pull-right"></i> Logout</a>
                                        </li>
                                </ul>

                        </li>
                    </ul>
                </div>
            </nav>
        </header>