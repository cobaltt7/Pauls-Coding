<?php
$imgs = glob("../../wp-content/gallery/*/*.{jpg,JPG,jpeg,JPEG}", GLOB_BRACE);
?>
<!DOCTYPE html>
<html lang="en" hreflang="en">

<body style="margin:0;background:rgb(176,176,176);text-align:center">
	<img style="max-width:100vw;max-height:100vh" src="<?php $imgs[array_rand($imgs)] ?>">
</body>

</html>';
