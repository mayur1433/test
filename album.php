<?php session_start();
if (isset($_SESSION['fb_access_token'])) {
    $url = "https://graph.facebook.com/v3.1/me?fields=id,name,gender,email,picture,cover&access_token=EAAGEmVZAmAZAsBABV2nAnBCi7A9j8zho8onmrxX2FGgFDwv4yreQybnFA0QCa6RZCENoP7yJaLa0xImLJDS1jZC33ZBZADH4yv7tYqfdicUZBUgTIgqRtSLQT2GVPOMfTNF6ZCFpDSkxhwohKATvOQolYXLZBuGSHHbXeU5AdybebLQZDZD";
    $headers = array("Content-type: application/json");
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_COOKIEJAR,'cookie.txt');
    curl_setopt($ch, CURLOPT_COOKIEFILE,'cookie.txt');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.3) Gecko/20070309 Firefox/2.0.0.3");
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    $st=curl_exec($ch);
    $result=json_decode($st,TRUE);
    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Page Title</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="css/mycss.css" />
        <!-- script src="main.js"></script> -->
    </head>
    <body class="body" background="#e2e1e0;">
    <header class="mainHeader">
        <nav><ul>
                <li class="active"><?php  echo "<img style=\"padding-right: 20px; height:30px; width:30px; padding-top:5px;\" src=".$result['picture']['data']['url'].">";?></li>
                <li style="padding-right: 20px;padding-top:8px"><a><?php echo $result['name'];?></a></li>
                <li><a href="./logout.php?logout=true">Logout</a></li>
            </ul></nav>
    </header>
    <?php
        $url1=file_get_contents("https://graph.facebook.com/v3.1/me?fields=albums%7Bphoto_count%2Cname%7D&access_token=EAAGEmVZAmAZAsBABV2nAnBCi7A9j8zho8onmrxX2FGgFDwv4yreQybnFA0QCa6RZCENoP7yJaLa0xImLJDS1jZC33ZBZADH4yv7tYqfdicUZBUgTIgqRtSLQT2GVPOMfTNF6ZCFpDSkxhwohKATvOQolYXLZBuGSHHbXeU5AdybebLQZDZD");
        $result1=json_decode($url1,true)['albums']['data'];
    ?>
    <div class="mainCard">
        <?php $i=0; foreach ($result1 as $values){ ?>
            <div class="card">
                <img src="https://graph.facebook.com/<?=$result1[$i++]['id']?>/picture?type=album&access_token=EAAGEmVZAmAZAsBABV2nAnBCi7A9j8zho8onmrxX2FGgFDwv4yreQybnFA0QCa6RZCENoP7yJaLa0xImLJDS1jZC33ZBZADH4yv7tYqfdicUZBUgTIgqRtSLQT2GVPOMfTNF6ZCFpDSkxhwohKATvOQolYXLZBuGSHHbXeU5AdybebLQZDZD" alt="Avatar" style="width:100%; height: 200px;">
                <div class="container">
                    <a href="logout.php?id=<?php echo $result1[$i-1]['id']?>"><h4><b><?php echo $result1[$i-1]['name']?></b></h4></a>
                    <p>Photos : <?php echo $result1[$i-1]['photo_count']?></p>
                </div>
            </div>
        <?php } ?>
    </div>
    <?php include_once 'footer.php';
} else {
    header('Location: ./');
} ?>