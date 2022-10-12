<?php

if (!empty($_GET['search'])) {
    $item = $_GET['item'];

    $curl = curl_init();
    // Rapid api for search movies
    curl_setopt_array($curl, [
        CURLOPT_URL => "https://imdb8.p.rapidapi.com/auto-complete?q=$item",
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

        $decoded = json_decode($response, true);
    }
} else {

    $curl = curl_init();
    // Rapid api for display movies on index page
    curl_setopt_array($curl, [
        CURLOPT_URL => "https://imdb8.p.rapidapi.com/auto-complete?q=jatt",
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

        $deco = json_decode($response, true);
    }
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>IMDB design</title>
    <link rel="stylesheet" href="s3.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bree+Serif&family=Paytone+One&family=Roboto+Condensed:ital,wght@0,700;1,700&display=swap" rel="stylesheet">
</head>

<body>
    <!-- header starts here -->
    <div class="header">
        <div class="innerheader">
            <div class="text"><img src="imdb-logo.jpg" class="text5"></div>
            <ul>
                <li class="dropdown">
                    <a href="javascript:void(0)" class="dropbtn">menu</a>
                    <div class="dropdown-content">
                        <a href="#">Movies</a>
                        <a href="#">Cartoons</a>
                        <a href="#">TvSeries</a>
                        <a href="#">Shows</a>
                        <a href="#">Awards<span>and</span><span>Events</span></a>
                        <a href="#">Community</a>
                    </div>
                </li>
            </ul>
            <form method="get" action="">
                <input type="text" name="item" placeholder="Search IMDb" class="input">
                <input type="submit" name="search" value="Search" class="search">
            </form>
            <div class="text6">IMDb<span>Pro</span></div>
            <div class="line"></div>
            <div class="text7"><span>watchlist</span></div>
            <div class="text7"><span>sign in </span></div>
            <div class="text7"><select>
                    <option value="" selected>EN</option>
                    <option value="public">English</option>
                    <option value="private">Punjabi</option>
                    <option value="private">Hindi</option>
                </select></div>
        </div>
    </div>
    <!-- header ends here -->
    <!-- div for displaying search items -->
    <div class="main">
        <!-- div for centerlised-->
        <div class="main1">
            <?php
            if (!empty($_GET['search'])) {
                for ($m = 0; $m < 9; $m++) {
            ?>
                    <a href="overview.php?key=<?php echo $decoded['d'][$m]['id'] ?>">
                        <!-- div for showing search items in cards -->
                        <div class="small">
                            <?php if (!empty($decoded['d'][$m]['i']['imageUrl'])) {
                            ?>
                                <img src="<?php echo $decoded['d'][$m]['i']['imageUrl'] ?>" alt="" height="470px" width="400px">
                            <?php } else { ?>
                                <img src="pic.jpg" alt="" height="470px" width="400px">
                            <?php } ?>
                    </a>
                    <div class="title"><label>Movie : </label>
                        <?php if (!empty($decoded['d'][$m]['l'])) echo $decoded['d'][$m]['l'] ?>
                    </div>
                    <div class="title2"><label>Actors : </label>
                        <?php if (!empty($decoded['d'][$m]['s'])) echo  $decoded['d'][$m]['s'] ?>
                    </div>
                    <div class="title2"><label>Published Year : </label>
                        <?php if (!empty($decoded['d'][$m]['y'])) echo $decoded['d'][$m]['y']  ?>
                    </div>
        </div>
    <?php
                }
            } else {
                for ($m = 0; $m < 8; $m++) {
    ?>
        <a href="overview.php?key=<?php echo $deco['d'][$m]['id'] ?>">
            <div class="small">
                <img src="<?php echo $deco['d'][$m]['i']['imageUrl'] ?>" alt="" height="470px" width="400px">
        </a>
        <div class="title"><label>Movie : </label>
            <?php echo " " . $deco['d'][$m]['l'] . " "; ?>
        </div>
        <div class="title2"><label>Actors : </label>
            <?php echo " " . $deco['d'][$m]['s'] . " "; ?>
        </div>
        <div class="title2"><label>Published Year : </label>
            <?php echo " " . $deco['d'][$m]['y'] . " "; ?>
        </div>
    </div>
<?php
                }
            }
?>
</div>
</div>
</body>

</html>