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
            $.each(response,function(k,val){
                var teams = '<li><a class="select_team" data-id="'+val['league_team_id']+'" data-name="'+val['league_team_name']+'" href="javascript:void(0);">'+
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
                var player = '<li><a class="select_player" data-name_abbr="'+val['player_name_abbr']+'" data-name="'+val['player_name']+'" href="javascript:void(0);">'+
                        '<img style="background:white;-moz-border-radius: 70px;-webkit-border-radius: 70px; border-radius: 70px;" class="exSp" src="'+ teamlogo +val['player_name']+'" width="35px">'+
                        '<span>'+val['player_name']+'</span>'+
                        '</a></li>';

                    $(parDivID +' #select_player').append(player);
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
        if(str2[0]=='news_type'){
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
    }
    var url = SITEURL + "dashboard/kroo_news_listing";
    if(tab_index == 3){
        var url = SITEURL + "dashboard/waiver_news_listing";
    }else if(tab_index == 2){
        var url = SITEURL + "dashboard/player_news_listing";
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
    getList('',3,0);
    getList('',2,0);
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
});

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
    if(tab_index=='0' || tab_index=='2'){
        get_team(league_id);
    }

    var prms = '&leagueId='+league_id;
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
    if(league!='Select League'){
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
    if(league!='Select League'){
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




$(document).on('click','.btn_edit_news',function(){
    var id = $(this).data("id");
    var news_at = $('#kroo_news_at_'+id).html();
    var title = $('#title_'+id).text();
    var url = $('#title_'+id).attr('href');
    var summary = $('#summary_'+id).html();
    var img_url = $('#image_'+id).attr("src");
    var news_source = $('#news_source_'+id).html();
    var ori_img_url = $('#rss_image_'+id).val();
    var activity_detail = $('#activity_detail_'+id).html();
    if(ori_img_url == '' || ori_img_url == 'noimage'){
        ori_img_url = ASSETS + "Artboard1.png";
    }else{
        ori_img_url = $('#image_'+id).attr("src");
    }
    $('#edit_league_team').css({'display' : 'none'});
    var tab_index = $('.nav-tabs > li.active').index();
    if(tab_index == 0){
        $('#edit_league_team').css({'display' : 'flex'});
        var team_id = $(this).data("team_id");
        var team_url = SITEURL + 'dashboard/get_news_team_detail/'+team_id; 

        $.ajax({
            url:team_url,                    
        }).done(function(getdata){
            $.each(getdata.team,function(i,row){

                if(row['league_team_id'] == team_id){
                    var all_league_team = '<option value="'+row['league_team_id']+'" selected>'+row['league_team_name']+'</option>';    
                }else{
                    var all_league_team = '<option value="'+row['league_team_id']+'">'+row['league_team_name']+'</option>';    
                }
                 $('#news_league_id').append(all_league_team);

            });

        });  
    }


    $('#rss_title').html($('#rss_title_'+id).val());
    $('#rss_summary').html($('#rss_summary_'+id).val());
    $('#rss_url').html($('#rss_url_'+id).val());
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
    $('#news_image_url').val(img_url);
    $('#edit_news_source').val(news_source);

    $('#myModal').modal('show');

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
    var id = $('#edit_news_id').val()
    var title = $('#edit_news_title').val();
    var summary = $('#edit_news_summary').val();
    var source = $('#edit_news_source').val(); 
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
            document.getElementById("news_img").value = "";
            if(data != 'false' && data.indexOf("false") == -1){
                $('#image_'+id).attr("src", data);
            }

            $('#myModal').modal('hide');   

            if(tab_index ==0){
                $('#title_'+id).text(title);
                $('#summary_'+id).text(summary);
                $('#news_source_'+id).text(source);
            }else if(tab_index ==2){
                $('#f_title_'+id).text(title);
                $('#f_summary_'+id).text(summary);
            }else{
                $('#a_title_'+id).text(title);
                $('#a_summary_'+id).text(summary);
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
});


$(document).on('click','.btn_publish_news',function(){
    var news_id = $(this).data("id");
    var tab_index = $('.nav-tabs > li.active').index();            
    if(tab_index == 0 || tab_index ==1){
        var url = SITEURL + 'dashboard/newspublished/'+news_id+'/'+tab_index;    
    }else if(tab_index == 2){
        var url = SITEURL + 'dashboard/newspublishedfantasy/'+news_id+'/'+tab_index;
    }else if(tab_index == 3){
        var url = SITEURL + 'dashboard/newspublishedarticle/'+news_id+'/'+tab_index;
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
            if(tab_index == 0 || tab_index == 1){
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

}); 



                $(document).on('click','.btn_notify_news',function(){
                    var news_id = $(this).data("id");
                    var tab_index = $('.nav-tabs > li.active').index();      
                    var url = SITEURL + 'dashboard/push_content/'+news_id+'/'+tab_index;
                     var r = confirm("Do you want to Notify?");
                    if(r==true)
                    {
                        $('#btn_publish_'+news_id).addClass('disabled');
                        $('#btn_publish_'+news_id).children('span').css({"color":"#6E6E6E"});              
                        $('#btn_notify_'+news_id).addClass("disabled");
                        $('#btn_notify_'+news_id).children('span').css({"color":"#6E6E6E"});
                        $('#publish_news_'+news_id).css({'display':''});
                        $('#notify_news_'+news_id).css({'display':''});

                        var cnt = $('.publish_count > span').text();
                        cnt = parseInt(cnt)+1;
                        $('.publish_count > span').text(cnt);

                        // var notify_cnt = $('.notify_count > span').text();
                        // notify_cnt = parseInt(cnt)+1;
                        // $('.notify_count > span').text(notify_cnt);

                        $.ajax({
                            url:url,
                            type:'post'
                        }).done(function(getdata){
                        console.log(getdata);       
                        /*if(getdata.ios_arn.length > 0){
                                    var params = '&ios_arn='+ getdata.ios_arn + '&content='+getdata.content;
                                    $.ajax({
                                        url: 'http://apidev.cliffex.com/ios_push',
                                        data : params,
                                        headers:{'Access-Control-Allow-Origin':'*' },
                                        type : 'post'
                                    }).done(function(data){
                                        console.log(data);
                                    });
                                }*/
                        });
                    }
                });



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
        //startDate.setDate(startDate.getDate() + 30);
        //sets dt2 maxDate to the last day of 30 days window
        //dt2.datepicker('option', 'maxDate', startDate);
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
    if(league!='Select League'){
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
    if(league!='Select League'){
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

// $('tr').on('click', function () {
//     var $this = $(this).toggleClass('selected');
//     $this.find('.checkbox').prop('checked', $this.hasClass('selected'));
//     if(!$this.hasClass('selected')) {
//         $this.closest('table').children('thead').find('.checkall').prop('checked', false); 
//     }
// });

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

                    if(tab_index == 0){
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


$(document).on('click', '#select_news_league', function(){
    var league_id = $(this).data("id");
    var url = SITEURL + "dashboard/select_news_league/"+league_id;
    $.ajax({
        url:url
    }).done(function(getdata){
        $('#news_league_id').html('');
        $('#news_league_id').append('<option value="0">Select Team</option>');
        $.each(getdata.team,function(i,row){                           
            var all_league_team = '<option value="'+row['league_team_id']+'">'+row['league_team_name']+'</option>';                               
            $('#news_league_id').append(all_league_team);                        
        });
    });
});