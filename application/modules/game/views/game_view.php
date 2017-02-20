  <div class="profile">

            <form class="form-horizontal" id="game">
            <fieldset>

          
            <legend>
             <a onclick="goBack()" href="javascript:void(0);" class="btn btn-default">
                        <i class="fa fa-long-arrow-left fa-lg"></i>

                </a>
            Game</legend>

            <!-- Text input-->
            <div class="form-group">
              <label class="col-md-2 control-label" for="user_email">Question</label>  
              <div class="col-md-7">
              <input id="question" name="question" placeholder="question" class="form-control input-md" type="text" value="" onKeyDown="limitText(this,100);" onKeyUp="limitText(this,100);">
              <div id="login_question_err" class="error"></div>
              </div>
            </div>

            <div class="col-md-8" style="margin-left: 30px;" id="radio_list">

                <label class="" style="width: 55px;">Options</label>
                <label id="option_1" class="radio-inline">
                  	<span>1</span>
                  	<input id="" name="ans_opt1" placeholder="option1" class="" type="text" value="" style="height: 35px; margin-left: 12px;width: 350px; border: 1px solid #ccc; border-radius: 4px;" onKeyDown="limitText(this,40);" onKeyUp="limitText(this,40);">
                </label>
                <br>
                <label id="option_2" class="radio-inline">
                	<span>2</span>
                  	<input type="text" name="ans_opt2" placeholder="option2" style="height
                  : 35px; margin-left: 12px;width: 350px; border: 1px solid #ccc; border-radius: 4px; margin-bottom: 12px;" onKeyDown="limitText(this,40);" onKeyUp="limitText(this,40);">
                </label>
                <br>
                <label id="option_3" class="radio-inline">
                	<span>3</span>
                	<input type="text" name="ans_opt3" placeholder="option3" style="height
                  : 35px; margin-left: 12px;width: 350px; border: 1px solid #ccc; border-radius: 4px; margin-bottom: 12px;" onKeyDown="limitText(this,40);" onKeyUp="limitText(this,40);">
                </label>
                <br>                
                <label id="option_4" class="radio-inline">
                	<span>4</span>
                 	<input type="text" name="ans_opt4" placeholder="option4" style="height
                  : 35px; margin-left: 12px;width: 350px; border: 1px solid #ccc; border-radius: 4px; margin-bottom: 12px;" onKeyDown="limitText(this,40);" onKeyUp="limitText(this,40);">
                </label>
                <br>
            </div> 
            
            <div> 
            	<label class="" style="width: 139px; margin-top: 6px;">Choose answer</label> 
            	<br>
                <label id="option_1" class="radio-inline" style="">
                	<input type="radio" name="optradio" value="1" style="margin-left: 11px;">
                </label>
                <br>
                <label id="option_2" class="radio-inline" style="margin-top: 22px;">
                	<input type="radio" name="optradio" value="2" style="margin-left: 11px;">
                </label>
                <br> 
                <label id="option_3" class="radio-inline " style="margin-top: 28px;">
                	<input type="radio" name="optradio" value="3" style="margin-left: 11px;">
                </label> 
                <br>                              
                <label id="option_4" class="radio-inline" style="margin-top: 26px;">
                	<input type="radio" name="optradio" value="4" style="margin-left: 11px;">
                </label> 
              
            </div>
            <hr>

            <div class="form-group">
              <label class="col-md-2 control-label" for="user_email">Credits</label>  
              <div class="col-md-5">
              <input id="credits" name="credits" placeholder="Credits" class="form-control input-md" type="text" value="">
              <div id="login_credits_err" class="error"></div>
              </div>
            </div>       

            <hr>

            <div class="form-group">
                  <form class="form-inline">
                   
                   <label class="col-md-2 control-label" for="user_email">Publish</label>
                   <div class="col-md-5">                         
                       <input type='text' name="datepicker" placeholder="Date" class="form-control" id='datetimepicker' />
                       <div id="login_datepicker_err" class="error"></div>
                   </div>
                     
                  </form>
            </div>

             <div class="form-group">
              <label class="col-md-2 control-label" for="user_email">Duration</label>  
              <div class="col-md-5">
              <input id="duration" name="duration" placeholder="duration" class="form-control input-md" type="text" value="">
              <div id="login_duration_err" class="error"></div>
              </div>
            </div>        
           
            
            

            </fieldset>
            </form>

            <div class="form-group" style="margin-left: 7%;">
             <button class="btn btn-primary btn_submit" id="submit_form">Submit Form</button> 

            </div>
            

</div>


<script>       

  $(function () {
      $('#datetimepicker').datetimepicker();
  });

  function goBack() {
      window.history.back();
  }
  
  var opt=3;
  $(document).on('click','#add_radio_btn',function(){
       if(opt != 6){
          var opt_list = '<br><label id="option_'+opt+'" class="radio-inline"><input type="radio" name="optradio"  value ="'+opt+'">Option '+opt+ '<input type="text" name="" style="height: 31px; margin-left: 12px;width: 350px; border: 1px solid #ccc; border-radius: 4px; margin-bottom: 12px;">'

                          '</label>';
          $('#radio_list').append(opt_list);
          opt++;  
        }
        else{
          alert("you can add maximum 5 options"); 
        }       
         
  });


        $(document).on("click","#submit_form",function(e){
                e.preventDefault();
                $('.error').html('');               
                var ele   = $('#game');
                var data  = ele.serialize();
                var url   = "<?php echo SITEURL;?>game/game_listing";
                $.ajax({
                   data : data,
                   url : url,
                   type: 'POST'
                }).done(function(data){  
                     if(data['status']==1){           
                           window.location.href = "<?php echo SITEURL;?>dashboard/main";}
                           else if(data['status']==0)
                           {// alert("b");
                              //document.getElementById('login_err').innerHTML = "Username or Password Error";
                             
                           }
                    else 
                    {
                        if( typeof data.errors === 'object' ) 
                        {
                            $.each(data.errors, function(key, val) {
                            $('#login_'+key+'_err').html(val);
                        });

                           
                       } 
                       
                    } 
                           
                });
          });

function limitText(limitField, limitNum) {
    if (limitField.value.length > limitNum) {
        limitField.value = limitField.value.substring(0, limitNum);
    }
}



</script>