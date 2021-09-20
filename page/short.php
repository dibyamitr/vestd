<html>
    <head>
        <title>URL Shortener</title>
    </head>
    <body style="text-align:center;">
        <h1>URL Shortener</h1>
        <p>Please paste your URL and click on the button to shorten it</p>
        <br />
        <input type="text" class="url" name="url" />
        <button type="button" class="urlsubmit">Submit</button>
        <p class="waitclause" style="display:none;">Please wait...!</p>
        <p class="shorturlcontainer"></p>
    </body>
    <script src="<?php echo $fn->baseurl('assets/jquery.min.js'); ?>"></script>
    <script>
        $('.urlsubmit').on('click',function(){
            var url=$('.url').val();
            var expression = /[-a-zA-Z0-9@:%._\+~#=]{1,256}\.[a-zA-Z0-9()]{1,6}\b([-a-zA-Z0-9()@:%_\+.~#?&//=]*)?/gi;
            var regex = new RegExp(expression);

            if(url.match(regex))
            {
                $('.waitclause').show();
                $.post("<?php echo $fn->baseurl('ajax/urlshort.php'); ?>",{'shorturl':url},function(data){
                    var response=JSON.parse(data);
                    $('.waitclause').hide();
                    if(response.status==200)
                    {
                        $('.shorturlcontainer').html('The short url is : <strong>'+response.data+'</strong>');
                    }
                    else
                    {
                        $('.shorturlcontainer').html(response.msg);
                    }
                });
            }
            else
            {
                alert('Wrong URL Format');
                $('.url').val('');
            }
        });
    </script>
</html>