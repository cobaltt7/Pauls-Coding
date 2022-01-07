<?php
$design['title']       = "Miscellaneous Coding Files";
$design['description'] = "Miscellaneous Coding Files: bookmarklet, userscript/style, sandboxes, and et cetera";
$design['keywords']    = 'bookmarklet, userscript, userstyle, sandboxes, new tab, miscellaneous, other';
$design['showInclude'] = '.';
$design['LEFT']        = <<<_END
<h1>Miscellaneous Coding Files</h1>
<h2>bookmarklets, userscripts/styles, sandboxes, etc.</h2>
Here I keep 'other' files.
<ul>For example, there's some files related to my browser, such as:
<li class="php">a custom new tab page</li>
<li class="js">a bookmarklet</li>
<li class="js">a userscript</li>
<li class="css">or userstyle<span class="notBold">.</span></li>
In addition, there's
<li class="html">sandboxes<span class="notBold">, which I use for testing small things out</span></li>
and
<li class="css">custom CSS<span class="notBold"> or</span></li>
<li class="js">JavaScript<span class="notBold"> files for my blog so I can change what it looks like.</span></li>
</ul>
_END;
require_once "../twoColumnDesign.php";
