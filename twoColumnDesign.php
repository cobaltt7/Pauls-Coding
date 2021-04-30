<?php
if (basename(__FILE__) == basename($_SERVER["SCRIPT_FILENAME"])) {
	header("HTTP/1.1 403 Unauthorized");
	die("Forbidden");
}

if (array_key_exists('title', $design)) {
	$design['title'] .= " | Paul's Coding";
}

if (array_key_exists('keywords', $design)) {
	$design['keywords'] .= ', '; #just some formatting fixing for the keywords
}

if (!array_key_exists('RIGHT', $design)) {
	$design['RIGHT'] = '<ul id="list">';
	$filtered_dir    = array();
	$directory       = array_diff(scandir('.'), array('..', '.', 'error_log'));
	foreach ($directory as $folder) {
		if (array_key_exists('showInclude', $design) && strpos($folder, $design['showInclude']) > -1) {
			return;
		}

		if (array_key_exists('hideIs', $design) && $folder == $design['hideIs']) {
			return;
		}

		$filtered_dir[] = $folder;
	}

	sort($filtered_dir);
	foreach ($filtered_dir as $folder) {
		$design['RIGHT'] .= "<li><a href=\"$folder\">$folder</a></li>";
	}

	$design['RIGHT'] .= "</ul>";
	if (!array_key_exists("AFTER", $design) && array_key_exists('showInclude', $design)) {
		$design['AFTER'] = "<script>list('" . $design['showInclude'] . "', document.getElementById('list'));</script>";
	}
}

$design = array_merge(array("title" => "Paul's Coding", "description" => "Paul Reid's coding projects.", "keywords" => "", "AFTER" => "", "LEFT" => "", "RIGHT" => ""), $design); # default values to avoid errors
if (!array_key_exists("LEFT", $design)) {
	$design['LEFT'] = $design['description'];
}

$design['keywords'] .= "PHP, MySQL, HTML, Java, JavaScript, CSS, Coding, practice, robin nixon, blue, paul reid, paul, reid";
?>
<!DOCTYPE html>
<html lang="en" hreflang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title><?= $design['title'] ?></title>
	<meta name="description" content="<?= $design['description'] ?>">
	<meta name="robots" content="index, follow, max-snippet: -1, max-image-preview:large, max-video-preview: -1">
	<meta property="og:locale" content="en_US">
	<meta property="og:type" content="website">
	<meta property="og:description" content="<?= $design['description'] ?>">
	<meta property="og:site_name" content="Paul's Coding">
	<meta property="og:image" content="https://icon-library.com/images/three-gear-icon/three-gear-icon-14.jpg">
	<meta property="og:image:secure_url" content="https://icon-library.com/images/three-gear-icon/three-gear-icon-14.jpg">
	<meta property="og:image:width" content="256">
	<meta property="og:image:height" content="256">
	<meta name="twitter:card" content="summary_large_image">
	<meta name="twitter:description" content="<?= $design['description'] ?>">
	<meta name="twitter:site" content="Paul's Coding">
	<meta name="twitter:image" content="https://icon-library.com/images/three-gear-icon/three-gear-icon-14.jpg">
	<link rel="icon" href="https://icon-library.com/images/three-gear-icon/three-gear-icon-14.jpg" sizes="256x256">
	<link rel="apple-touch-icon-precomposed" href="https://icon-library.com/images/three-gear-icon/three-gear-icon-14.jpg">
	<meta name="msapplication-TileImage" content="https://icon-library.com/images/three-gear-icon/three-gear-icon-14.jpg">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
	<script src="https://kit.fontawesome.com/7ee5a2a00a.js" crossorigin="anonymous"> </script>
	<link rel="stylesheet/less" href="https://paul-s-reid.com/web-dev/style.less" />
	<script src="https://paul-s-reid.com/web-dev/script.min.js"> </script>
	<meta property="og:title" content="<?= $design['title'] ?>">
	<meta name="twitter:title" content="<?= $design['title'] ?>">
	<meta name="keywords" content="<?= $design['keywords'] ?>">
	<meta name="author" content="Paul Reid">
</head>

<body>
	<div id="content">
		<div class="column" id="left"><?= $design['LEFT'] ?></div>
		<div class="column" id="right"><?= $design['RIGHT'] ?></div>
	</div>
	<footer> <img src="https://icon-library.com/images/three-gear-icon/three-gear-icon-14.jpg" alt="Paul's Coding" id="footer-logo">
		<h1 id="footer-name">Paul's<br>Coding</h1>
		<div id="footer-links"> <a href="https://paul-s-reid.com/web-dev/">Home</a> | <a href="../">Up a level</a> | <a href="https://paul-s-reid.com/web-dev/other.php">Other Sites</a> </div>
	</footer>
	<?= $design['AFTER'] ?>
	<script src="https://cdn.jsdelivr.net/npm/less">
	</script>
</body>

</html>
