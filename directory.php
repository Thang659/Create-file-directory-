<html>
<head>
<title>Task 5a</title>
<style>
.bg {
    background-image: url("college.jpg");
    height: 100%; 
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;
}
</style>
</head>
<body>
<div class="bg"></div>
<?php
// A function that will traverse a directory tree, looking for files that match a given regular expression, and returns all files:
function find($regex, $dir) {
    $matches = array();
 // open up the directory and prepare to start looping:
    $d = dir($dir);
 // Loop through all the files:
    while (false !== ($file = $d->read())) {
        if (($file == '.') || ($file == '..')) { continue; }
 // If this is a directory, then:
        if (is_dir("{$dir}/{$file}")) {
            // Call this function recursively to look in that subdirectory:
            $submatches = find($regex,     "{$dir}/{$file}");
            // Add them to the current match list:
            $matches = array_merge($matches, $submatches);
        } else {
            // It's a file, so check to see if it is a match:
            if (preg_match($regex, $file)) {
                // Add it to our array:
                $matches[] = "{$dir}/{$file}";
            }
        }
    }
 // Ok, that's it, return the array now:
    return $matches;
}
 // Look for all PHP files on your website, starting with the document root:
$found = find('/\.php$/', $_SERVER['DOCUMENT_ROOT']);
sort($found);
echo '<pre>', print_r($found, true), '</pre>';
?>

</body></html>