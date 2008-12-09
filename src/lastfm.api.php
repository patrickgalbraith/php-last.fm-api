<?

/* Autoload classes */
function __autoload($name){
	if(stripos($name, 'Cache') !== false){
		$filename = realpath(sprintf("%s/cache/%s.php", dirname(__FILE__), $name));
	}
	else{
		$filename = realpath(sprintf("%s/%s.php", dirname(__FILE__), $name));
	}

	if(file_exists($filename) && is_file($filename)){
		require_once $filename;
	}
	else{
		throw new Exception("File '".$filename."' not found!");
	}

	if(!class_exists($name, false) && !interface_exists($name, false)){
		throw new Exception("Class '".$name."' not found!");
	}
}

?>