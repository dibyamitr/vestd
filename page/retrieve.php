<?php
$shortcode=$_REQUEST['shorturl'];
$url = $fn->baseurl('api/v1/cd8b3804baa648d4fa3b8f9e6f4ef993/call-full-url');
$post=array(
    "shortcode"=>$shortcode
);
$response = json_decode($fn->curlResponse('POST', $url, $post));
?>
<html>
    <head>
        <title>URL Shortener</title>
    </head>
    <body style="text-align:center;">
        <h1>URL Shortener</h1>
        <p class="shorturlcontainer">
        <?php
        if($response->status==200)
        {
            echo "Retrieved URL is <strong>".$response->data."</strong>";
        }
        else
        {
            echo $response->msg;
        }
        ?>
        </p>
        <?php
        if($response->status==200)
        {
            ?>
            <p>Please wait while redirecting to the URL in 5 seconds</p>
            <?php
        }
        ?>
    </body>
    <?php
    if($response->status==200)
    {
        ?>
        <script>
            function redirect()
            {
                window.location.href='<?php echo $response->data; ?>';
            }
            window.setTimeout(redirect,5000);
        </script>
        <?php
    }
    ?>
</html>