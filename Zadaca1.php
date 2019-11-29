<?php
$prva=fopen("files/prva.txt","rw") or die("Unable to open file!");

$rezultat=fopen("files/rezultat.txt","w") or die("Unable to open file!");
fwrite($rezultat,fread($prva,filesize("files/prva.txt")));
$vtora=fopen("files/vtora.txt","r") or die("Unable to open file!");
fwrite($rezultat,fread($vtora,filesize("files/vtora.txt")));
file_put_contents("files/prva.txt",str_replace('-',' ',file_get_contents("files/prva.txt")));
fclose($prva);
fclose($vtora);
fclose($rezultat);
?>
