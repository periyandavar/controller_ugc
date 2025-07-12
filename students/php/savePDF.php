<?php
class savePDF{
public $path;
function save_folder($path){
if (!file_exists($path)) {
    $css_path=$path.'hallticket.scss';
    mkdir($path, 0755, true);
    copy("hallticket.scss",$css_path);
}
}
function run_pdf($path){
	$shell_command = 'cd '.$path.' && ..\..\..\..\..\generate.bat';
	$output = shell_exec($shell_command);
}
}
?>
