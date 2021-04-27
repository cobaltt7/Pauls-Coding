<?php
$design['title']       = 'Home';
$design['description'] = "A list of all of Paul Reid's coding projects.";
$design['keywords']    = 'home, root, welcome';
$design['LEFT']        = <<<__END
<h1>Hello, and welcome!</h1>Here is a list of all my coding that I have been doing in the languages<ul><li class="html"> HTML <span class="notBold">(web pages)</span></li><li class="css"> CSS <span class="notBold">(web formatting)</span></li><li class="js"> JavaScript <span class="notBold">(client-side scripting)</span></li><li class="php"> PHP <span class="notBold">(server-side scripting)</span></li><li class="mysql"> MySQL <span class="notBold">(databases)</span></li><li class="jquery"> jQuery <span class="notBold">(compressed JavaScript)</span></li></ul>
__END;
require_once 'twoColumnDesign.php';
