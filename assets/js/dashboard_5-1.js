var tab_index = 0;

$(function(){            
    $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {            
        localStorage.setItem('lastTab', $(this).attr('href'));

    });            
    var lastTab = localStorage.getItem('lastTab');
    if (lastTab) {
        $('[href="' + lastTab + '"]').tab('show');
        tab_index = localStorage.getItem('tabIndex');
    }

    $('#select_game_category').on('change',function(){
        if($(this).val()=='1'){
            $('#difficulty_block').css({'display':'block'});
            $('#ques_hint').css({'display':'block'});
        }else{
            $('#difficulty_block').css({'display':'none'});
            $('#ques_hint').css({'display':'none'});
        }
    });

    
});

//Getty image code
$('#getty_form').submit(function(){
    var srch = $('#serch').val();
    srch = (srch)?srch:'';
    if(srch==''){
        alert("Please enter search keyword!");
        return false;
    }
    $('#getImgList').html("<p>Please wait...</p>");
    var request = createCORSRequest("get", SITEURL+"dashboard/searchgetty/"+srch);
    if (request){
        request.onload = function(){
            //do something with request.responseText
            var result = JSON.parse(request.responseText);
            var str='<p>No image found...</p>';
            if(result.payload.images.length > 0){
                $.each(result.payload.images,function(k,val){
                    str+='<div class="form-group" style="width:23%; height:300px; margin:5px; padding:10px; border:1px solid #CCC; text-align:center; float:left;"> <img src="'+ val.display_sizes[0].uri +'" style="max-width:100%; max-height:70%;"><br><p style="font-size:10px; color:#333333; line-height:14px;">'+ val.title +'<br><span style="color:#000000; font-weight:bold;">'+ val.date_created +'</span></p><button onclick="downloadMeGetty(\''+ val.id +'\');" class="btn btn-success" style="max-width:100%; margin-top:5px;">Use it</button></div>';   
                            
                });
                str+='<div style="clear:both;"></div>';
            } 
            $('#getImgList').html(str);
        };
        request.send();
    }
    return false;
});

function downloadMeGetty(imageId){
    var request = createCORSRequest("get", SITEURL+"dashboard/downloadImage/"+imageId);
    if (request){
        request.onload = function(){
            //do something with request.responseText
            //var result = JSON.parse(request.responseText);
            alert(request.responseText);
            
        };
        request.send();
    }
    return false;

}

function createCORSRequest(method, url){
    var xhr = new XMLHttpRequest();
    if ("withCredentials" in xhr){
        xhr.open(method, url, true);
    } else if (typeof XDomainRequest != "undefined"){
        xhr = new XDomainRequest();
        xhr.open(method, url);
    } else {
        xhr = null;
    }
    return xhr;
}

  
$('#Search_From_Getty').on('click',function(){
    $('#gettyModal').modal('show');  
    return false;
});

var setCookie = function(cname, cvalue, exdays, tab_index) {
    var d = new Date();
    var val=cvalue.split('&');
    var new_val='';
    $.each(val,function(k,v){
        var v2=v.split('=');
        new_val += (new_val.indexOf(v2[0])!= -1)?'':'&'+v;
    });
    d.setTime(d.getTime() + (exdays*60*1000));
    var expires = "expires="+d.toUTCString();
    document.cookie = cname + "_" + tab_index +"=" + new_val + "; " + expires;
}

var getCookie = function(cname,tab_index) {
    var name = cname + "_" + tab_index +"="; 
    var ca = document.cookie.split(';');
    for(var i=0; i<ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0)==' ') c = c.substring(1);
        if (c.indexOf(name) == 0) return c.substring(name.length, c.length);
    }
    return "";
}

var get_team = function(league_id){
    var tab_index = $('.nav-tabs > li.active').index();
    var parDivID = $('.nav-tabs > li.active > a').attr('href');
    $(parDivID +' button.select_team_text').text('Select Team');
    $(parDivID +' button.select_team_text').append(' <span class="caret">');
    $(parDivID +' #select_team').html('');
    $(parDivID +' button.select_news_type').text('Select News');
    $(parDivID +' .datepicker ').val('');
    $.ajax({
        url:SITEURL+"dashboard/get_team/"+league_id,
        dataType: "json",
        success:function(response){
            var x=0;
            //alert(response);
            var teams = '<li><a class="select_team" data-id="" data-name="All Team" href="javascript:void(0);">All Team</a>';
            $(parDivID +' #select_team').append(teams);
            $.each(response,function(k,val){
                teams = '<li><a class="select_team" data-id="'+val['league_team_id']+'" data-name="'+val['league_team_name']+'" href="javascript:void(0);">'+
                        '<img style="background:white;-moz-border-radius: 70px;-webkit-border-radius: 70px; border-radius: 70px;" class="exSp" src="'+ teamlogo +val['league_team_logo']+'" width="35px">'+
                        '<span>'+val['league_team_name']+'</span>'+
                        '</a></li>';

                $(parDivID +' #select_team').append(teams);
            });
        }
    });
}

var get_player = function(league_id,team_id){
    var tab_index = $('.nav-tabs > li.active').index();
    var parDivID = $('.nav-tabs > li.active > a').attr('href');
    $(parDivID +' button.select_player_text').text('Select Player');
    $(parDivID +' button.select_player_text').append(' <span class="caret">');
    $(parDivID +' #select_player').html('');
    // $(parDivID +' button.select_news_type').text('Select News');
    // $(parDivID +' .datepicker ').val('');
    $.ajax({
        url:SITEURL+ "dashboard/get_player/"+league_id+"/"+team_id,
        dataType: "json",
        success:function(response){
            var x=0;
            //alert(response);
            $.each(response,function(k,val){
                /*var player = '<li><a class="select_player" data-name_abbr="'+val['player_name_abbr']+'" data-name="'+val['player_name']+'" href="javascript:void(0);">'+
                        '<img style="background:white;-moz-border-radius: 70px;-webkit-border-radius: 70px; border-radius: 70px;" class="exSp" src="'+ teamlogo +val['player_name']+'" width="35px">'+
                        '<span>'+val['player_name']+'</span>'+
                        '</a></li>';*/
                var player = '<li><a class="select_player" data-name_abbr="'+val['player_name_abbr']+'" data-name="'+val['player_name']+'" href="javascript:void(0);">'+
                        '<span>'+val['player_name']+'</span>'+
                        '</a></li>';

                    $(parDivID +' #select_player').append(player);

                 var position = '<li><a class="select_position" data-name_abbr="'+val['player_name_abbr']+'" data-position="'+val['player_position']+'" href="javascript:void(0);">'+
                        // '<img style="background:white;-moz-border-radius: 70px;-webkit-border-radius: 70px; border-radius: 70px;" class="exSp" src="'+ teamlogo +val['player_name']+'" width="35px">'+
                        '<span>'+val['player_position']+'</span>'+
                        '</a></li>';

                    $(parDivID +' #select_position').append(position);
            });
        }
    });
}

