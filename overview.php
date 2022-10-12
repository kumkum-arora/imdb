<?php

if (isset($_REQUEST['key'])) {
    $key = $_REQUEST['key'];

    // rapid api for showing rating, overview , runing time.....
    $curl = curl_init();

    curl_setopt_array($curl, [
        CURLOPT_URL => "https://imdb8.p.rapidapi.com/title/get-overview-details?tconst=$key",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => [
            "X-RapidAPI-Host: imdb8.p.rapidapi.com",
            "X-RapidAPI-Key: a225a545cemsh4dbf4fca6bb7247p171c89jsn55c1aa39fa46"
        ],
    ]);

    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

    if ($err) {
        echo "cURL Error #:" . $err;
    } else {
        $dec = json_decode($response, true);
    }
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>imdb</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="s3.css" />
</head>

<body>
    <!-- header starts here -->
    <div class="header1">
        <div class="innerheader1">
            <!-- header ends here -->
        </div>
    </div>
    <div class="maincon">
        <div class="maincon1">
            <div class="small1">

                <img src="<?php echo $dec['title']['image']['url']  ?>" alt="" class="image" srcset="">
            </div>
            <div class="small2">
                <div class="tit"><label><?php echo $dec['title']['titleType'] ?> : </label>
                    <?php echo $dec['title']['title'] ?>
                </div>
                <div class="tit2"><label>Release date : </label>
                    <?php if (!empty($dec['releaseDate'])) echo $dec['releaseDate'] ?>
                </div>
                <div class="tit2"><label>Ratings : </label>
                    <?php if (!empty($dec['ratings']['rating'])) echo $dec['ratings']['rating'] ?>
                </div>
                <div class="tit2"><label>Running Time : </label>
                    <?php if (!empty($dec['title']['runningTimeInMinutes']))  echo $dec['title']['runningTimeInMinutes'] ?> Minutes
                </div>
                <div class="tit2"><label>Overview : </label>
                    <?php if (!empty($dec['plotSummary']['text'])) echo $dec['plotSummary']['text'] ?>
                </div>
            </div>
        </div>
    </div>
</body>

</html>