
$( function() {
  var dateToday = new Date();  
    $( "#datepicker" ).datepicker({
        format: 'LT',
        minDate: dateToday 
    });

    $('#datetimepicker3').datetimepicker({
      format: 'LT',
      minDate: moment()
    });

    $('#select_game_category').on('change',function(){
        if($(this).val()=='1'){
            //$('#difficulty_block').css({'display':'block'});
            $('#ques_hint').css({'display':'block'});
        }else{
            //$('#difficulty_block').css({'display':'none'});
            $('#ques_hint').css({'display':'none'});
        }
    });

  });


  function goBack() {
      window.history.back();
  }

  $(document).on("click","#submit_form ,#submit_publish_form ,#submit_now_form",function(e){
    var game_type = $('select[name="select_game_category"]').val();
    var publish_id = $( this ).val();
    $('#publish_id').val(publish_id);
    if(publish_id==2 || publish_id==3){
      $('#message_success_publish').css({'display':''});
      $('#message_success_publish').delay(3000).fadeOut(400);
    }

    var id       = $('#gameid').val();
    var credits  = $('#credits').val();
    var creditsNum= $.isNumeric($('#credits').val()); 
    var duration = $('#duration').val();
    var qustion = $('#question').val();
    var ansTxtOpt1 = $('#ansTxtOpt1').val();
    var ansTxtOpt2 = $('#ansTxtOpt2').val();
    var ansTxtOpt3 = $('#ansTxtOpt3').val();
    var ansTxtOpt4 = $('#ansTxtOpt4').val();
    var option1 = $('#option1').val(); 
    var option2 = $('#option2').val();
    var option3 = $('#option3').val();
    var option4 = $('#option4').val();
    var link = $('#linkid').val();
    var explanation = $('#explanation_answer').val();  
    var news_leagues = $('.news_leagues').val();  
    var news_team = $('#add_news_team').val();
    //var TTL_hour = $('#TTL-hour').val(); 
    //var TTL_min = $('#TTL-min').val(); 
    var TTA_sec = $('#TTA-sec').val();
    //var publishdate = $('#datepicker').val();
    //var publishtime = $('#datetimepicker3').val();
    var radiobtn_check_one=$('#option1').is(':checked');  
    var radiobtn_check_two=$('#option2').is(':checked');
    var radiobtn_check_three=$('#option3').is(':checked');
    var radiobtn_check_four=$('#option4').is(':checked');        
    /*var game_cat = $('#select_game_category').val();
    var game_difficulty = $('#select_difficulty').val();      
    alert(game_cat + '/' + game_difficulty);*/
    //return false;
    var radiobtn_check=$("input[name='optradio']:checked").length; 

    if(qustion ==0 || qustion==""){ 
          alert("fill question");
    }else if ((((ansTxtOpt1) && (ansTxtOpt2)) =="")){
          alert("fill all options");
   }else if ((((ansTxtOpt3) && (ansTxtOpt4)) =="")){
          alert("fill all options");
    }else if (radiobtn_check == 0){
          alert("Choose one answer"); 
    /*}else if (credits ==0 || credits ==""){
          alert("fill credits");*/
    /*}else if (creditsNum == false ){
          alert("Credits should be number"); */                                
    }else if (news_leagues ==0){
          alert("fill leagues");
    /*}else if (news_team ==0) {
          alert("fill team");*/
    }else if ( (game_type == '1') && ($.trim($('input[name="hint1"]').val()) == "" || $.trim($('input[name="hint2"]').val()) == "" || $.trim($('input[name="hint3"]').val()) == "") ){
           alert("Hints can not be empty!");
    }else if (link ==0 || link ==""){
          alert("fill link");
    }else if (explanation ==0 || explanation ==""){
           alert("fill explanation");
    /*}else if ( (TTL_hour ==0) && (TTL_min ==0) ){
           alert(" select time to live"); */
     }else if (TTA_sec ==0){
           alert("Select time to answer");              
     /*}else if ( (publishdate ==0) && (publishdate =="") ){
           alert(" select publish date");              
     }else if ( (publishtime ==0) && (publishtime =="") ){
           alert(" select  publish time");  */         
    } else{ 

             var gameid = $('#gameid').val(); 
             if(gameid==0){
                    e.preventDefault();
                    $('.error').html('');               
                   // var ele   = $('#gameAdd');
                    var url   = SITEURL + 'game/game_add';
                    var frmdata=new FormData($('form[name="gameinfo"]')[0]);
                    $.ajax({
                      data: frmdata,
                      url : url,
                      async: false,
                      type: 'POST',
                      cache: false,
                      contentType: false,
                      processData: false
                    }).done(function(data){  
                        $('#myAddModal').modal('hide');
                         location.reload();
                        if(publish_id==0){         
                          $('#message_success_insert').css({'display':''});
                          $('#message_success_insert').delay(3000).fadeOut(400);
                        }

                    });

               }else{

                      $('.error').html('');               
                      //var ele   = $('#gameAdd');
                      var frmdata=new FormData($('form[name="gameinfo"]')[0]);
                      var url   = SITEURL + 'game/game_qustions_update';
                      
                      $.ajax({
                      data: frmdata,
                      url : url,
                      async: false,
                      type: 'POST',
                      cache: false,
                      contentType: false,
                      processData: false
                        }).done(function(data){  
                            $('#qus'+id).text(qustion);
                            $('#cre'+id).text(credits);
                            $('#dur'+id).text(duration);
                            $('#ans-opt1'+id).val(ansTxtOpt1);
                            $('#ans-opt2'+id).val(ansTxtOpt2);
                            $('#ans-opt3'+id).val(ansTxtOpt3);
                            $('#ans-opt4'+id).val(ansTxtOpt4);
                            $('#link'+id).text(link);
                            $('#Explanation'+id).text(explanation);

                            $('#myAddModal').modal('hide');
                            location.reload();
                            if(publish_id==0){         
                              $('#message_success_update').css({'display':''});
                              $('#message_success_update').delay(3000).fadeOut(400);
                            }                            
                     });                
                
             }
        }
  });
 


  $(document).on('click','.btn-add-game',function(){
    $('form[id="gameAdd"]')[0].reset();
    $('.news_leagues option:selected').removeAttr('selected');
    $('.new_team option:selected').removeAttr('selected');
    //$('.sponser_class option:selected').removeAttr('selected');
    //$('.TTL-hour option:selected').removeAttr('selected');
    //$('.TTL-min option:selected').removeAttr('selected'); 
    $('.TTA-min option:selected').removeAttr('selected'); 
    $('.TTA-sec option:selected').removeAttr('selected'); 
    $('.thumbnl').attr('src','assets/Artboard1.png');
    var edittxt="Add Game"
    var id="0"

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
    /*$.ajax({
      url:"game/getmaxcredit",                    
    }).done(function(getdata){
        if(getdata !=null){ 
          $('#credits').html('');
          for(var i=1;i<=getdata;i++){
            var credits = '<option  value="'+i+'">'+i+'</option>';  
            $('#credits').append(credits);
          }
        }
    });*/ 
    //$('#myAddModal').find('#difficulty_block').css({'display':'block'});  
    $('#myAddModal').find('#ques_hint').css({'display':'block'});  

    $('#datepicker').val(currentDate);
    $('#datetimepicker3').val(currentTime);
    $('#NowPublishDate').val(currentDate);
    $('#NowPublishTime').val(currentTime);
    $('#add').text(edittxt);
    $('#gameid').val(id);
    $('.select_leagues').removeAttr('selected'); 
    $('.select_leagues').removeAttr('selected');
    /*createUploader();
   $('#thumbnail').imgAreaSelect({ aspectRatio: '16:9', onSelectChange: preview, parent: '#imgModal'});*/
  });


  $(document).on('click','.edit-form-btn',function(){   
    $('form[id="gameAdd"]')[0].reset();
    var id = $(this).data("id");
    $('#gameid').val(id); 
    var edittxt="Edit Game"
    $('#add').text(edittxt);

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

     $('#NowPublishDate').val(currentDate);
     $('#NowPublishTime').val(currentTime);

    var url = SITEURL + 'game/game_detail/'+id; 
    $.ajax({
      url:url,                    
    }).done(function(getdata){
        if(getdata !=null){ 

            $.each(getdata,function(i,row){ 

              var options=row['options']; 
              var league_id=row['league'];
              var team_id=row['team'];
              var game_image=row['images'];
              var time_to_answer=row['time_to_answer'];
              var time_to_answers= time_to_answer.split(":");
              var time_to_ans_min=time_to_answers[1]; 
              var time_to_ans_sec=time_to_answers[2]; 
              var game_type=row['game_type'];
              
              if(options==1){ 
                $( "#option1" ).prop( "checked", true );  
              }else if(options==2){ 
                $( "#option2" ).prop( "checked", true );  
              }else if(options==3){ 
                $( "#option3" ).prop( "checked", true );  
              }else { 
                $( "#option4" ).prop( "checked", true );  
              }

              $('input[name="time_to_publish_date"]').val(row['pdate']);
              $('input[name="time_to_publish_time"]').val(row['ptime']);
              $('#ansTxtOpt1').val(row['ans_opt1']);
              $('#ansTxtOpt2').val(row['ans_opt2']);
              $('#ansTxtOpt3').val(row['ans_opt3']);
              $('#ansTxtOpt4').val(row['ans_opt4']);
              $('#question').val(row['questions']);
              $('#qusId').val(id);
              $('#explanation_answer').val(row['explaination']);
              $('#linkid').val(row['link']);
              $('#tagid').val(row['tags']);
              $('select[name="news_league_id"] option[value="'+league_id+'"]').attr('selected','selected');
              $('select[name="TTA-sec"] option[value="'+time_to_ans_sec+'"]').attr('selected','selected');  
              $('select[name="select_game_category"] option[value="'+game_type+'"]').attr('selected','selected'); 
              if(game_type=='1'){
                  $.ajax({
                    url:SITEURL + 'game/gethints/'+id,                    
                  }).done(function(gethintdata){
                    $.each(gethintdata,function(ix,hintrow){
                      var yx = ix+1;
                      $('input[name="hint'+yx+'"]').val(hintrow['hint']);
                    });
                  });  
                  $('#myAddModal').find('#ques_hint').css({'display':'block'});
              }else{
                $('#myAddModal').find('#ques_hint').css({'display':'none'});
              }
                  
              if(team_id==0){
                  var team_url = SITEURL + 'dashboard/select_news_league/'+row['league']; 
              }else{
                  var team_url = SITEURL + 'dashboard/get_news_team_detail/'+team_id; 
              }
              $.ajax({
                url:team_url,                    
              }).done(function(getdata){
                $('#add_news_team').html('');
                $('#add_news_team').append('<option  value="0">All Teams</option>');
                if(getdata !=null){
                    $.each(getdata.team,function(i,row){
                      if(row['league_team_id'] == team_id){ 
                            var all_league_team = '<option value="'+row['league_team_id']+'" selected>'+row['league_team_name']+'</option>';  
                      }else{
                          var all_league_team = '<option  value="'+row['league_team_id']+'">'+row['league_team_name']+'</option>';   
                      }
                      $('#add_news_team').append(all_league_team);
                    });
                }
              });       
            });
        }
    });       
     
  });



  $(document).on('click','.view-form-btn',function(){   
    var id = $(this).data("id");

    var url = SITEURL + 'game/game_detail/'+id; 
    $.ajax({
      url:url,                    
    }).done(function(getdata){
        if(getdata !=null){ 

            $.each(getdata,function(i,row){ 

              var options=row['options']; 
              var league_id=row['league'];
              var team_id=row['team'];
              var time_to_answer=row['time_to_answer'];
              var time_to_answers= time_to_answer.split(":");
              var time_to_ans_min=time_to_answers[1]; 
              var time_to_ans_sec=time_to_answers[2]; 
              var game_type=row['game_type'];


              if(options==1){ 
                $( "#option1View" ).prop( "checked", true );  
              }else if(options==2){ 
                $( "#option2View" ).prop( "checked", true );  
              }else if(options==3){ 
                $( "#option3View" ).prop( "checked", true );  
              }else { 
                $( "#option4View" ).prop( "checked", true );  
              }

              $('input[name="time_to_publish_date"]').val(row['pdate']);
              $('input[name="time_to_publish_time"]').val(row['ptime']);
              $('#ansTxtOpt1View').val(row['ans_opt1']);
              $('#ansTxtOpt2View').val(row['ans_opt2']);
              $('#ansTxtOpt3View').val(row['ans_opt3']);
              $('#ansTxtOpt4View').val(row['ans_opt4']);
              $('#questionView').val(row['questions']);
              //$('#creditsView').val(credits);
              $('#explanation_answerView').val(row['explaination']);
              $('#linkidView').val(row['link']);
              $('#tagidView').val(row['tags']);
              //$('.thumbn2').attr('src',S3 + 'newsimages/'+game_image);
              $('select[name="news_league_id"] option[value="'+league_id+'"]').attr('selected','selected');
              $('select[name="TTA-sec"] option[value="'+time_to_ans_sec+'"]').attr('selected','selected');   
              $('select[name="select_game_category"] option[value="'+game_type+'"]').attr('selected','selected'); 
              if(game_type=='1'){
                  $('#myviewModal').find('#ques_hint').css({'display':'block'});
                  $.ajax({
                      url:SITEURL + 'game/gethints/'+row['id'],                    
                  }).done(function(gethintdata){
                      $.each(gethintdata,function(ix,hintrow){
                        var yx = ix+1;
                        $('#myviewModal').find('input[name="hint'+yx+'"]').val(hintrow['hint']);
                      });
                  });
              }else{
                  //$('#myviewModal').find('#difficulty_block').css({'display':'none'});
                  $('#myviewModal').find('#ques_hint').css({'display':'none'});
              }

              if(team_id==0){
                  var team_url = SITEURL + 'dashboard/select_news_league/'+row['league']; 
              }else{
                  var team_url = SITEURL + 'dashboard/get_news_team_detail/'+team_id; 
              }
              $.ajax({
                url:team_url,                    
              }).done(function(getdata){
                if(getdata !=null){
                  $('#add_news_teamView').append('<option value="0">All Teams</option>');
                  $.each(getdata.team,function(i,row){
                      if(row['league_team_id'] == team_id){ 
                          var all_league_team = '<option value="'+row['league_team_id']+'" selected>'+row['league_team_name']+'</option>';  
                      }else{
                          var all_league_team = '<option  value="'+row['league_team_id']+'">'+row['league_team_name']+'</option>';   
                      }
                      $('#add_news_teamView').append(all_league_team);
                  });
                }
              });       
           });
        }
   });       
   
   $.each($('#myviewModal').find('input,select,textarea'),function(){
      $(this).attr('disabled','disabled');
   });

  });


  $(document).on('click','.delete-form-btn',function(){
    var id = $(this).data("id"); 
    //  e.preventDefault();
   
      var url   = SITEURL +"game/game_qustions_delete/"+id;


      var r = confirm("Do you want to delete ?");
      if(r==true){      
          $.ajax({
            url : url,
            type: 'POST'
            }).done(function(data){
              $('#row_'+id).hide();
         });
       }     
  });


  function limitText(limitField, limitNum) {
    if (limitField.value.length > limitNum) {
        limitField.value = limitField.value.substring(0, limitNum);
    }
  }


  $(document).ready(function(){
    $(".chexbox").click(function(){  
      var checkBoxValue = $( this ).val(); 
      var id=$('#gameid').val(); 
      $('#opt'+id).val(checkBoxValue);
       // alert("The paragraph was clicked.");
    });
});


