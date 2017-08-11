<?php
/**
 * 留言操作装饰类
 * 留言本业务逻辑类，用于实现留言操作的逻辑,比如同步记录操作日志
 * 注：此处只是做个演示，只在添加留言时添加log日志，真实情况可能更复杂
 */

class MsgDecorate
{
	public function write(MsgBox $mb, $msg)
	{
		$book = $mb->getBookPath();
		
		if($mb->write($msg))
		{
			// 记录日志
			// echo $book,'新增1条留言<br>';
		}
	}
}
