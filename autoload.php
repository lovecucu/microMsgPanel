<?php
/**
 * [_autoload_ 自动加载函数注册]
 * @param  [type] $class [description]
 * @return [type]        [description]
 */
function _autoload_($class)
{
	$classPath = dirname(__FILE__) . DIRECTORY_SEPARATOR . $class.'.class.php';
	if(file_exists($classPath))
	{
		include $classPath;
	}
	else
	{
		exit("File {$classPath} not exist!");
	}
}

spl_autoload_register('_autoload_');