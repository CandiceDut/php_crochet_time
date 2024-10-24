<?php
header('Content-Type: image/jpeg');


$im = $_GET['image'];
$image = "Images/" . $im;

// Vérifiez si le fichier existe
if (!file_exists($image)) {
    die("Image introuvable : " . $image);
}

list($width, $height, $type) = getimagesize($image);

if ($type === false) {
    die("Le type d'image n'est pas valide.");
}

$newWidth = 150;  // Largeur cible (peut être ajustée)
$newHeight = 150;  // Hauteur cible (peut être ajustée)

$image_p = imagecreatetruecolor($newWidth, $newHeight);

// Sélectionner la source en fonction du type d'image
switch ($type) {
    case IMAGETYPE_JPEG:
        $source = imagecreatefromjpeg($image);
        break;
    case IMAGETYPE_PNG:
        $source = imagecreatefrompng($image);
        break;
    case IMAGETYPE_GIF:
        $source = imagecreatefromgif($image);
        break;
    default:
        die('Format d\'image non supporté');
}

// Redimensionner l'image
imagecopyresampled($image_p, $source, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);

// Afficher l'image en fonction de son type
switch ($type) {
    case IMAGETYPE_JPEG:
        imagejpeg($image_p);
        break;
    case IMAGETYPE_PNG:
        imagepng($image_p);
        break;
    case IMAGETYPE_GIF:
        imagegif($image_p);
        break;
}

imagedestroy($image_p);
imagedestroy($source);
?>