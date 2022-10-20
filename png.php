<?php
// Creates a PNG image with a countdown to an event
// Usage: png.php?date=2022-12-25&event=Christmas
// Marcus Wynwood (MarcusTeachUs.com)
// 2022-10-21

date_default_timezone_set("Australia/Hobart");

// Get the data from the querystring
$date = strtotime($_GET['date']);
$event = $_GET['event'];

// Sanatize the input
$date = filter_var($date, FILTER_SANITIZE_STRING);
$event = filter_var($event, FILTER_SANITIZE_STRING);

// Calculate the time remaining
$remaining = $date - time();
$days_remaining = floor($remaining / 86400);
$hours_remaining = floor(($remaining % 86400) / 3600);

// Build the output string
$text = "There are " . $days_remaining . " days until " . $event;

// Create the image
$width = strlen($text) * 8.2; // each letter is on average 8.2px wide
$height = 18;
$img = imagecreate($width, $height);
$background_color = imagecolorallocate($img, 255, 255, 255);
$text_color = imagecolorallocate($img, 0, 0, 0);
$font = 4;
imagestring($img, $font, 2, 0, $text, $text_color);

// Output the image
header('Content-type: image/png');
imagepng($img);
imagedestroy($img);
?>
