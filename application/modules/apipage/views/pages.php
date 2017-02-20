<!DOCTYPE html>
<html class="full" lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="#">
    <meta name="author" content="<?php echo $content['author']; ?>">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo ASSETS?>favicon.ico">


    <title><?php echo $content['title']; ?></title>

    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    
    <link href="<?php echo SITEURL?>assets/css/bootstrap.min.css" rel="stylesheet">
    <style type="text/css">
        @media (max-width:767px) { img{ height: auto; max-width: 100%; } }
        /*.sources{ width: 100%;  float: none; text-align: left; font-size:11px; line-height: 16px; padding: 10px 0; color:#777; font-weight: bold;
         }
        .sources ul{ padding: 0px; }
        .sources ul li{ list-style: none; text-align: left; }
        .heading{ padding: 5px; border-bottom: 1px solid #E8E8E8; margin-bottom: 20px;}*/
        h1{
       font-family: georgia;
       font-size: 1.6em;
       color: #000;
       padding-top: 15px;
       padding-left: 10px;
       padding-right:10px;
       padding-bottom: 10px;
       margin: 0;
       line-height: 1.1em;
     }
     h2{
       font-family: Arial;
       font-size: 1.5em;
       color: #000;
       line-height: 1.2em;
       padding-left: 10px;
       padding-right: 10px;
       padding-bottom: 15px;
       margin: 0;
       color: #616161 ;
     }
     .news-details img{
       margin: 20px 0;
     }
     .news-details{
       font-family: georgia;
       font-size: 1.1em;
       line-height: 1.5em;
       padding: 10px;
     }

     img.title_img{
       width: 100%;
     }
     .sources{
       color: #757575 ;
       margin: 0;
       font-family: sans-serif;
       text-transform: uppercase;
       font-size: .7em;
     }

     .sources ul{
       padding-left: 10px;
     }
     .sources ul li{
       list-style: none;
       padding-bottom: 3px;
     }
     a{
       font-style: italic;
     }
    </style>
       
  </head>

  <body>
        <div>
          <?php if($content['image']!=''){ ?>
          <img src="<?php echo S3_PATH. $folder . $content['image']; ?>" class="title_img">
          <?php } ?>
          <h1><?php echo $content['title']; ?></h1>
          <!-- <h2><?php //echo $content['summary']; ?></h2> -->
          <div class="sources">
              <ul>
                <?php $ch=explode('_',$content['channel_value']); 
                $channel='';
                $len = count($ch);
                $i=0;
                foreach($ch as $value){ $i++;
                  if($i < $len && $value!='team' && $value!='teams'){
                    $channel.=$value.' ';
                  }
                }
                ?>
                <?php echo ($channel)?'<li>Source : '. strtoupper($channel) .'</li>':''; ?>
                <?php echo ($content['author'])?'<li>Author : '.$content['author'] .'</li>':''; ?>
                <li>Date : <?php echo date('h:i A / d F Y',$content['channel_published_at']); ?></li>
              </ul>  
          </div>
        </div>
        <hr>
        <div class="news-details">
          <?php echo $content['details']; ?>
        </div>
        <hr>
        <p style="text-align:right; margin-right:3px; font-size:0.7em; font-color:#757575;"><?php echo ($channel)?'Source : '. strtoupper($channel) :''; ?></p>
        <br><br>&nbsp;
  </body>
  <script src="<?php echo ASSETS; ?>js/jquery.min.js" type="text/javascript"></script>
  <script type="text/javascript">
  $(document).ready(function(){
    var img=$('.title_img').attr('src');
    var filename = img.match(/.*\/(.*)$/)[1];
    //alert(filename);
    if(img!=null){
      $('.news-details img').each(function(k,v){
        thisimg = $(this).attr('src');
        //alert(thisimg + '/' + filename + '/' + thisimg.indexOf(filename));
        if(thisimg.indexOf(filename)!=-1){
          $(this).remove();
        }
      });
    }
  });
  </script>
</html>


