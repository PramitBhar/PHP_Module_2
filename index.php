<?php
require_once "vendor/autoload.php";
use GuzzleHttp\Client;
include 'FetchApiData.php';
$fetched_data = new FetchApiData();
$fetched_data->setApiData();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Advance 1</title>
  <style>
    <?php include "index.css"; ?>
  </style>
</head>
<body>
<section class="main-section">
  <div class="container">
    <?php for($i=0;$i<count($fetched_data->heading);$i++) { ?>
    <div class="item">
      <div class="image-class">
        <img src = "<?= $fetched_data->hero_images[$i] ?>">
      </div>
      <div class="info-box">
        <p class="heading"> <?= $fetched_data->heading[$i] ?> </p>
        <div class="icons">
          <?php foreach ($fetched_data->icons[$i] as $icon_path) : ?>
            <img class="icon-images" src=<?= $icon_path ?>>
            <?php endforeach; ?>
          </div>
          <!-- Details -->
          <div class="details">
            <?= $fetched_data->details[$i]; ?>
          </div>
          <div class="explore-btn">
            <span class="btn-text">Explore More</span>
          </div>
        </div>
    </div>
    <?php } ?>
  </div>
</section>
</body>
<link rel="stylesheet" href="index2.css">
</html>

