<?php


class savePDF{


public $path;
public $register_no;

function save_folder($path){

if (!file_exists($path)) {


    $css_path=$path.'marksheet.scss';
    mkdir($path, 0777, true);
    copy("marksheet.scss",$css_path);


}
}


function run_pdf($path){
	$shell_command = 'cd '.$path.' && ..\..\..\..\..\generate.bat';
	$output = shell_exec($shell_command);
}

function run_pdf_once($path,$register_no) {
	$shell_command = 'cd '.$path.' && relaxed --bo '.$register_no.'.pug';
	$output = shell_exec($shell_command);
}
}
?>
