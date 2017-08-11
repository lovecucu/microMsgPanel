<?php
/**
 * 留言管理类
 * 包含功能有：写留言，查看留言，删除留言
 */

class MsgManager
{
	public function write(MsgDecorate $md, MsgBox $mb, $msg)
	{
		// 写留言
		$md->write($mb, $msg);
	}

	public function view(MsgBox $mb)
	{
		// 看留言
		$msg = $mb->read();
		return $msg ? nl2br($msg) : '留言本为空';
	}

	public function viewByPage(MsgBox $mb, $pnum=6)
	{
		// 分页浏览
		return $mb->readByPage($pnum);
	}

	public function delete(MsgBox $mb)
	{
		// 删除留言
		return $mb->delete();
	}
}