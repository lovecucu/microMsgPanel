<?php
/**
 * 留言本类
 * 包含功能有：完成对留言操作的过程
 */

class MsgBox
{
	private $bookPath; //留言本的文件
	private $data; // 留言的内容

	public function getBookPath()
	{
		return $this->bookPath;
	}

	public function setBookPath($bookPath)
	{
		if(! file_exists($bookPath))
		{
			touch($bookPath);
		}
		$this->bookPath = $bookPath;
	}

	// 获取全部留言
	public function read() 
	{
		return file_get_contents($this->bookPath);
	}

	// 分页读取留言版
	public function readByPage($pnum)
	{
		$handle = file($this->bookPath, FILE_SKIP_EMPTY_LINES);
		$count = count($handle);
		$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
		$pageMax = ceil($count/$pnum);
		if($page < 1 || $page > $pageMax) $page = 1;
		$pnum = intval($pnum);
		$begin = $pnum * ($page-1);

		$content = "<p>".nl2br(implode(PHP_EOL, array_slice($handle, $begin,$pnum)))."</p>";
		$content.= "<p>";
		for($i=1;$i<=$pageMax;$i++)
		{
			if($i==$page)
			{
				$content.= "<a href='?page={$i}' style='color:red;padding:10px;'> {$i} </a>";
			}
			else
			{
				$content.= "<a href='?page={$i}' style='padding:10px;'> {$i} </a>";
			}

		}
		$content.= "</p>";
		return $content;
	}

	// 写入留言
	public function write(Message $data)
	{
		$safeData = self::safe($data); // 获取消除后患的老面板
		$this->data = '【'.$safeData->name.'&'.$safeData->email.'】 said:'.PHP_EOL.$safeData->content.PHP_EOL;
		return file_put_contents($this->bookPath, $this->data, FILE_APPEND);
	}

	// 对留言数据的安全过滤
	public static function safe(Message $data)
	{
		$reflect = new ReflectionObject($data);
		$props = $reflect->getProperties();
		$messageBox = new stdClass();
		foreach($props as $prop)
		{
			$ivar = $prop->getName();
			$messageBox->$ivar = trim($prop->getValue($data));
		}

		return $messageBox;
	}

	public function delete()
	{
		return file_put_contents($this->bookPath, '');
	}
}
