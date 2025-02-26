--TEST--
DOM\HTMLDocument Shift JIS encoding test
--EXTENSIONS--
dom
--FILE--
<?php

$dom = DOM\HTMLDocument::createFromFile(__DIR__ . "/shift_jis.html");
var_dump($dom->encoding);
$dom->documentElement->firstChild->nextElementSibling->textContent .= "é";
$output = $dom->saveHTML();
echo $output, "\n";
$dom->saveHTMLFile(__DIR__ . "/shift_jis.tmp");
var_dump(file_get_contents(__DIR__ . "/shift_jis.tmp") === $output);

echo "--- After changing encoding to UTF-8 ---\n";
$dom->encoding = "UTF-8";
echo $dom->saveHTML(), "\n";

?>
--CLEAN--
<?php
@unlink(__DIR__ . "/shift_jis.tmp");
?>
--EXPECT--
string(9) "Shift_JIS"
<!DOCTYPE html><html><head>
<meta charset="shift_jis">
</head>
<body>
    �₠
?</body></html>
bool(true)
--- After changing encoding to UTF-8 ---
<!DOCTYPE html><html><head>
<meta charset="shift_jis">
</head>
<body>
    やあ
é</body></html>