var getValueSelected = function(params,tabindex){
    var str = params.split('&');
    //$('#datepicker1').val('');
    //$('#datepicker2').val('');
    var parDivID = $('.nav-tabs > li').eq(tabindex).find('a').attr('href');
    $.each(str,function(k,val){
        var str2=val.split('=');        
        if(str2[0]=='leagueId'){
            $(parDivID+' button.select_league_text').text($(parDivID+' .select_league[data-id='+str2[1]+']').data('name'));
            $(parDivID+' button.select_league_text').append(' <span class="caret">');
            if(tabindex=='0'){
                get_team(str2[1]);
            }
        }
        if(str2[0]=='teamId'){
            setTimeout(function(){ 
                $(parDivID+' button.select_team_text').text($(parDivID+' .select_team[data-id="'+str2[1]+'"]').data('name'));
                $(parDivID+' button.select_news_type').text('Select News'); 
            }, 1000);              

        }
        if(str2[0]=='news_type'){get_team
            setTimeout(function(){ 
                $(parDivID+' button.select_news_type').text($(parDivID+' .get_publish[data-id="'+str2[1]+'"]').data('name'));
                $(parDivID+' button.select_news_type').append(' <span class="caret">');
            }, 1000);
        }
        if(str2[0]=='from_date'){
            setTimeout(function(){ 
            var d= str2[1].split(' ');
            $(parDivID+' .datepicker1').val(d[0]);
            }, 1000);
        }
        if(str2[0]=='to_date'){
            setTimeout(function(){ 
            var d= str2[1].split(' ');
            $(parDivID+' .datepicker2').val(d[0]);
            }, 1000);
        }
    });
}

// List the ajax
var getList = function(params,tab_index,lmt){
    //alert(getCookie('srcFLTR'));
    var parDivID = $('.nav-tabs > li').eq(tab_index).find('a').attr('href');
    if(typeof params == 'undefined' || params==''){
        if(getCookie('srcFLTR',tab_index)!=''){
            params = getCookie('srcFLTR',tab_index);
            getValueSelected(getCookie('srcFLTR',tab_index),tab_index);
        }
    }
    setCookie('srcFLTR', params, '60',tab_index);
    if(tab_index=='0'){
        params+='&newsCategory=2';
    } else if(tab_index == '1') {
        params+='&newsCategory=31';
    } else if(tab_index == '4') {
        params+='&newsCategory=2&contentType=26';
    }
    var url = SITEURL + "dashboard/kroo_news_listing";
    if(tab_index == 3){
        var url = SITEURL + "dashboard/waiver_news_listing";
    }else if(tab_index == 2){ 
        var url = SITEURL + "dashboard/player_news_listing";
    }else if(tab_index == 4){ 
        //params+='&newsCategory=2';
        var url = SITEURL + "dashboard/kroo_news_video";

    }


    params+="&tab_index="+tab_index + "&lmt="+lmt;           
    $('#message_loading').css({'display':''});
    $.ajax({
        url : url,
        data : params,
        type : 'post',
        success:function(response){
            $(parDivID+' #listTYPE'+tab_index).val('');
            if(lmt>0){
                //alert(lmt);
                if(response=='END')
                    $(parDivID+' #listCNT'+tab_index).val('END');
                else
                    $(parDivID+' .kroo_data_table > tbody').append(response);
            }
            else{
                $(parDivID+' .kroo_data_table > tbody').html(response);
                //alert("Hello"); class="kroo_data_table"
            }
            $('#message_loading').css({'display':'none'});
        }
    });
}