$(document).on('change', '.news_leagues', function(){
    var league_id = $(this).find('option:selected').data("id");
    var url = SITEURL + "dashboard/select_news_league/"+league_id;
    $.ajax({
        url:url
    }).done(function(getdata){
        $('#add_news_team').html('');
        $('#add_news_team').append('<option value="0">All Teams</option>');

        $.each(getdata.team,function(i,row){                           
            var all_league_team = '<option   value="'+row['league_team_id']+'">'+row['league_team_name']+'</option>';                               
            $('#add_news_team').append(all_league_team);
        });
    });
});

function createUploader(){ 
    var button = $('#uploadA');           
    var uploader = new qq.FileUploaderBasic({
        button: document.getElementById('file-uploader'),
        action: SITEURL+'script.php',
        allowedExtensions: ['jpg', 'gif', 'png', 'jpeg'],
        onSubmit: function(id, fileName) {
            // change button text, when user selects file           
            button.text('Uploading');
            // Uploding -> Uploading. -> Uploading...
            interval = window.setInterval(function(){
                var text = button.text();
                if (text.length < 13){
                        button.text(text + '.');                    
                } else {
                        button.text('Uploading');               
                }
            }, 200);
        },
        onComplete: function(id, fileName, responseJSON){
            button.text('Edit Image');
            window.clearInterval(interval);

            if(responseJSON['success'])
            {
                //alert(responseJSON);
                load_modal(responseJSON['filename']);
            }
        },
        debug: true
    });           
}
function load_modal(filename){
    $('#thumbnail').attr('src', SITEURL+"uploads/"+filename);
    $('#thumb_preview').attr('src', SITEURL+"uploads/"+filename);
    $('#filename').attr('value', filename);
    // IE fix
    if ( $.browser.msie ) {$('#thumb_preview_holder').remove();}

    $('#imgModal').reveal();

}

function preview(img, selection) { 
    var mythumb = $('#thumbnail');
    var scaleX = 180/selection.width; 
    var scaleY = 101/selection.height; 

    $('#thumbnail + div > img').css({ 
            width: Math.round(scaleX * mythumb.outerWidth() ) + 'px', 
            height: Math.round(scaleY * mythumb.outerHeight()) + 'px',
            marginLeft: '-' + Math.round(scaleX * selection.x1) + 'px', 
            marginTop: '-' + Math.round(scaleY * selection.y1) + 'px' 
    });
    $('#x1').val(selection.x1);
    $('#y1').val(selection.y1);
    $('#x2').val(selection.x2);
    $('#y2').val(selection.y2);
    $('#w').val(selection.width);
    $('#h').val(selection.height);
}

