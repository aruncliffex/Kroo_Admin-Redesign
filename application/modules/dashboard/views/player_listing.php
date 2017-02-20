<?php 
/*echo "Filter : <pre>";
print_r($flter);
echo '</pre>';*/
if(!empty($player_news)){
    $k=0;
    foreach($player_news as $news){
       

            if($news['rss_player_news_id'] && $news['player_is_deleted'] == 0){

                echo '<tr id="f_news_'.$news['rss_player_id'].'">';

                if($news['player_published_at'] != 0){
                    echo '<td ><label class="checkbox"><input type="checkbox" class="checkbox" /></label></td>';
                }else{
                    echo '<td ><label class="checkbox"><input name="locationthemes" type="checkbox" class="checkbox" value="'.$news['rss_player_id'].'" /></label></td>';
                }


                if(empty($news['league_logo'])){
                    echo '<td><a href="javascript:void(0);"><img style="width:45px;" class="media-object" src="'.ASSETS.'Artboard1.png"></a></td>';
                }else{
                    echo '<td><a href="javascript:void(0);"><img style="width:45px;" class="media-object" src="'.teamlogo.''.$news['league_logo'].'"> </a></td>';
                }

                echo '<td>';
                    echo '<div class="media">';
                        echo '<div class="pull-left">';
                            echo '<a href="javascript:void(0);">';

                             if($news['player_image'] == '' || $news['player_image'] == 'noimage'){
                                echo '<img data-id="'.$news['rss_player_id'].'" id="image_'.$news['rss_player_id'].'" class="media-object" style="width:120px;" src="'.ASSETS.'Artboard1.png">';
                                // echo '<p>'.$news['rss_league_name'].'</p>';
                            }                                                                        
                            else if(strpos($news['player_image'], 'www') !== false || strpos($news['player_image'], 'http') !== false){
                                echo '<img data-id="'.$news['rss_player_id'].'" id="image_'.$news['rss_player_id'].'" class="media-object" style="width:120px;" src="'.$news['player_image'].'">';
                                 //echo '<p>'.$news['rss_league_name'].'</p>';
                            }
                            else{
                                echo '<img data-id="'.$news['rss_player_id'].'" id="image_'.$news['rss_player_id'].'" class="media-object" style="width:120px;" src="'.newsimage.''.$news['player_image'].'">';
                                //echo '<p>'.$news['rss_league_name'].'</p>';                                                                           
                            }

                            echo '</a>';
                         echo '</div>';
                        echo '<div class="media-body">';
                            echo '<div style="display:flex;color:gray;font-size:11px;margin-bottom:-9px;"><p>'.$news['channel_name'].'</p>&nbsp;/&nbsp;<p id="kroo_news_at_'.$news['rss_player_id'].'">'.$news['rss_player_created_at'].'</p></div>'; 
                            echo '<h4 class="tControl" data-id="'.$news['rss_player_id'].'" id="title_read_news"><a data-id="'.$news['rss_player_id'].'" id="title_'.$news['rss_player_id'].'" href="'.$news['player_url'].'" target="_blank">'.$news['player_title'].'</a></h4>';


                            echo '<input type="hidden" id="rss_title_'.$news['rss_player_id'].'" value="'.$news['rss_player_title'].'">';
                            echo '<input type="hidden" id="rss_summary_'.$news['rss_player_id'].'" value="'.$news['rss_player_summary'].'">';
                            echo '<input type="hidden" id="rss_url_'.$news['rss_player_id'].'" value="'.$news['rss_player_url'].'">';
                            echo '<input type="hidden" id="rss_image_'.$news['rss_player_id'].'" value="'.$news['rss_player_image'].'">';

                            echo '<p data-id="'.$news['rss_player_id'].'" id="summary_'.$news['rss_player_id'].'"  class="tControl">'.$news['player_summary'].'</p>';

                            echo '<p style="color:gray;" id="news_source_'.$news['rss_player_id'].'">Source : '.$news['rss_player_source'].'</p>'; 

                            echo '<input type="hidden" id="rss_source_'.$news['rss_player_id'].'" value="'.$news['rss_player_source'].'">';

                            echo '<div style="display:inline; font-size:12px;" id="activity_detail_'.$news['rss_player_id'].'">';
                            if(isset($news['activity'])){
                            foreach($news['activity'] as $activity){
                                    if($activity['activity_action'] == 'edit'){
                                        echo '<p style="display:inline;"><b>Edited By</b> : '.$activity['activity_user'][0]['name'].'</p>';                                                                                
                                    }else if($activity['activity_action'] == 'publish'){
                                        echo '<p style="display:inline; margin-left:5px;"><b>Published By </b> : '.$activity['activity_user'][0]['name'].'</p>';
                                    }else if($activity['activity_action'] == 'notify'){
                                        echo '<p style="display:inline; margin-left:5px;"><b>Notified By </b>: '.$activity['activity_user'][0]['name'].'</p>';
                                    }else if($activity['activity_action'] == 'read'){
                                        echo '<p style="display:inline; margin-left:5px;"><b>Read By </b>: '.$activity['activity_user'][0]['name'].'</p>';
                                    }
                                }
                            }
                            echo '</div>';

                        echo '</div>';
                    echo '</div>';
                echo '</td>';
                echo '<td class="text-center">';
                    echo '<button data-id="'.$news['rss_player_id'].'" id="btn_edit_'.$news['rss_player_id'].'" data-toggle="tooltip" data-placement="top" title="Edit" type="button" class="btn btn-default btn-sm btn_edit_news">  <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></button>';

                    if($news['player_published_at'] == 0){
                       echo '<button data-id="'.$news['rss_player_id'].'" id="btn_publish_'.$news['rss_player_id'].'" data-toggle="tooltip" data-placement="top" title="Publish" type="button" class="btn btn-default btn-sm btn_publish_news">  <span class="glyphicon glyphicon-send notifi" aria-hidden="true" ></span></button>'; 
                    }
                    else{
                        echo '<button data-id="'.$news['rss_player_id'].'" id="btn_publish_'.$news['rss_player_id'].'" type="button" class="btn btn-default btn-sm btn_publish_news" disabled="disabled">  <span style="color:#6E6E6E;" class="glyphicon glyphicon-send notifi" aria-hidden="true" ></span></button>'; 
                    }

                    if($news['player_notified_at'] == 0){
                        // echo '<button data-id="'.$news['rss_player_id'].'" id="btn_notify_'.$news['rss_player_id'].'" data-toggle="tooltip" data-placement="top" title="Notify" type="button" class="btn btn-default btn-sm btn_notify_news">  <span class="glyphicon glyphicon-fire publis" aria-hidden="true"></span></button>';
                        echo    '<div class="dropdown">
                                <button type="button" onclick="myFunction(this)" class="btn btn-default btn-sm dropbtn"><span class="glyphicon glyphicon-fire publis" aria-hidden="true"></span></button>
                                  <div id="myDropdown" class="dropdown-content myDropdown">
                                    <a class="btn_notify_news" data-level="3" data-id="'.$news['rss_player_id'].'" id="btn_notify_'.$news['rss_player_id'].'" href="javascript:void(0);">Everything</a>
                                    <a class="btn_notify_news" data-level="2" data-id="'.$news['rss_player_id'].'" id="btn_notify_'.$news['rss_player_id'].'" href="javascript:void(0);">Featured</a>
                                    <a class="btn_notify_news" data-level="1" data-id="'.$news['rss_player_id'].'" id="btn_notify_'.$news['rss_player_id'].'" href="javascript:void(0);">Important</a>
                                  </div>
                                </div>';
                    }else{
                        echo '<button data-id="'.$news['rss_player_id'].'" id="btn_notify_'.$news['rss_player_id'].'" type="button" class="btn btn-default btn-sm btn_notify_news" disabled="disabled">  <span style="color:#6E6E6E;" class="glyphicon glyphicon-fire publis" aria-hidden="true"></span></button>';
                    }

                    if($this->session->userdata('is_admin')=='admin'){
                        echo '<button data-id="'.$news['rss_player_id'].'" id="btn_hide_'.$news['rss_player_id'].'" data-toggle="tooltip" data-placement="top" title="Delete" type="button" class="btn btn-default btn-sm btn_hide_news">  <span class="glyphicon glyphicon-remove red" aria-hidden="true"></span></button>';
                    }

                echo '</td>';
                echo '<td class="text-right">';
                    if($news['player_edited_by_admin_id'] != 0){
                        echo '<span style="color:#5F6B76;" class="glyphicon glyphicon-ok-sign blue" id="hide_edited_news_'.$news['rss_player_id'].'" aria-hidden="true"></span>&nbsp;';    
                    }
                    echo '<span style="color:#5F6B76; display:none" id="edited_news_'.$news['rss_player_id'].'"  class="glyphicon glyphicon-ok-sign blue" aria-hidden="true"></span>&nbsp;';    

                    if($news['player_published_at'] != 0){
                        echo '<span style="color:#7266BA;" class="glyphicon glyphicon-ok-sign blue" aria-hidden="true"></span>&nbsp;';
                    }
                    echo '<span style="color:#7266BA;display:none" id="publish_news_'.$news['rss_player_id'].'" class="glyphicon glyphicon-ok-sign blue" aria-hidden="true"></span>&nbsp;';

                    if($news['player_notified_at'] != 0){
                        echo '<span class="glyphicon glyphicon-ok-sign blue" aria-hidden="true"></span>&nbsp;';
                    }
                    echo '<span style="display:none;" id="notify_news_'.$news['rss_player_id'].'" class="glyphicon glyphicon-ok-sign blue" aria-hidden="true"></span>&nbsp;';


                echo '</td>';

                echo '</tr>';

                $last_news_at = $news['rss_player_created_at'];
                $last_news_id = $news['rss_player_id'];
            }
            else if($news['rss_player_is_deleted'] == 0)
            {

                echo '<tr id="f_news_'.$news['rss_player_id'].'">';

                if($news['player_published_at']){
                    echo '<td ><label class="checkbox"><input type="checkbox" class="checkbox" /></label></td>';
                }else{
                    echo '<td ><label class="checkbox"><input name="locationthemes" type="checkbox" class="checkbox" value="'.$news['rss_player_id'].'" /></label></td>';
                }


                if(empty($news['league_logo'])){
                    echo '<td><a href="javascript:void(0);"><img style="width:45px;" class="media-object" src="'.ASSETS.'Artboard1.png"></a></td>';
                }else{
                    echo '<td><a href="javascript:void(0);"><img style="width:45px;" class="media-object" src="'.teamlogo.''.$news['league_logo'].'"></a></td>';
                }

                echo '<td>';
                    echo '<div class="media">';
                        echo '<div class="pull-left">';
                            echo '<a href="javascript:void(0);">';

                            if($news['rss_player_image'] == '' || $news['rss_player_image'] == 'noimage'){
                                echo '<img data-id="'.$news['rss_player_id'].'" id="image_'.$news['rss_player_id'].'" class="media-object" style="width:120px;" src="'.ASSETS.'Artboard1.png">';
                                //echo '<p>'.$news['rss_league_name'].'<br>'.$news['rss_team_name'].'</p>';
                            }                                                                        
                            else if(strpos($news['rss_player_image'], 'www') !== false || strpos($news['rss_player_image'], 'http') !== false){
                                echo '<img data-id="'.$news['rss_player_id'].'" id="image_'.$news['rss_player_id'].'" class="media-object" style="width:120px;" src="'.$news['rss_player_image'].'">';
                                //echo '<p>'.$news['rss_league_name'].'<br>'.$news['rss_team_name'].'</p>';
                            }
                            else{
                                echo '<img data-id="'.$news['rss_player_id'].'" id="image_'.$news['rss_player_id'].'" class="media-object" style="width:120px;" src="'.newsimage.''.$news['rss_player_image'].'">';
                                //echo '<p>'.$news['rss_league_name'].'<br>'.$news['rss_team_name'].'</p>';
                            }

                            echo '</a>';
                         echo '</div>';
                        echo '<div class="media-body">';
                            echo '<div style="display:flex;color:gray;font-size:11px;margin-bottom:-9px;"><p>'.$news['channel_name'].'</p>&nbsp;/&nbsp;<p id="kroo_news_at_'.$news['rss_player_id'].'">'.$news['rss_player_created_at'].'</p></div>'; 
                            echo '<input type="hidden" id="rss_title_'.$news['rss_player_id'].'" value="'.$news['rss_player_title'].'">';
                            echo '<h4 class="tControl" data-id="'.$news['rss_player_id'].'" id="title_read_news"><a data-id="'.$news['rss_player_id'].'" id="title_'.$news['rss_player_id'].'" href="'.$news['rss_player_url'].'" target="_blank">'.$news['rss_player_title'].'</a></h4>';
                            echo '<p data-id="'.$news['rss_player_id'].'" id="summary_'.$news['rss_player_id'].'"  class="tControl">'.$news['rss_player_summary'].'</p>';


                            echo '<input type="hidden" id="rss_summary_'.$news['rss_player_id'].'" value="'.$news['rss_player_summary'].'">';
                            echo '<input type="hidden" id="rss_url_'.$news['rss_player_id'].'" value="'.$news['rss_player_url'].'">';
                            echo '<input type="hidden" id="rss_image_'.$news['rss_player_id'].'" value="'.$news['rss_player_image'].'">';

                            echo '<p style="color:gray;" id="news_source_'.$news['rss_player_id'].'">Source : '.$news['rss_player_source'].'</p>'; 
                            
                            echo '<input type="hidden" id="rss_source_'.$news['rss_player_id'].'" value="'.$news['rss_player_source'].'">';

                             echo '<div style="display:inline; font-size:12px;" id="activity_detail_'.$news['rss_player_id'].'">';
                            if(isset($news['activity'])){
                                foreach($news['activity'] as $activity){
                                        if($activity['activity_action'] == 'edit'){
                                            echo '<p style="display:inline;"><b>Edited By</b> : '.$activity['activity_user'][0]['name'].'</p>';                                                                                
                                        }else if($activity['activity_action'] == 'publish'){
                                            echo '<p style="display:inline; margin-left:5px;"><b>Published By </b> : '.$activity['activity_user'][0]['name'].'</p>';
                                        }else if($activity['activity_action'] == 'notify'){
                                            echo '<p style="display:inline; margin-left:5px;"><b>Notified By </b>: '.$activity['activity_user'][0]['name'].'</p>';
                                        }else if($activity['activity_action'] == 'read'){
                                            echo '<p style="display:inline; margin-left:5px;"><b>Read By </b>: '.$activity['activity_user'][0]['name'].'</p>';
                                        }                                                                     
                                    }
                            }
                            echo '</div>';

                        echo '</div>';
                    echo '</div>';
                echo '</td>';
                echo '<td class="text-center">';
                    echo '<button data-id="'.$news['rss_player_id'].'" id="btn_edit_'.$news['rss_player_id'].'" data-toggle="tooltip" data-placement="top" title="Edit" type="button" class="btn btn-default btn-sm btn_edit_news">  <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></button>';

                    if(!$news['player_published_at']){
                       echo '<button data-id="'.$news['rss_player_id'].'" id="btn_publish_'.$news['rss_player_id'].'" data-toggle="tooltip" data-placement="top" title="Publish" type="button" class="btn btn-default btn-sm btn_publish_news">  <span class="glyphicon glyphicon-send notifi" aria-hidden="true" ></span></button>'; 
                    }
                    else{
                        echo '<button data-id="'.$news['rss_player_id'].'" id="btn_publish_'.$news['rss_player_id'].'" type="button" class="btn btn-default btn-sm btn_publish_news" disabled="disabled">  <span style="color:#6E6E6E;" class="glyphicon glyphicon-send notifi" aria-hidden="true" ></span></button>'; 
                    }

                    if(!$news['player_notified_at']){
                        // echo '<button data-id="'.$news['rss_player_id'].'" id="btn_notify_'.$news['rss_player_id'].'" data-toggle="tooltip" data-placement="top" title="Notify" type="button" class="btn btn-default btn-sm btn_notify_news">  <span class="glyphicon glyphicon-fire publis" aria-hidden="true"></span></button>';
                         echo    '<div class="dropdown">
                                <button type="button" onclick="myFunction(this)" class="btn btn-default btn-sm dropbtn"><span class="glyphicon glyphicon-fire publis" aria-hidden="true"></span></button>
                                  <div id="myDropdown" class="dropdown-content myDropdown">
                                    <a class="btn_notify_news" data-level="3" data-id="'.$news['rss_player_id'].'" id="btn_notify_'.$news['rss_player_id'].'" href="javascript:void(0);">Everything</a>
                                    <a class="btn_notify_news" data-level="2" data-id="'.$news['rss_player_id'].'" id="btn_notify_'.$news['rss_player_id'].'" href="javascript:void(0);">Featured</a>
                                    <a class="btn_notify_news" data-level="1" data-id="'.$news['rss_player_id'].'" id="btn_notify_'.$news['rss_player_id'].'" href="javascript:void(0);">Important</a>
                                  </div>
                                </div>';
                    }
                    else{
                        echo '<button data-id="'.$news['rss_player_id'].'" id="btn_notify_'.$news['rss_player_id'].'" type="button" class="btn btn-default btn-sm btn_notify_news" disabled="disabled">  <span style="color:#6E6E6E;" class="glyphicon glyphicon-fire publis" aria-hidden="true"></span></button>';
                    }

                    if($this->session->userdata('is_admin')=='admin'){
                        echo '<button data-id="'.$news['rss_player_id'].'" id="btn_hide_'.$news['rss_player_id'].'" data-toggle="tooltip" data-placement="top" title="Delete" type="button" class="btn btn-default btn-sm btn_hide_news">  <span class="glyphicon glyphicon-remove red" aria-hidden="true"></span></button>';
                    }

                echo '</td>';
                echo '<td class="text-right">';
                    if($news['player_edited_by_admin_id']){
                        echo '<span style="color:#5F6B76;" class="glyphicon glyphicon-ok-sign blue" id="hide_edited_news_'.$news['rss_player_id'].'" aria-hidden="true"></span>&nbsp;';    
                    }
                    echo '<span style="color:#5F6B76; display:none" id="edited_news_'.$news['rss_player_id'].'"  class="glyphicon glyphicon-ok-sign blue" aria-hidden="true"></span>&nbsp;';    

                    if($news['player_published_at']){
                        echo '<span style="color:#7266BA;" class="glyphicon glyphicon-ok-sign blue" aria-hidden="true"></span>&nbsp;';
                    }
                    echo '<span style="color:#7266BA;display:none" id="publish_news_'.$news['rss_player_id'].'" class="glyphicon glyphicon-ok-sign blue" aria-hidden="true"></span>&nbsp;';

                    if($news['player_notified_at']){
                        echo '<span class="glyphicon glyphicon-ok-sign blue" aria-hidden="true"></span>&nbsp;';
                    }
                    echo '<span style="display:none;" id="notify_news_'.$news['rss_player_id'].'" class="glyphicon glyphicon-ok-sign blue" aria-hidden="true"></span>&nbsp;';


                echo '</td>';

                echo '</tr>';

                $last_news_at = $news['rss_player_created_at'];
                $last_news_id = $news['rss_player_id'];

            }
        

    $k++;
    }
}


?>