$(document).ready(function () {
    // Load listing first time
    getList('',0,0); //KROO CAST
    getList('',1,0); //headlines 
    //getList('',3,0);
    //getList('',2,0);
    getList('',4,0);
    //getListWaiver('',3,0);

    $('.clr-fltr').on('click',function(){
        var tab_index = $('.nav-tabs > li.active').index();
        setCookie('srcFLTR', '', '-5', tab_index);
        location.reload(); 
    });
    $('#news_image').imgAreaSelect({ 
        aspectRatio: '16:9', 
        handles: true,
        onSelectEnd: function (img, selection) {
            $('input[name="x1"]').val(selection.x1);
            $('input[name="y1"]').val(selection.y1);
            $('input[name="x2"]').val(selection.x2);
            $('input[name="y2"]').val(selection.y2);            
        }
    });

    $(window).scroll(function() {
        if($(window).scrollTop() + $(window).height() == $(document).height()) {
            var tab_index = $('.nav-tabs > li.active').index();
            var parDivID = $('.nav-tabs > li').eq(tab_index).find('a').attr('href');
            var srcTYPE = $('#listTYPE'+tab_index).val();
            var lmt = $('#listCNT'+tab_index).val();
            //alert('lmt:'+lmt);
            if(lmt!='END' && srcTYPE!='SEARCH'){
                lmt = parseInt(lmt)+50;
                //alert(lmt);
                $('#listCNT'+tab_index).val(lmt);
                prms = getCookie('srcFLTR',tab_index);
                // List the ajax
                getList(prms,tab_index,lmt);
            }
            //alert("bottom!");
        }
    });
    
    $('#useOriginal').on('click',function(){
       $('#news_image').attr('src',$('#original_news_image').attr('src'));
       $('input[name="news_img"]').val('');
       return false;
    });
    
    
    
});
function createUploader(btnclicked){ 
    //alert(btnclicked);
    var parentDivId="myModal";
    if(btnclicked=="btn-add-news"){
        parentDivId="myAddNewsModel";
    } else if(btnclicked=="btn-addplayer-news"){
        parentDivId="myAddPlayerNewsModel";
    } else if(btnclicked=="btn_game_add_news"){
        parentDivId="myAddModal";
    }
    var button = $('#'+parentDivId + ' #upload');           
    var uploader = new qq.FileUploaderBasic({
        button: document.getElementById('file-uploader-' + parentDivId),
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
                load_modal(responseJSON['filename']);
            }
        },
        debug: true
    });           
}
function createUploaderAddNews(){ 
    var button = $('#uploadAddNews');           
    var uploader = new qq.FileUploaderBasic({
        button: document.getElementById('file-uploader-add-news'),
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

$(function(){
    var tab_index = $('.nav-tabs > li.active').index();
    if(tab_index == 2){
        $('#kroo_summary').hide();
        $('#article_summary').hide();
        $('#fantasy_summary').css({'display':''});
        $('#notified_sort').hide();
    }
    else if(tab_index == 3){
        $('#kroo_summary').hide();
        $('#fantasy_summary').hide();
        $('#article_summary').css({'display':''});
        $('#notified_sort').hide();
    }
    else{
        $('#fantasy_summary').hide();
        $('#article_summary').hide();
        $('#kroo_summary').css({'display':''});
        $('#notified_sort').css({'display':''});
    }
});

$(document).on('keyup','#news_search_box',function(e){
    e.preventDefault();
    var search_key = $('#news_search_box').val();
    var tab_index = $('.nav-tabs > li.active').index();
    if(e.keyCode == 13 && search_key.length != 0){
        $('#message_loading').css({'display':''});
        stop_ajax = 'undefined';
        var url = SITEURL + "dashboard/kroo_news_search";
        $.ajax({
            url : url,
            data : {
                search_key : search_key,
                tab_index : tab_index
            },
            type : 'post',
            success:function(response){
                $('#news_tab').hide();
                $('#search_tab').css({'display':''});
                $('#left_filters').hide();
                $('#right_filters').hide();
                $('#listTYPE'+tab_index).val('SEARCH');
                $('#message_loading').css({'display':'none'});
                //$('#kroo_team_news').html('');
                //console.log(response);
                $('.kroo_data_table > tbody').html(response);
            }
        });

   }
});


var stop_ajax = '';

$('.nav-tabs a').click(function (e){
     e.preventDefault();
     tab_index = $($(this).attr('href')).index();

     localStorage.setItem('tabIndex', tab_index);

     select_league_id = undefined;
     select_team_id   = undefined;
     $('input:checkbox').removeAttr('checked');
     stop_ajax = '';
    if(tab_index == 2){
        $('#kroo_summary').hide();
        $('#article_summary').hide();
        $('#fantasy_summary').css({'display':''});
        $('#notified_sort').hide();
    }
    else if(tab_index == 3){
        $('#kroo_summary').hide();
        $('#fantasy_summary').hide();
        $('#article_summary').css({'display':''});
        $('#notified_sort').hide();
    }
    else{
        $('#fantasy_summary').hide();
        $('#article_summary').hide();
        $('#kroo_summary').css({'display':''});
        $('#notified_sort').css({'display':''});
    }
});



$(document).on('click','.select_league',function(){
    var league_id = $(this).data("id");
    var tab_index = $('.nav-tabs > li.active').index();
    var parDivID = $('.nav-tabs > li.active > a').attr('href');
    $(parDivID +' button.select_league_text').text($(this).data("name"));
    $(parDivID +' button.select_league_text').append(' <span class="caret">');
    $(parDivID +' .kroo_data_table > tbody').html('');
    if(tab_index=='0' || tab_index=='2' || tab_index=='4'){
        get_team(league_id);
    }

    var prms = '&leagueId='+league_id;
    $('.select_channel_text').text('Select Channel');
    $('.select_channel_text').append(' <span class="caret">');
    getList(prms,tab_index,0);
});

$(document).on('click','.select_channel',function(){
    var channel_id = $(this).data("id");
    var tab_index = $('.nav-tabs > li.active').index();
    var parDivID = $('.nav-tabs > li.active > a').attr('href');
    $(parDivID +' button.select_channel_text').text($(this).data("name"));
    $(parDivID +' button.select_channel_text').append(' <span class="caret">');
    $(parDivID +' .kroo_data_table > tbody').html('');   

    var prms = '&channelID='+channel_id;
    // List the ajax

    getList(prms,tab_index,0);
});

$(document).on('click','.select_team',function(){
    var prms = '';
    var tab_index = $('.nav-tabs > li.active').index();
    var parDivID = $('.nav-tabs > li.active > a').attr('href');
    var league=$.trim($(parDivID+' .select_league_text').text());
    $(parDivID +' button.select_news_type').text('Select News');
    var leagueId = 0;
    var teamId = 0;
    if(league!='Select League' && league!='All League'){
        //alert(league);
        leagueId = $(parDivID +' .select_league[data-name="'+league+'"]').data('id');
        prms = '&leagueId='+leagueId;
        if(leagueId >0){
            teamId = $(this).data("id");
            $(parDivID +' button.select_team_text').text($(this).data("name"));
            $(parDivID +' button.select_team_text').append(' <span class="caret">');
            prms += '&teamId='+teamId;
        }
    }
    if(tab_index == '2'){
        get_player(leagueId,teamId);
    }
    // List the ajax
    getList(prms,tab_index,0);
});

 $(document).on('click','.select_player',function(e){

    e.preventDefault();
    stop_ajax = 'undefined';
    var tab_index = $('.nav-tabs > li.active').index();
    var parDivID = $('.nav-tabs > li.active > a').attr('href');
    var news_type = $(this).data("id");
    var type_name = $(this).data("name");
    var name_abbr = $(this).data("name_abbr");
    var prms = '';
    var league=$.trim($(parDivID+' .select_league_text').text());
    if(league!='Select League' && league!='All League'){
        var leagueId = $(parDivID+' .select_league[data-name='+league+']').data('id');
        prms = '&leagueId='+leagueId;
        if(leagueId >0){
            var teamId = '';
            var team=$.trim($(parDivID+' .select_team_text').text());
            if(team!='Select Team'){
                teamId = $(parDivID+' .select_team[data-name="'+team+'"]').data('id');
            }
            prms += '&teamId='+teamId;
        }
    }
    var news_type = $(this).data("id");
    prms+='&news_type='+news_type;
    prms+='&name_abbr='+name_abbr;
    // List the ajax
    getList(prms,tab_index,0);

    $(parDivID+' button.select_player_text').text(type_name);
    $(parDivID+' button.select_player_text').append(' <span class="caret">');
});

$(document).on('click','.select_position',function(e){

    e.preventDefault();
    stop_ajax = 'undefined';
    var tab_index = $('.nav-tabs > li.active').index();
    var parDivID = $('.nav-tabs > li.active > a').attr('href');
    
    var type_name = $(this).data("position");
    var name_abbr = $(this).data("name_abbr");
    var prms = '';
    var league=$.trim($(parDivID+' .select_league_text').text());
    if(league!='Select League' && league!='All League'){
        var leagueId = $(parDivID+' .select_league[data-name='+league+']').data('id');
        prms = '&leagueId='+leagueId;
        if(leagueId >0){
            var teamId = '';
            var team=$.trim($(parDivID+' .select_team_text').text());
            if(team!='Select Team'){
                teamId = $(parDivID+' .select_team[data-name="'+team+'"]').data('id');
            }
            prms += '&teamId='+teamId;
        }
    }   
    prms+='&name_abbr='+name_abbr;
    prms+='&position='+type_name;
    // List the ajax
    getList(prms,tab_index,0);

    $(parDivID+' button.select_position_text').text(type_name);
    $(parDivID+' button.select_position_text').append(' <span class="caret">');
});


$(document).on('click','.btn-add-news',function(){
    $('form[name="Addfileinfo"]')[0].reset();
    createUploader('btn-add-news');
    $('#thumbnail').imgAreaSelect({ aspectRatio: '16:9', onSelectChange: preview, parent: '#imgModal'});
    $('#myAddNewsModel .thumbnl').attr('src','');
    $('input[name="news_img"]').val('');
});

$(document).on('click','.btn-addplayer-news',function(){
    $('form[name="addPlayerNews"]')[0].reset();
    createUploader('btn-addplayer-news');
    $('#thumbnail').imgAreaSelect({ aspectRatio: '16:9', onSelectChange: preview, parent: '#imgModal'});
    $('#myAddPlayerNewsModel .thumbnl').attr('src','');
});



$(document).on('click','.btn_edit_news',function(){
    $('form[name="fileinfo"]')[0].reset();
    createUploader('btn_edit_news');
    $('#thumbnail').imgAreaSelect({ aspectRatio: '16:9', onSelectChange: preview, parent: '#imgModal'});
    $('input[name="news_img"]').val('');
    var id = $(this).data("id");
    var news_at = $('#kroo_news_at_'+id).html();
    var title = $('#title_'+id).text();
    var url = $('#title_'+id).attr('href');
    var summary = $('#summary_'+id).html();
    var img_url = $('#image_'+id).attr("src");
    var news_source = $('#news_source_'+id).html();
    var ori_img_url = $('#rss_image_'+id).val();
    var activity_detail = $('#activity_detail_'+id).html();
    $("#news_league_id").empty();
    if(ori_img_url == '' || ori_img_url == 'noimage'){
        ori_img_url = ASSETS + "Artboard1.png";
    }else{
        ori_img_url = $('#image_'+id).attr("src");
    }
    $('#edit_league_team').css({'display' : 'none'});
    var tab_index = $('.nav-tabs > li.active').index();
    if(tab_index == 0 || tab_index == 4){
        
        $('#edit_league_team').css({'display' : 'flex'});
        var team_id = $(this).data("team_id");
        var team_url = SITEURL + 'dashboard/get_news_team_detail/'+team_id; 
        var league_id = $(this).data("league_id");
        $.ajax({
            url:team_url,                    
        }).done(function(getdata){
            if(getdata!='' && getdata!=null){
                if(getdata.league_id > 0){
                    $('select[name="news_league_ids"] option[value="'+getdata.league_id+'"]').attr('selected','selected');
                }
                $.each(getdata.team,function(i,row){
                    if(row['league_team_id'] == team_id){
                        var all_league_team = '<option value="'+row['league_team_id']+'" selected>'+row['league_team_name']+'</option>';    
                    }else{
                        var all_league_team = '<option value="'+row['league_team_id']+'">'+row['league_team_name']+'</option>';    
                    }
                     $('#news_league_id').append(all_league_team);

                });
            }else if(league_id > 0){
                $('select[name="news_league_ids"] option[value="'+league_id+'"]').attr('selected','selected');
                team_url = SITEURL + "dashboard/select_news_league/"+league_id;
                $.ajax({
                    url:team_url
                }).done(function(getdata){
                    var all_league_team = '<option value="">Select Team</option>';    
                    $('#news_league_id').append(all_league_team);     
                    $.each(getdata.team,function(i,row){                           
                        all_league_team = '<option value="'+row['league_team_id']+'">'+row['league_team_name']+'</option>';    
                        $('#news_league_id').append(all_league_team);                        
                    });
                });
            }else{
                 $('select[name="news_league_id"] option').removeAttr('selected');
                 $('#news_league_id').html('');
            }

        });  
    }


    $('#rss_title').html($('#rss_title_'+id).val());
    $('#rss_summary').html($('#rss_summary_'+id).val());
    $('#rss_url').html($('#rss_url_'+id).val());
    $("#news_url").attr("href", $('#rss_url_'+id).val());
    $('#original_news_image').attr("src", ori_img_url);
    $('#rss_source').html($('#rss_source_'+id).val());

    $('#edit_activity_detail').html(activity_detail);
    $('#edit_tab_index').val(tab_index);
    $('#edit_news_id').val(id);
    $('#edit_news_at').html(news_at);
    $('#edit_news_title').val(title);
    $('#edit_news_summary').val(summary);
    $('#edit_news_url').val(url);
    $('#news_image').attr("src", img_url);
    //$('input[name="news_img"').val(img_url);
    $('#news_image_url').val(img_url);
    $('#edit_news_source').val(news_source);

    $('#myModal').modal('show');

});

$(document).on('click','.btn_copy_news',function(){
    var id = $(this).data("id");
    var get_league_team = SITEURL + 'dashboard/get_league_team/'+id; 
    var tab_index = $('.nav-tabs > li.active').index();
    $('#copy_team_id').html('');
    $.ajax({
        url:get_league_team
    }).done(function(getdata){
        $.each(getdata,function(i,row){
            if(tab_index == 1){
                
                $('#copy_team_list').css({'display':''});
                $('#modal_title').html("Copy and publish to Kroo");                
                var all_league_team = '<option value="'+row['id']+'">'+row['name']+'</option>';  
                $('#copy_team_id').append(all_league_team);  
            }else if(tab_index == 0){                
                $('#copy_team_list').css({'display':'none'});
                $('#modal_title').html("Copy and publish to headlines");                
            }
        });
    });
    $('#copy_news_id').val(id);
    $('#myCopyModal').modal('show');    
});


$(document).on('click','#btn_copy_update',function(e){
    e.preventDefault();
    var news_id = $('#copy_news_id').val();    
    var team_id = $('#copy_team_id').val();    
    var tab_index = $('.nav-tabs > li.active').index();
    if(team_id == 0 && tab_index == 1){
        alert("Please Select Team");
    }else{
        var params = '&news_id='+news_id+'&team_id='+team_id+'&tab_index='+tab_index;
        var url = SITEURL + 'dashboard/copy_news'; 
        $.ajax({
            data:params,
            url:url,
            type:'post'
        }).done(function(getdata){
            if(getdata == true){
                $('#myCopyModal').modal('hide');    
                $('#message_success').css({'display':''});
                $('#message_text').text("Copied successfully !");    
                $('#message_success').delay(3000).fadeOut(400);
            }else{
                $('#myCopyModal').modal('hide');    
                $('#message_success').css({'display':''});
                $('#message_text').text("News already copied !");    
                $('#message_success').delay(3000).fadeOut(400);
            }
        });
    }
});

$(document).on('click','.btn_edit_fantasy_news',function(){
    fantasy_click = true;
    article_click = false;
    var id = $(this).data("id");
    var title = $('#f_title_'+id).text();
    var url = $('#f_title_'+id).attr('href');
    var summary = $('#f_summary_'+id).html();
    var img_url = $('#f_image_'+id).attr("src");
    var ori_img_url = $('#f_rss_image_'+id).val();
    if(ori_img_url == ''){
        ori_img_url = ASSETS + "Artboard1.png";
    }

    $('#original_news_image').attr("src", ori_img_url);
    $('#rss_title').html($('#f_rss_title_'+id).val());
    $('#rss_summary').html($('#f_rss_summary_'+id).val());
    $('#rss_url').html($('#f_rss_url_'+id).val());

    $('#edit_tab_index').val(tab_index);
    $('#edit_news_id').val(id);
    $('#edit_news_title').val(title);
    $('#edit_news_summary').val(summary);
    $('#edit_news_url').val(url);
    $('#news_image').attr("src", img_url);
     $('#news_image_url').val(img_url);

    $('#myModal').modal('show');

});


$(document).on('click','.btn_edit_article_news',function(){
    article_click = true;
    fantasy_click = false;
    var id = $(this).data("id");
    var title = $('#a_title_'+id).text();
    var url = $('#a_title_'+id).attr('href');
    var summary = $('#a_summary_'+id).html();
    var img_url = $('#image_'+id).attr("src");
    var ori_img_url = $('#a_rss_image_'+id).val();
    if(ori_img_url == ''){
        ori_img_url = ASSETS + "Artboard1.png";
    }

    $('#original_news_image').attr("src", ori_img_url);
    $('#rss_title').html($('#a_rss_title_'+id).val());
    $('#rss_summary').html($('#a_rss_summary_'+id).val());
    $('#rss_url').html($('#a_rss_url_'+id).val());


    $('#edit_tab_index').val(tab_index);
    $('#edit_news_id').val(id);
    $('#edit_news_title').val(title);
    $('#edit_news_summary').val(summary);
    $('#edit_news_url').val(url);
    $('#news_image').attr("src", img_url);

    $('#myModal').modal('show');

});


$(document).on('click','#btn_update',function(e){ 
    var control  = $('#news_img'); 
    e.preventDefault();
    var news_leagues_id = $('.news_leagues').val();
    var news_team_id = $('#news_league_id').val(); 
    var tab_indexs = $('.nav-tabs > li.active').index();
    var news_league_team = $('#news_league_id').val();
    

        if(((news_leagues_id == 0) || (news_leagues_id == null))  && (tab_indexs==0 || tab_indexs==4) ) {
            alert("Please Select league");   
    
        }else if(((news_team_id == 0) || (news_team_id == null))  && (tab_indexs==0 || tab_indexs==4) ) { 

            alert("Please Select Team"); 
        }else{
            var id = $('#edit_news_id').val()
            var title = $('#edit_news_title').val();
            var summary = $('#edit_news_summary').val();
            var source = $('#edit_news_source').val(); 
            var news_url  = $('#edit_news_url').val();
            var form = document.forms.namedItem("fileinfo");
            var fd = new FormData(form);                
            var tab_index = $($('.nav-tabs a').attr('href')).index();

            var url = SITEURL + 'dashboard/update_news';                             
                $.ajax({
                url:url,
                data:fd,
                type: "POST",
                cache: false,
                contentType: false,
                processData: false,
                success: function(data){ 

            //console.log(data);
                    $('.imgareaselect-outer,.imgareaselect-selection,.imgareaselect-border1,.imgareaselect-border2,.imgareaselect-border3,.imgareaselect-border4,.imgareaselect-handle').hide();
            //document.getElementById("news_img").value = "";
                    if(data != '' && data != 'false' && data.indexOf("false") == -1){
                        $('#image_'+id).attr("src", data); 
                    }

                    $('#myModal').modal('hide');   

                    if(tab_indexs ==0){
                        $('#title_'+id).text(title);
                        $('#summary_'+id).text(summary);
                        $('#news_source_'+id).text(source);              
                        $('#title_'+id).attr("href", news_url);
                    }else if(tab_indexs ==2){
                        $('#f_title_'+id).text(title);
                        $('#f_summary_'+id).text(summary);
                        $('#f_title_'+id).attr("href", news_url);
                    }else if(tab_indexs ==4){
                        $('#title_'+id).text(title);
                        $('#summary_'+id).text(summary);
                        $('#news_source_'+id).text(source);              
                        $('#title_'+id).attr("href", news_url);
                        $('#btn_edit_'+id).data("team_id",news_league_team);
                        //$('#image_'+id).attr("src", data);
                    }else{
                        $('#a_title_'+id).text(title);
                        $('#a_summary_'+id).text(summary);
                        $('#a_title_'+id).attr("href", news_url);
                    }
                    $('#hide_edited_news_'+id).hide();
                    $('#edited_news_'+id).css({'display':''});
                    $('#message_success').css({'display':''});    
                    $('#message_success').delay(3000).fadeOut(400);  

                },
                error: function(data){
                    console.log(data);
                }
            });

        }
});

$(document).on('click','#btn_add_news',function(e){
    var control  = $('#news_img'); 
    e.preventDefault();   
    var form = document.forms.namedItem("Addfileinfo");
    var fd = new FormData(form);                
    var tab_index = $('.nav-tabs > li.active').index();

    var url = SITEURL + 'dashboard/add_news/'+tab_index;                             
    $.ajax({
        url:url,
        data:fd,
        type: "POST",
        cache: false,
        contentType: false,
        processData: false,
        success: function(data){
            $('#myAddNewsModel').modal('hide');   
          },
          error: function(data){
            console.log(data);
          }
    });
});

$('#txt_player_name').keyup(function(){
    var url = SITEURL + 'dashboard/get_player_suggestion';                             
    $.ajax({
        type: "POST",
        url: url,
        data:'keyword='+$(this).val(),
        success: function(data){
            $('#suggesstion-box').show();
            $('#country-list').html('');           
            $.each(data,function(i,row){                
               var list =  '<li id="select_list_name" data-name="'+row.name_full+'" data-code="'+row.code+'">'+row.name_full+'</li>';
               $('#country-list').append(list);
            });
           
        }
    });
    
}); 

$(document).on('click', '#select_list_name', function(){
    var name = $(this).data("name");
    var code = $(this).data("code");
    $('#txt_player_name').val(name);
    $('#txt_player_code').val(code);
    $('#suggesstion-box').hide();
});

$(document).on('click','#btn_add_player_news',function(e){
    var control  = $('#news_img'); 
    e.preventDefault();   
    var form = document.forms.namedItem("addPlayerNews");
    var fd = new FormData(form);                
    var tab_index = $('.nav-tabs > li.active').index();

    var url = SITEURL + 'dashboard/add_player_news/'+tab_index;                             
    $.ajax({
        url:url,
        data:fd,
        type: "POST",
        cache: false,
        contentType: false,
        processData: false,
        success: function(data){
            $('#edit_form').find('input:text').val(''); 
            $('#myAddPlayerNewsModel').modal('hide');   
          },
          error: function(data){
            console.log(data);
          }
    });
});

$(document).on('click','.btn_publish_news',function(){
    var news_id = $(this).data("id");
    var team_id=0;
    var timer = 100;
    var tab_index = $('.nav-tabs > li.active').index();            
    if(tab_index == 0 || tab_index ==1 || tab_index ==4){
        var url = SITEURL + 'dashboard/newspublished/'+news_id+'/'+tab_index;  
    }else if(tab_index == 2){
        var url = SITEURL + 'dashboard/newspublishedfantasy/'+news_id+'/'+tab_index;
    }else if(tab_index == 3){
        var url = SITEURL + 'dashboard/newspublishedarticle/'+news_id+'/'+tab_index;
    }
    
    if(tab_index==4){
        var team_check_url = SITEURL + "dashboard/get_rss_news_detail/"+news_id+"/4";
        timer = 2000;
        $.ajax({
            url:team_check_url
        }).done(function(getdata){
            team_id = getdata[0].team_id;
        });
    }
    
    setTimeout(function(){
        if(team_id!=null && team_id == 0 && tab_index==4){ 
            alert("Please edit and update team!");
            return false;
        }
        var r = confirm("Do you want to publish ?");
        if(r==true){
            $.ajax({
            url:url,
            type:'post'
            }).done(function(getdata){
                $('#message_success').css({'display':''});
                $('#message_text').text("Published Successfully !");    
                $('#message_success').delay(3000).fadeOut(400);
                if(tab_index == 0 || tab_index == 1 || tab_index == 4){
                    $('#btn_publish_'+news_id).addClass("disabled");  
                    $('#btn_publish_'+news_id).children('span').css({"color":"#6E6E6E"});                                   
                    $('#publish_news_'+news_id).css({'display':''});
                    var cnt = $('.publish_count > span').text();
                    cnt = parseInt(cnt)+1;
                    $('.publish_count > span').text(cnt);

                }else if(tab_index == 2){
                    $('#btn_publish_'+news_id).addClass("disabled");
                    $('#btn_publish_'+news_id).children('span').css({"color":"#6E6E6E"});                                     
                    $('#publish_news_'+news_id).css({'display':''});
                }else if(tab_index == 3){
                    $('#btn_publish_'+news_id).addClass("disabled");  
                    $('#btn_publish_'+news_id).children('span').css({"color":"#6E6E6E"});                                     
                    $('#publish_news_'+news_id).css({'display':''});
                }
            });
        }
    }, timer);
    

}); 



$(document).on('click','.btn_notify_news',function(){
    var news_id = $(this).data("id");
    var level = $(this).data("level");
    var tab_index = $('.nav-tabs > li.active').index();      
    var url = SITEURL + 'dashboard/push_content/'+news_id+'/'+tab_index+'/'+level;
    var team_id=0;
    var timer = 100;

    if(tab_index==4){
        var team_check_url = SITEURL + "dashboard/get_rss_news_detail/"+news_id+"/4";
        timer = 2000;
        $.ajax({
            url:team_check_url
        }).done(function(getdata){
            team_id = getdata[0].team_id;
        });
    }



    setTimeout(function(){
        if(team_id!=null && team_id == 0 && tab_index==4){ 
            alert("Please edit and update team!");
            return false;
        }
        var r = confirm("Do you want to Notify?");
        if(r==true){
            $('#btn_publish_'+news_id).addClass('disabled');
            $('#btn_publish_'+news_id).children('span').css({"color":"#6E6E6E"});              
            $('#btn_notify_'+news_id).addClass("disabled");
            $('#btn_notify_'+news_id).children('span').css({"color":"#6E6E6E"});
            $('#publish_news_'+news_id).css({'display':''});
            $('#notify_news_'+news_id).css({'display':''});

            var cnt = $('.publish_count > span').text();
            cnt = parseInt(cnt)+1;
            $('.publish_count > span').text(cnt);

            $.ajax({
                url:url,
                type:'post'
            }).done(function(getdata){
            console.log(getdata);       
           });
         } 
    }, timer);

});

/* When the user clicks on the button, 
toggle between hiding and showing the dropdown content */
function myFunction(th) {
    //document.getElementsByClassName("myDropdown").classList.toggle("show");
    $('.myDropdown').switchClass('show','hide');
    $(th).next('.myDropdown').switchClass('hide','show');
    //alert($(th).next('.myDropdown').attr('class')+"Clicked")
}

// Close the dropdown if the user clicks outside of it
window.onclick = function(event) {
  if (!event.target.matches('.dropbtn')) {

    var dropdowns = document.getElementsByClassName("dropdown-content");
    var i;
    for (i = 0; i < dropdowns.length; i++) {
      var openDropdown = dropdowns[i];
      if (openDropdown.classList.contains('show')) {
        openDropdown.classList.remove('show');
      }
    }
  }
}



$('body').tooltip({
selector: '.btn_tooltip',

});


$(document).on('click', '.btn_hide_news', function(){
    var news_id = $(this).data("id");
    var tab_index = $('.nav-tabs > li.active').index();
    var url = SITEURL + 'dashboard/hide_kroo_news/'+news_id+'/'+tab_index;    

    var r = confirm("Do you want to hide ?");
    if(r==true)
    {
        $.ajax({
            url : url,
            type : 'post'
        }).done(function(getdata){

            if(getdata=='kroo'){
                $('#k_news_'+news_id).hide();
            }
            else{
                $('.f_news_'+news_id).hide();
            }                
        });
    }
});



// inline: true,
// showOtherMonths: true,
// dateFormat: 'yy-mm-dd',
// dayNamesMin: ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'],
$(".datepicker1").datepicker({
    dateFormat: "yy-mm-dd",
    //minDate: 0,
    inline: true,
    dayNamesMin: ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'],
    showOtherMonths: true,
    onSelect: function (date) {
        var parDivID = $('.nav-tabs > li.active > a').attr('href');
        var dt2 = $(parDivID +' .datepicker2');
        var startDate = $(this).datepicker('getDate');
        var minDate = $(this).datepicker('getDate');
        $(parDivID + ' .datepicker1').datepicker('setDate', date);
        dt2.datepicker('setDate', minDate); 
        dt2.datepicker('option', 'minDate', minDate);
        //$(this).datepicker('option', 'minDate', minDate);
    }
});

$('.datepicker2').datepicker({
    dateFormat: "yy-mm-dd",
    onSelect:function(date){
        var parDivID = $('.nav-tabs > li.active > a').attr('href');
        $(parDivID + ' .datepicker2').datepicker('setDate', date);
    }
});



$(document).on('click','#btn_get_date',function(e){

    e.preventDefault();
    stop_ajax = 'undefined';
    var tab_index = $('.nav-tabs > li.active').index();
    var parDivID = $('.nav-tabs > li.active > a').attr('href');
    var first = $(parDivID+" .datepicker[name=datepicker1]").val();
    var second = $(parDivID+" .datepicker[name=datepicker2]").val();
    first = first +' ' + '00:00:00';
    second = second +' ' + '23:59:00';

    var prms = '&from_date='+ first + '&to_date='+ second;
    var league=$.trim($(parDivID+' .select_league_text').text());
    if(league!='Select League' && league!='All League'){
        var leagueId = $(parDivID+' .select_league[data-name='+league+']').data('id');
        prms += '&leagueId='+leagueId;
        if(leagueId >0){
            var teamId = '';
            var team=$.trim($(parDivID+' .select_team_text').text());
            if(team!='Select Team'){
                teamId = $(parDivID+' .select_team[data-name="'+team+'"]').data('id');
            }
            prms += '&teamId='+teamId;
        }
    }
    var news_type = '';
    var news_tp=$.trim($(parDivID+' .select_news_type').text());
    if(news_tp!='Select News'){
        news_type = $(parDivID+' .get_publish[data-name="'+news_tp+'"]').data('id');
    }
    prms+='&news_type='+news_type;
    // List the ajax
    getList(prms,tab_index,0);
});




$(document).on('click','.get_publish',function(e){

    e.preventDefault();
    stop_ajax = 'undefined';
    var tab_index = $('.nav-tabs > li.active').index();
    var parDivID = $('.nav-tabs > li.active > a').attr('href');
    var news_type = $(this).data("id");
    var type_name = $(this).data("name");
    var prms = '';
    var league=$.trim($(parDivID+' .select_league_text').text());
    if(league!='Select League' && league!='All League'){
        var leagueId = $(parDivID+' .select_league[data-name='+league+']').data('id');
        prms = '&leagueId='+leagueId;
        if(leagueId >0){
            var teamId = '';
            var team=$.trim($(parDivID+' .select_team_text').text());
            if(team!='Select Team'){
                teamId = $(parDivID+' .select_team[data-name="'+team+'"]').data('id');
            }
            prms += '&teamId='+teamId;
        }
    }
    var news_type = $(this).data("id");
    prms+='&news_type='+news_type;
    // List the ajax
    getList(prms,tab_index,0);

    $(parDivID+' button.select_news_type').text(type_name);
    $(parDivID+' button.select_news_type').append(' <span class="caret">');
});




$(document).on('click','.checkall', function(){
    var $this = $(this);

    checked = $this.prop('checked');

    cbs = $this.closest('table').find('.checkbox');

    cbs.prop('checked', checked);

    cbs.closest('tr').toggleClass('selected', checked);
});

$(document).on('click', '#mass_publish', function(){
        var myarray = []; 
        $('input[name="locationthemes"]:checked').each(function() {                   
            myarray.push(this.value);
        });
        var tab_index = $('.nav-tabs > li.active').index();
        var url = SITEURL + "dashboard/mass_publish";

        $.ajax({
            url : url,
            data :{
                ids : myarray,
                tab_index : tab_index
            },
            type : 'post'
        }).done(function(getdata){

            if(getdata == true){

                $('#message_success').css({'display':''});
                $('#message_text').text("Published Successfully !");    
                $('#message_success').delay(3000).fadeOut(400);

                $.each(myarray, function(i,row){

                    if(tab_index == 0 || tab_index == 4){
                        $('input:checkbox').removeAttr('checked');
                        $('#btn_publish_'+row).addClass("disabled");                       
                        $('#publish_news_'+row).css({'display':''});
                    }else if(tab_index == 2){
                        $('input:checkbox').removeAttr('checked');
                        $('#btn_publish_'+row).addClass("disabled");                       
                        $('#publish_news_'+row).css({'display':''});
                    }else if(tab_index == 3){
                        $('input:checkbox').removeAttr('checked');
                        $('#btn_publish_'+row).addClass("disabled");                       
                        $('#publish_news_'+row).css({'display':''});
                    }

                });
            }



        });                
});


$(document).on('click','#title_read_news',function(){
    var news_id = $(this).data("id");
    var url = SITEURL + "dashboard/news_read_activity";

    $.ajax({
        url : url,
        data : {
            news_id : news_id,
            tab_index : tab_index
        },
        type:'post'
    }).done(function(getdata){
        console.log(getdata);
    });
});


function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#news_image').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
}

$("#news_img").change(function () {
    readURL(this);
});


$(document).on('change', '.news_leagues', function(){
    var league_id = $(this).find('option:selected').data("id");
    var url = SITEURL + "dashboard/select_news_league/"+league_id;
    $.ajax({
        url:url
    }).done(function(getdata){
        $('#add_news_team').html('');
        $('#add_news_team').append('<option value="0">Select Team</option>');
        $('#news_league_id').html('');
        $('#news_league_id').append('<option value="0">Select Team</option>');

        $.each(getdata.team,function(i,row){                           
            var all_league_team = '<option value="'+row['league_team_id']+'">'+row['league_team_name']+'</option>';                               
            $('#add_news_team').append(all_league_team);
            $('#news_league_id').append(all_league_team);                        
        });
    });
});

$(document).on('change', '.game_leagues', function(){
    var league_id = $(this).find('option:selected').data("id");
    var url = SITEURL + "dashboard/select_news_league/"+league_id;
    $.ajax({
        url:url
    }).done(function(getdata){
        $('#add_game_team').html('');
        $('#add_game_team').append('<option value="0">Select Team</option>');

        $.each(getdata.team,function(i,row){                           
            var all_league_team = '<option value="'+row['league_team_id']+'">'+row['league_team_name']+'</option>';                               
            $('#add_game_team').append(all_league_team);
        });
    });
});



$(document).on('click','#btn_detail_update',function(e){
    for ( instance in CKEDITOR.instances ) {
        CKEDITOR.instances[instance].updateElement();
    }
 
    e.preventDefault();
    var form = document.forms.namedItem("detailInfo");
    var fdetail = new FormData(form);               

    var url = SITEURL + 'dashboard/update_news_detail';                             
    $.ajax({
        url:url,
        data:fdetail,
        type: "POST",
        cache: false,
        contentType: false,
        processData: false,
        success: function(data){
            //console.log(data);

            $('#myDetailModal').modal('hide');  

          },
          error: function(data){ 
            console.log(data);
          }
    });
});




$(document).on('click','.btn_detail_news',function(){
    var id = $(this).data("id"); 
    var title = $('#title_'+id).text();
    $('#m_news_detail').html(title);
    $('#detail_id').val(id);
    var tab_index = $('.nav-tabs > li.active').index(); 
    
    var get_detail = SITEURL + 'dashboard/get_detail/'+id+'/'+tab_index;
    var editor = CKEDITOR.instances['editor1'];
    if (editor) { editor.destroy(true); }
        $.ajax({
            url: get_detail,
            async: false,
            type: "POST",
            data: "type=article",
            dataType: "html",
            success: function(data) { 
                    
                    var posts = JSON.parse(data); 
                    if(posts != null){
                         $('#editor1').val(posts[0].details); 
                         CKEDITOR.replace( 'editor1');
                    }else{
                         CKEDITOR.replace( 'editor1' );
                    }     
            }
         })

        $('#myDetailModal').modal('show');    

});




$(document).on('click','.btn_game_add_news',function(){ 

    $('form[id="gameAdd"]')[0].reset(); 
     var id = $(this).data("id"); 
     var News_team_id = $(this).data("team_id"); 
     var title = $('#title_'+id).text();
     var href = $('#title_'+id).attr('href'); 
     var summary = $('#summary_'+id).text();
     var imgSrc = $('#image_'+id).attr('src');
     var imgsrcgame=teamlogo.replace('teamlogo','newsimages');
     var newsImgGame='';

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


      var news_id = $(this).data("id"); 

      var url = SITEURL + 'game/get_news_id/'+news_id; 
      $.ajax({
            url : url,
            type : 'post'
        }).done(function(getdata){ 

            if(getdata[0]['news_id'] !=null){  
                $.each(getdata,function(i,row){ 

                    var txt="Edit Game";
                    $('#add').text(txt); 
                    var team_id=row['team'];
                    var options=row['options'];
                    var time_to_live=row['time_to_live'];
                    var time_to_lives= time_to_live.split(":");
                    var time_to_live_hour=time_to_lives[0];
                    var time_to_live_min=time_to_lives[1];
                    var time_to_publish=row['time_to_publish'];
                    var time_to_answer=row['time_to_answer'];
                    var time_to_answers= time_to_answer.split(":");
                    var time_to_ans_min=time_to_answers[1]; 
                    var time_to_ans_sec=time_to_answers[2]; 
                    var game_type=row['game_type'];
                    var difficulty=row['difficulty'];
                    if(row['images']!=''){
                        imgSrc = imgsrcgame+row['images'];
                        newsImgGame = row['images'];
                    }

                    var qustion= '<textarea id="question" name="question" class="form-control" placeholder="question" rows="3" maxlength="500" value="" onKeyDown="limitText(this,100);" onKeyUp="limitText(this,300);">'+row['questions']+'</textarea>';  
                    var ans_opt1 ='<span>1</span><input id="ansTxtOpt1" name="ans_opt1" placeholder="option1" class="" type="text" value="'+row['ans_opt1']+'" style="height: 35px; margin-left: 12px;width: 383px; border: 1px solid #ccc; border-radius: 4px;" onKeyDown="limitText(this,40);" onKeyUp="limitText(this,100);" >';
                    var ans_opt2 ='<span>2</span><input id="ansTxtOpt2" name="ans_opt2" placeholder="option2" class="" type="text" value="'+row['ans_opt2']+'" style="height: 35px; margin-left: 12px;width: 383px; border: 1px solid #ccc; border-radius: 4px;" onKeyDown="limitText(this,40);" onKeyUp="limitText(this,100);" >';
                    var ans_opt3 ='<span>3</span><input id="ansTxtOpt3" name="ans_opt3" placeholder="option3" class="" type="text" value="'+row['ans_opt3']+'" style="height: 35px; margin-left: 12px;width: 383px; border: 1px solid #ccc; border-radius: 4px;" onKeyDown="limitText(this,40);" onKeyUp="limitText(this,100);" >';
                    var ans_opt4 ='<span>4</span><input id="ansTxtOpt4" name="ans_opt4" placeholder="option4" class="" type="text" value="'+row['ans_opt4']+'" style="height: 35px; margin-left: 12px;width: 383px; border: 1px solid #ccc; border-radius: 4px;" onKeyDown="limitText(this,40);" onKeyUp="limitText(this,100);" >';
                    var qus_id='<input type="hidden" value="'+row['id']+'" name="id" id="qus_id">';
                    var credits='<select name="credits" id="credits" class="form-control"></select> ';
                    var link='<input id="linkid" name="link" placeholder="Link" class="form-control input-md" type="text" value="'+row['link']+'">';
                    var exp='<textarea id="explanation_answer" class="form-control" rows="3" maxlength="500" name="exp_answer">'+row['explaination']+'</textarea>';
                    $('select[name="sponser"] option[value="'+row['sponser']+'"]').attr('selected','selected');
                    $('select[name="news_league_id"] option[value="'+row['league']+'"]').attr('selected','selected');
                    $('select[name="TTL-hour"] option[value="'+time_to_live_hour+'"]').attr('selected','selected');
                    $('select[name="TTL-min"] option[value="'+time_to_live_min+'"]').attr('selected','selected');
                    $('select[name="TTA-sec"] option[value="'+time_to_ans_sec+'"]').attr('selected','selected');
                    $('select[name="select_game_category"] option[value="'+game_type+'"]').attr('selected','selected'); 
                    if(game_type=='1'){
                        $('#difficulty_block').css({'display':'block'});
                        $('select[name="select_difficulty"] option[value="'+difficulty+'"]').attr('selected','selected');  
                    }else{
                        $('#difficulty_block').css({'display':'none'});
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
                            var slct = (team_id =='0')?'selected':'';
                            $('#add_game_team').append('<option  value="0" '+slct+'>All Teams</option>');
                            $.each(getdata.team,function(i,row){
                                if(row['league_team_id'] == team_id){ 
                                    var all_league_team = '<option value="'+row['league_team_id']+'" selected>'+row['league_team_name']+'</option>';  
                                }else{
                                    var all_league_team = '<option  value="'+row['league_team_id']+'">'+row['league_team_name']+'</option>';   
                                }
                                $('#add_game_team').append(all_league_team);
                            });
                       }

                    }); 

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
                    $('#qustions').html(qustion);
                    $('#option_1').html(ans_opt1);
                    $('#option_2').html(ans_opt2);
                    $('#option_3').html(ans_opt3);
                    $('#option_4').html(ans_opt4);
                    $('#hiddenId').html(qus_id);
                    $('#creditpnt').html(credits);
                    $('#link').html(link);
                    $('#exp').html(exp);
                    $('#news_id').val(id); 
                    $('.thumbnl').attr('src', imgSrc);     
                    $('input[name="news_img"]').val(newsImgGame); 
                });
                //alert(getdata[0]['status']);
                if(getdata[0]['status']=='2'){
                    $.each($('#myAddModal').find('input,select,textarea,button'),function(){
                        $(this).attr('disabled','disabled');
                    });
                    $('#myAddModal').find('.close,.btn-default').removeAttr('disabled');
                }else{
                    $.each($('#myAddModal').find('input,select,textarea,button'),function(){
                        $(this).removeAttr('disabled');
                    });
                }

                $('#credits').html('');
                for(var i=1;i<=getdata[0]['max_credits'];i++){
                    var slct = (getdata[0]['credits']==i)?' selected':'';
                    var credits = '<option  value="'+i+'"'+slct+'>'+i+'</option>';  
                    $('#credits').append(credits);
                }

            } else{
                var txt="Add Game";
                $('#gameAdd').find('input:text').val(''); 
                $('#difficulty_block').css({'display':'none'});
                $('#ques_hint').css({'display':'none'});
                $('#credits').html('');
                for(var i=1;i<=getdata[0]['max_credits'];i++){
                    var credits = '<option  value="'+i+'">'+i+'</option>';  
                    $('#credits').append(credits);
                }
                if(News_team_id==0){
                    $.ajax({
                        url:SITEURL + 'game/get_league_team/'+news_id,                 
                    }).done(function(getdata){
                      if(getdata !=null){
                            if(getdata.league_id > 0){
                                $('select[name="news_league_id"] option[value="'+getdata.league_id+'"]').attr('selected','selected');
                            }
                            $('#add_game_team').children().remove();
                            $('#add_game_team').append('<option  value="0">All Teams</option>');
                            $.each(getdata.team,function(i,row){ 
                                var all_league_team = '<option  value="'+row['league_team_id']+'">'+row['league_team_name']+'</option>';   
                                $('#add_game_team').append(all_league_team);
                            });
                       }
                    });
                }else{
                    var team_url = SITEURL + 'dashboard/get_news_team_detail/'+News_team_id; 
                    $.ajax({
                      url:team_url,                    
                    }).done(function(getdata){
                        if(getdata !=null){
                            if(getdata.league_id > 0){
                                $('select[name="news_league_id"] option[value="'+getdata.league_id+'"]').attr('selected','selected');
                            }
                            $('#add_game_team').children().remove();
                            $('#add_game_team').append('<option  value="0">All Teams</option>');
                            $.each(getdata.team,function(i,row){ 
                                if(row['league_team_id'] == News_team_id){ 
                                    var all_league_team = '<option value="'+row['league_team_id']+'" selected>'+row['league_team_name']+'</option>';  
                                }else{
                                    var all_league_team = '<option  value="'+row['league_team_id']+'">'+row['league_team_name']+'</option>';   
                                }
                                $('#add_game_team').append(all_league_team);
                           });
                        }
                    });
                }

                $('#add').text(txt); 
                $('#news_id').val(id); 
                $('#question').val(title); 
                $('#explanation_answer').text(summary); 
                $('#linkid').val(href);   
                $('.thumbnl').attr('src', imgSrc);    
                newsImgGame = imgSrc.replace(imgsrcgame,'');
                $('input[name="news_img"]').val(newsImgGame); 
                $('#datepicker').val(currentDate);
                $('#datetimepicker3').val(currentTime);

                $.each($('#myAddModal').find('input,select,textarea,button'),function(){
                    $(this).removeAttr('disabled');
                });
            }
        });
    createUploader('btn_game_add_news');
    $('#thumbnail').imgAreaSelect({ aspectRatio: '16:9', onSelectChange: preview, parent: '#imgModal'});
    $('#myAddModal').modal('show');

});


  $(document).on("click","#submit_form,#submit_publish_form ,#submit_now_form",function(e){

    var publish_id = $( this ).val();
    $('#publish_id').val(publish_id);
    /*if(publish_id==2 || publish_id==3){
      $('#message_success_publish').css({'display':''});
      $('#message_success_publish').delay(3000).fadeOut(400);
    }*/        

    var news_id = $('#news_id').val();
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
    var news_leagues = $('.game_leagues').val();  
    var news_team = $('#add_news_team').val();
    var TTL_hour = $('#TTL-hour').val(); 
    var TTL_min = $('#TTL-min').val(); 
    var TTA_sec = $('#TTA-sec').val();
    var publishdate = $('#datepicker').val();
    var publishtime = $('#datetimepicker3').val();
    var radiobtn_check_one=$('#option1').is(':checked');  
    var radiobtn_check_two=$('#option2').is(':checked');
    var radiobtn_check_three=$('#option3').is(':checked');
    var radiobtn_check_four=$('#option4').is(':checked');  
   /* var game_cat = $('#select_game_category').val();
    var game_difficulty = $('#select_difficulty').val();      
    alert(game_cat + '/' + game_difficulty);
    return false;*/
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
    }else if (news_team ==0) {
          alert("fill team");
    }else if (link ==0 || link ==""){
          alert("fill link");
    }else if (explanation ==0 || explanation ==""){
           alert("fill explanation");
    /*}else if ( (TTL_hour ==0) && (TTL_min ==0) ){
           alert(" select time to live");  */  
     }else if  (TTA_sec ==0){
           alert(" select time to answer");           
     /*}else if ( (publishdate ==0) && (publishdate =="") ){
           alert(" select publish date");              
     }else if ( (publishtime ==0) && (publishtime =="") ){
           alert(" select  publish time"); */             

    } else{ 

        var url = SITEURL + 'game/get_news/'+news_id;   
    
      $.ajax({
            url : url,
            type : 'post'
        }).done(function(getdata){ 

            if(getdata ==""){ 

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
                        // location.reload();
                        if(publish_id==0){         
                          $('#message_success_insert').css({'display':''});
                          $('#message_success_insert').delay(3000).fadeOut(400);
                        }             
                    });

            }else{  

                    e.preventDefault();
                    $('.error').html('');               
                   // var ele   = $('#gameAdd');
                    var url   = SITEURL + 'game/game_qustions_update';
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
                        // location.reload();
                        if(publish_id==0){         
                            $('#message_success_update').css({'display':''});
                            $('#message_success_update').delay(3000).fadeOut(400);
                        }              
                    });

            }

        });
     }   

  });

   function limitText(limitField, limitNum) {
    if (limitField.value.length > limitNum) {
        limitField.value = limitField.value.substring(0, limitNum);
    }
  }


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
  });




