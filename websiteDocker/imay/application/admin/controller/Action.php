<?php
// +----------------------------------------------------------------------
// | SentCMS [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013 http://www.tensent.cn All rights reserved.
// +----------------------------------------------------------------------
// | Author: molong <molong@tensent.cn> <http://www.tensent.cn>
// +----------------------------------------------------------------------

namespace app\admin\controller;
use app\common\controller\Admin;

class Action extends Admin {

	/**
	 * 用户行为列表
	 * @author huajie <banhuajie@163.com>
	 */
	public function index() {
		$map = array('status' => array('gt', -1));

		$order = "id desc";
		//获取列表数据
		$list = model('Action')->where($map)->order($order)->paginate(10);

		// 记录当前列表页的cookie
		Cookie('__forward__', $_SERVER['REQUEST_URI']);
		$data = array(
			'list' => $list,
			'page' => $list->render(),
		);
		$this->assign($data);
		$this->setMeta('用户行为');
		return $this->fetch();
	}

	/**
	 * 新建用户行为
	 * @author colin <colin@tensent.cn>
	 */
	public function add() {
		$model = model('Action');
		if (IS_POST) {
			$data   = input('post.');
			$result = $model->save($data);
			if (false != $result) {
				action_log('add_action', 'Action', $result, session('user_auth.uid'));
				return $this->success('添加成功！', url('index'));
			} else {
				return $this->error($model->getError());
			}
		} else {
			$data = array(
				'keyList' => $model->fieldlist,
			);
			$this->assign($data);
			$this->setMeta("添加行为");
			return $this->fetch('public/edit');
		}
	}

	/**
	 * 编辑用户行为
	 * @author colin <colin@tensent.cn>
	 */
	public function edit($id = null) {
		$model = model('Action');
		if (IS_POST) {
			$data   = input('post.');
			$result = $model->save($data, array('id' => $data['id']));
			if ($result !== false) {
				action_log('edit_action', 'Action', $id, session('user_auth.uid'));
				return $this->success('编辑成功！', url('index'));
			} else {
				return $this->error($model->getError());
			}
		} else {
			$info = $model::where(array('id' => $id))->find();
			if (!$info) {
				return $this->error("非法操作！");
			}
			$data = array(
				'info'    => $info,
				'keyList' => $model->fieldlist,
			);
			$this->assign($data);
			$this->setMeta("编辑行为");
			return $this->fetch('public/edit');
		}
	}

	/**
	 * 删除用户行为状态
	 * @author colin <colin@tensent.cn>
	 */
	public function del() {
		$id = $this->getArrayParam('id');
		if (empty($id)) {
			return $this->error("非法操作！", '');
		}
		$map['id'] = array('IN', $id);
		$result    = db('Action')->where($map)->delete();
		if ($result) {
			action_log('delete_action', 'Action', $id, session('user_auth.uid'));
			return $this->success('删除成功！');
		} else {
			return $this->error('删除失败！');
		}
	}

	/**
	 * 修改用户行为状态
	 * @author colin <colin@tensent.cn>
	 */
	public function setstatus() {
		$id = $this->getArrayParam('id');
		if (empty($id)) {
			return $this->error("非法操作！", '');
		}
		$status    = input('get.status', '', 'trim,intval');
		$message   = !$status ? '禁用' : '启用';
		$map['id'] = array('IN', $id);
		$result    = db('Action')->where($map)->setField('status', $status);
		if ($result !== false) {
			action_log('setstatus_action', 'Action', $id, session('user_auth.uid'));
			return $this->success('设置' . $message . '状态成功！');
		} else {
			return $this->error('设置' . $message . '状态失败！');
		}
	}

	/**
	 * 行为日志列表
	 * @author huajie <banhuajie@163.com>
	 */
	public function log() {

		//获取列表数据
		$map['status'] = array('gt', -1);

		$order = "id desc";
		//获取列表数据
		$list = model('ActionLog')->where($map)->order($order)->paginate(10);

		$data = array(
			'list' => $list,
			'page' => $list->render(),
		);
		$this->assign($data);
		$this->setMeta('行为日志');
		return $this->fetch();
	}
	/**
	 * 查看行为日志
	 * @author huajie <banhuajie@163.com>
	 */
	public function detail($id = 0) {
		$model = model('ActionLog');
		if (empty($id)) {
			return $this->error('参数错误！');
		}

		$info = $model::get($id);

		$info['title']       = get_action($info['action_id'], 'title');
		$info['user_id']     = get_username($info['user_id']);
		$info['action_ip']   = long2ip($info['action_ip']);
		$info['create_time'] = date('Y-m-d H:i:s', $info['create_time']);
		$data                = array(
			'info'    => $info,
			'keyList' => $model->keyList,
		);
		$this->assign($data);
		$this->setMeta('查看行为日志');
		return $this->fetch();
	}
	/**
	 * 删除日志
	 * @param mixed $id
	 * @author huajie <banhuajie@163.com>
	 */
	public function dellog() {
		$id = $this->getArrayParam('id');
		if (empty($id)) {
			return $this->error("非法操作！", '');
		}
		$map['id'] = array('IN', $id);
		$res       = db('ActionLog')->where($map)->delete();
		if ($res !== false) {
			action_log('delete_actionlog', 'ActionLog', $id, session('user_auth.uid'));
			return $this->success('删除成功！');
		} else {
			return $this->error('删除失败！');
		}
	}
	/**
	 * 清空日志
	 */
	public function clear($id = '') {
		$res = db('ActionLog')->where('1=1')->delete();
		if ($res !== false) {
			//记录行为
			action_log('clear_actionlog', 'ActionLog', $id, session('user_auth.uid'));
			return $this->success('日志清空成功！');
		} else {
			return $this->error('日志清空失败！');
		}
	}
}