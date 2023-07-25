<?php
// Function to create an image from text
function createImageFromText($text, $fontFile, $fontSize, $imageWidth, $imageHeight, $textColor, $backgroundColor) {
    // Create the image with GD Library
    $image = imagecreatetruecolor($imageWidth, $imageHeight);

    // Allocate colors
    $textColor = imagecolorallocate($image, $textColor['red'], $textColor['green'], $textColor['blue']);
    $backgroundColor = imagecolorallocate($image, $backgroundColor['red'], $backgroundColor['green'], $backgroundColor['blue']);

    // Fill the background
    imagefilledrectangle($image, 0, 0, $imageWidth, $imageHeight, $backgroundColor);

    // Calculate the position to center the text
    $textBoundingBox = imagettfbbox($fontSize, 0, $fontFile, $text);
    $textWidth = $textBoundingBox[2] - $textBoundingBox[0];
    $textHeight = $textBoundingBox[1] - $textBoundingBox[7];
    $textX = ($imageWidth - $textWidth) / 2;
    $textY = ($imageHeight - $textHeight) / 2 + $textHeight;

    // Add the text to the image
    imagettftext($image, $fontSize, 0, $textX, $textY, $textColor, $fontFile, $text);

    // Generate the PNG image and output it to the browser
    header('Content-type: image/png');
    imagepng($image);

    // Free up memory
    imagedestroy($image);
}

// Check if the 'text' parameter exists in the URL
if (isset($_GET['text'])) {
    // Get the 'text' parameter from the URL
    $text = $_GET['text'];

    // Example usage:
    $fontFile = "REM-Regular.ttf"; // Replace with the path to your TTF font file
    $fontSize = 24;
    $imageWidth = 300;
    $imageHeight = 100;
    $textColor = array('red' => 0, 'green' => 0, 'blue' => 0); // Black color
    $backgroundColor = array('red' => 255, 'green' => 255, 'blue' => 255); // White color

    // Generate the image
    createImageFromText($text, $fontFile, $fontSize, $imageWidth, $imageHeight, $textColor, $backgroundColor);
} else {
    echo "Text parameter not provided.";
}
?>
