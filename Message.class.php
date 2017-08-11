<?php
/**
* 留言内容类
* 包含功能有：留言的属性定义(设置或者获取属性值)
*/

class Message 
{
	public $name;
	public $email;
	public $content;

	public function __set($name, $value)
	{
		$this->$name = $value;
	}

	public function __get($name)
	{
		if(! isset($this->$name))
		{
			return $this->$name;
		}

		return NULL;
	}
}