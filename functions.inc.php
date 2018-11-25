<?php

function append($filename,$string,$file_pointer=NULL,$open=true,$close=true)
{
	if($open || $file_pointer === NULL)
	{
		$file_pointer=fopen($filename,"a");
	}
	fwrite($file_pointer,$string);
	if($close)
	{
		$file_pointer=fopen($filename,"a");
	}	
}
function absolute_path($path_from_docroot)
{
	$path = $_SERVER['DOCUMENT_ROOT'];
	$path.= $path_from_docroot;
	return($path);
}