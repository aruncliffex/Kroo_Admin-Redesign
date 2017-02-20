 <?php 
    if(!empty($result)){
        foreach($result as $user){

            echo '<tr id="user_row_'.$user['id'].'">';                    


            echo '<td class="col-md-2 ">';
                if($user['league_logo']!='')
                    echo '<a href="javascript:void(0);"><img style="width:45px;" class="media-object" src="'.teamlogo.''.$user['league_logo'].'"> </a>';   
                else
                    echo '<p>&nbsp;</p>';
                   
            echo '</td>';

            echo '<td class="col-md-1 ">';
                if($user['team_logo']!='')
                    echo '<p><img style="width:45px;" class="media-object" src="'.teamlogo.''.$user['team_logo'].'"> '.$user['team_name'].'</p>';   
                else
                    echo '<p>&nbsp;</p>';
            echo '</td>';

            echo '<td class="col-md-1 ">';
                echo '<p>'.$user['channel_date'].'</p>';   
            echo '</td>';

            echo '<td class="col-md-1 ">';
                echo '<p>'.$user['count'].'</p>';   
            echo '</td>';
            echo '</tr>';
        }
    }
?>