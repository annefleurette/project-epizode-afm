<?php
// Mettre en couleur une chaîne de caractère
function highlightKeyword($keyword, $text)
{
    $text = preg_replace("/\p{L}*?".preg_quote($keyword)."\p{L}*/ui", "<span style=\"background-color: yellow\">$0</span>", $text);
    return $text;
}
?>