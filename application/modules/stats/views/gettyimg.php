<div class="wrapper row-offcanvas row-offcanvas-left">
    <div style="margin-top:60px;">
        <div style="width:100%; padding:20px;">
            <h1>Getty</h1>
            <form role="form" name="frm">
              <div class="form-group">
                <label for="email">Email address:</label>
                <input type="text" class="form-control" id="serch">
              </div>
              <button type="submit" class="btn btn-default">Submit</button>
            </form>
            
            <div id="resultList" class="form-group" style="border:1px solid #cccccc; padding:10px; margin-top:20px; clear:both; color:#cccccc;"> Result Here! 
                <img src="<?php echo NOTIFICATION_API_PATH; ?>getimage2?folder=0&imagename=news.jpg">
            </div>

        </div>
    </div>
</div>

<script type="text/javascript">

    $('[name="frm"]').submit(function(){
        var srch = $('#serch').val();
        srch = (srch)?srch:'dog';
        var request = createCORSRequest("get", NOTIFICATION_API_PATH."getty/getimg?search_text="+srch);
        if (request){
            request.onload = function(){
                //do something with request.responseText
                var result = JSON.parse(request.responseText);
                //alert(result.payload.images.length);
                var x=0;
                var str='';
                $.each(result.payload.images,function(k,val){
                    str+='<div class="form-group" style="width:15%; height:200px; margin:5px; padding:10px; border:1px solid #CCC; text-align:center; float:left;"> <img src="'+ val.display_sizes[0].uri +'" style="max-width:100%; max-height:100%;"><br>'+ val.id +'</div>'
                    x++;
                    if(x<=1){
                       // alert(val.display_sizes[0].uri);
                    }
                        
                });
                str+='<div style="clear:both;"></div>';
                $('#resultList').html(str);
            };
            request.send();
        }
        return false;
    });

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


</script>