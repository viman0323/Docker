<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2015 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

namespace com;

use think\template\TagLib;

/**
 * CX标签库解析类
 * @category   Think
 * @package  Think
 * @subpackage  Driver.Taglib
 * @author    liu21st <liu21st@gmail.com>
 */
class Sent extends Taglib{

	// 标签定义
	protected $tags   =  array(
		// 标签定义： attr 属性列表 close 是否闭合（0 或者1 默认1） alias 标签别名 level 嵌套层次
		'nav'       => array('attr' => 'field,name', 'close' => 1), //获取导航
		'list'      => array('attr' => 'table,where,order,limit,id,sql,field,key','level'=>3),//列表
		'doc'       => array('attr' => 'model,field,limit,id,field,key','level'=>3),
		'recom'     => array('attr' => 'doc_id,id'),
		'link'		=> array('attr' => 'type,limit' , 'close' => 1),//友情链接
		'prev'		=> array('attr' => 'id,cate' , 'close' => 1),//上一篇
		'next'		=> array('attr' => 'id,cate' , 'close' => 1),//下一篇
	);

	public function tagnav($tag, $content){
		$field  = empty($tag['field']) ? 'true' : $tag['field'];
		$tree   =   empty($tag['tree'])? true : false;
		$parse  = $parse   = '<?php ';
		$parse .= '$__NAV__ = db(\'Channel\')->field('.$field.')->where("status=1")->order("sort")->select();';
		if($tree){
			$parse .= '$__NAV__ = list_to_tree($__NAV__, "id", "pid");';
		}
		$parse .= 'foreach ($__NAV__ as $key => $'.$tag['name'].') {';
		$parse .= '?>';
		$parse .= $content;
		$parse .= '<?php } ?>';
		return $parse;
	}

	public function tagdoc($tag, $content){
		$model     = !empty($tag['model']) ? $tag['model']:'';
		$cid     = !empty($tag['cid']) ? $tag['cid']:'0';
		$field     = empty($tag['field']) ? '*' : $tag['field'];
		$limit        = empty($tag['limit']) ? 20 : $tag['limit'];
		$order        = empty($tag['order']) ? 'create_time desc' : $tag['order'];

		//获得当前栏目的所有子栏目
		$ids = get_category_child($cid);
		$ids = implode(',', $ids);
		$where = "category_id IN ({$ids})";
		$where .= " and model_id = {$model} and status >= 1";

		$parse  = $parse   = '<?php ';
		$parse .= '$__LIST__ = model(\'Document\')->extend(\''.$model.'\')->where(\''.$where.'\')->field(\''.$field.'\')->limit(\''.$limit.'\')->order(\''.$order.'\')->select();';
		$parse .= 'foreach ($__LIST__ as $key => $'.$tag['name'].') {';
		$parse .= '?>';
		$parse .= $content;
		$parse .= '<?php } ?>';
		return $parse;
	}

	public function taglist($tag, $content){
		$name     = !empty($tag['name']) ? $tag['name'] : '';
		$map     = !empty($tag['map']) ? $tag['map'] : '';
		$field     = empty($tag['field']) ? '*' : $tag['field'];
		$limit        = empty($tag['limit']) ? 20 : $tag['limit'];
		$order        = empty($tag['order']) ? 'id desc' : $tag['order'];

		$where[] = "status > 0";
		if ($map) {
			$where[] = $map;
		}
		$map = implode(" and ", $where);

		$parse  = $parse   = '<?php ';
		$parse .= '$__LIST__ = model(\''.$name.'\')->where(\''.$map.'\')->field(\''.$field.'\')->limit(\''.$limit.'\')->order(\''.$order.'\')->select();';
		$parse .= 'foreach ($__LIST__ as $key => $'.$tag['id'].') {';
		$parse .= '?>';
		$parse .= $content;
		$parse .= '<?php } ?>';
		return $parse;
	}

	public function tagrecom($tag, $content){
		$doc_id     = empty($tag['doc_id']) ? '' : $tag['doc_id'];
		$field     = empty($tag['field']) ? '*' : $tag['field'];
		$limit        = empty($tag['limit']) ? 20 : $tag['limit'];
		$order        = empty($tag['order']) ? 'id desc' : $tag['order'];

		if (!$doc_id) {
			return array();
		}

		$parse  = $parse   = '<?php ';
		$parse .= '$__LIST__ = model(\'Document\')->recom('. $doc_id .',\'' .$field. '\',' .$limit. ',\'' .$order. '\');';
		$parse .= 'foreach ($__LIST__ as $key => $'.$tag['id'].') {';
		$parse .= '?>';
		$parse .= $content;
		$parse .= '<?php } ?>';
		return $parse;
	}

	public function taglink($tag, $content){
		$type     = !empty($tag['type']) ? $tag['type'] : '';
		$limit     = !empty($tag['limit']) ? $tag['limit'] : '';
		$field     = empty($tag['field']) ? '*' : $tag['field'];
		$limit        = empty($tag['limit']) ? 20 : $tag['limit'];
		$order        = empty($tag['order']) ? "id desc" : $tag['order'];

		$where[] = "status > 0";
		if ($type) {
			$where[] = "ftype = " . $type;
		}
		$map = implode(" and ", $where);

		$parse  = $parse   = '<?php ';
		$parse .= '$__LIST__ = model(\'Link\')->where(\''.$map.'\')->field(\''.$field.'\')->limit(\''.$limit.'\')->order(\''.$order.'\')->select();';
		$parse .= 'foreach ($__LIST__ as $key => $'.$tag['name'].') {';
		$parse .= '?>';
		$parse .= $content;
		$parse .= '<?php } ?>';
		return $parse;
	}

	public function tagprev($tag, $content){
		$id     = !empty($tag['id']) ? $tag['id'] : '';
		$cate     = !empty($tag['cate']) ? $tag['cate'] : '';
		$model_id     = !empty($tag['model']) ? $tag['model'] : '';

		$parse  = '<?php ';
		$parse .= '$map = "category_id=" . ' . $cate . ' . " and model_id=" . ' . $model_id . ' . " and id>".' . $id . ';';
		$parse .= '$prev = db(\'Document\')->where($map)->order(\'id asc\')->find();if(!empty($prev)){ ?>';
		$parse .= $content;
		$parse .= '<?php } ?>';
		return $parse;
	}

	public function tagnext($tag, $content){
		$id       = !empty($tag['id']) ? ($tag['id']) : '';
		$cate     = !empty($tag['cate']) ? $tag['cate'] : '';
		$model_id = !empty($tag['model']) ? $tag['model'] : '';

		$parse  = '<?php ';
		$parse .= '$map = "category_id=" . ' . $cate . ' . " and model_id=" . ' . $model_id . ' . " and id<".' . $id . ';';
		$parse .= '$next = db(\'Document\')->where($map)->order(\'id desc\')->find();if(!empty($next)){ ?>';
		$parse .= $content;
		$parse .= '<?php } ?>';
		return $parse;
	}
}