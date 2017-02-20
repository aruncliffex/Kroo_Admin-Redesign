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


$(function () {
$(".example1").DataTable({
        "order": [[ 0, "desc" ]]
    });
// $('#example2').DataTable({
//   "paging": true,
//   "lengthChange": false,
//   "searching": false,
//   "ordering": true,
//   "info": true,
//   "autoWidth": false
// });
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

var table= [];
var getList = function(params,tab_index,lmt){
    //alert(getCookie('statsFLTR'));
    var parDivID = $('.nav-tabs > li').eq(tab_index).find('a').attr('href');
    if(typeof params == 'undefined' || params==''){
        if(getCookie('statsFLTR',tab_index)!=''){
            params = getCookie('statsFLTR',tab_index);
            getValueSelected(getCookie('statsFLTR',tab_index),tab_index);
        }
    }
    setCookie('statsFLTR', params, '60',tab_index);

    var url = SITEURL + "stats/kroo_stats";
    
    params+="&tab_index="+tab_index;       
    
    $('#message_loading').css({'display':''});
    $('#message_loading').delay(3000).fadeOut(400);
    table[tab_index]=$(parDivID+" .example12").DataTable();
    table[tab_index].destroy();
    $.ajax({
        url : url,
        data : params,
        type : 'post',
        success:function(response){
            //$(parDivID+' #listTYPE'+tab_index).val('');
            $(parDivID+' .kroo_data_table > tbody').html('');
            $(parDivID+' .kroo_data_table > tbody').html(response);                                        
            $('#message_loading').hide();
            getReport(params,tab_index); // get league stats
            getTodayReport(params,tab_index)
            table[tab_index]=$(parDivID+" .example12").DataTable();
        }
    });
}

var getReport = function(params,tb){
    var parDivID = $('.nav-tabs > li').eq(tb).find('a').attr('href');
    var url = SITEURL + "stats/league_stats";
    
    $.ajax({
        url : url,
        data : params,
        type : 'post',
        datatype : 'html',
        success:function(response){
            $(parDivID+' .cronReports').html(JSON.parse(response));    
        }
    });
}


var getTodayReport = function(params,tb){
    var date = new Date();
    var yyyy = date.getFullYear().toString();
    var mm = (date.getMonth()+1).toString();
    var dd  = date.getDate().toString();
    var mmChars = mm.split('');
    var ddChars = dd.split('');
    var today = yyyy + '-' + (mmChars[1]?mm:"0"+mmChars[0]) + '-' + (ddChars[1]?dd:"0"+ddChars[0]);
    var parDivID = $('.nav-tabs > li').eq(tb).find('a').attr('href'); 
    var url = SITEURL + "stats/league_stats";
    
    params+="&from_date="+today;
    
    $.ajax({
        url : url,
        data : params,
        type : 'post',
        datatype : 'html',
        success:function(response){
            $(parDivID+' .cronReportsToday').html(JSON.parse(response));    
        }
    });
}

$(document).on('click','.select_league',function(){
    var league_id = $(this).data("id");
    var tab_index = $('.nav-tabs > li.active').index();
    var parDivID = $('.nav-tabs > li.active > a').attr('href');
    $(parDivID +' button.select_league_text').text($(this).data("name"));
    $(parDivID +' button.select_league_text').append(' <span class="caret">');
    $(parDivID +' .kroo_data_table > tbody').html('');


    var prms = '&leagueId='+league_id;
    // List the ajax
    getList(prms,tab_index,0);
});


$(document).on('click','#btn_get_date',function(e){

    e.preventDefault();
    stop_ajax = 'undefined';
    var tab_index = $('.nav-tabs > li.active').index();
    var parDivID = $('.nav-tabs > li.active > a').attr('href');
    var first = $(parDivID+" .datepicker[name=datepicker1]").val();    
    first = first;
   

    var prms = '&from_date='+ first;
    var league=$.trim($(parDivID+' .select_league_text').text());
    if(league!='Select League'){
        var leagueId = $(parDivID+' .select_league[data-name='+league+']').data('id');
        prms += '&leagueId='+leagueId;
        
    }
   
    // List the ajax
    getList(prms,tab_index,0);
});


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

        }
        
        if(str2[0]=='from_date'){
            $(parDivID+' input.datepicker1 ').val(str2[1]);
        }

    });
}


function goBack() {
    window.history.back();
}