<html>
    <head>
        <title>URL Shortener</title>
    </head>
    <body style="text-align:center;">
        <h1>Retrieve URL Tracking Status</h1>
        <p>Please paste your Short URL and click on the button to check the tracking status</p>
        <br />
        <input type="text" class="url" name="url" />
        <button type="button" class="urltrack">Submit</button>
        <p class="waitclause" style="display:none;">Please wait...!</p>
        <p class="shorturlcontainer"></p>
        <script src="<?php echo $fn->baseurl('assets/jquery.min.js'); ?>"></script>
        <script>
            $('.urltrack').on('click',function(){
                var url=$('.url').val();
                $('.waitclause').show();
                $.post("<?php echo $fn->baseurl('ajax/urltrack.php'); ?>",{'shorturl':url},function(data){
                    var response=JSON.parse(data);
                    $('.waitclause').hide();
                    if(response.status==200)
                    {
                        $('.shorturlcontainer').html('The full url is : <strong>'+response.data.url+'</strong>. The URL is looked up by <strong>'+response.data.track_status+'</strong> times');
                    }
                    else
                    {
                        $('.shorturlcontainer').html(response.msg);
                    }
                });
            });
        </script>
    </body>
</html>