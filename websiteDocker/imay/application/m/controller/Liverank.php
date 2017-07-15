<?php

namespace app\m\controller;
use app\common\controller\Fornt;

/**
 * 超胆播排行榜控制器
 * Class Index
 * @package app\index\controller
 */

class Liverank extends Fornt
{
    /**
     * 排行榜
     */
    public function index()
    {
        $uid = input("get.uid");
        $model = model('ApiMethod');
        $list = $uid ? $model->shortLiveRank($uid) : '';
        //print_r($list);
        $this->assign('uid', $uid);
        return $this->fetch();
    }
    
    /**
     * ajax 排行榜列表
     */
    public function ajaxList()
    {
        $rd = array(
            'status'=>-1,
            'week1'=>'',
            'week2'=>'',
            'week3'=>'',
            'count' => 1,
        );
        $uid = input("post.uid");
        $model = model('ApiMethod');
        $list = $uid ? $model->shortLiveRank($uid) : '';
        
        if($list){
            
            $week_info = $list['my_weekly_stat'] ? $list['my_weekly_stat'] : '' ;
            $count = !empty($week_info) ? count($week_info) : 1;
            
            $IMG ='/application/m/static/images/liverank';
            $str_week1 ='';
            $str_week2 ='';
            $str_week3 ='';
             //第一周
            $week1 = $list['week1_rank'] ? $list['week1_rank'] : '';
            
                if(!empty($week1)){
                    $week_stat = '<ul class="super-list-ul">';
                    $str1 = '';
                    foreach($week1 as $k=>$v){
                        $str1 .='<li>';
                        if($k<3){
                            $str1 .='<img src="'.$IMG.'/'.$k.'.png" class="super-list-f">';
                        }else{
                            $ke = $k+1;
                            $str1 .='<span class="super-list-serial">NO.'.$ke.'</span>';
                        }
                            $str1 .='<img src="'.$v['head_img'].'" class="super-list-head">';
                            $str1 .='<h5 class="super-list-tit">'.$v['nick'].'</h5>';
                            $str1 .='<h6 class="super-list-num">'.$v['total'].'</h6>';
                            $str1 .='<a class="super-list-a" href="imay://com.imay.live/openwith?type=16&nextShortLiveId='.$v['short_live_id'].'"><img src="'.$IMG.'/btn_watch.png" class="super-list-watch"></a>';
                        
                        
                        $str1 .='</li>';
                    }
                    $week_end ='</ul>';
                    $sring =$week_stat.$str1.$week_end;
                    
                    $weeks = $week_info[0] ? $week_info[0] : '';
                    if($week_info[0]){
                        $pai = '<div class="super-bot">
                            <span class="super-list-serial">36</span>
                            <img src="'.$list['my_head_img'].'" class="super-list-head">
                            <h5 class="super-list-tit">'.$list['my_nick'].'</h5>
                            <a class="super-thumbs-up">
                                <img src="'.$IMG.'/icn_praise.png" class="super-thumbs-i">
                                <span class="super-thumbs-txt">'.$weeks['like'].'</span>
                            </a>
                            <a class="super-step-down">
                                <img src="'.$IMG.'/icn_step.png" class="super-step-i">
                                <span class="super-step-txt">'.$weeks['tread'].'</span>
                            </a>
                        </div>';
                    }
                    $str_week1 = $sring.$pai;
                }
               
                //第二周
                $week2 = $list['week2_rank'] ? $list['week2_rank'] : '';
                if(!empty($week2)){
                    $week_stat = '<ul class="super-list-ul">';
                    $str2 = '';
                    foreach($week2 as $k=>$v){
                        $str2 .='<li>';
                        if($k<3){
                            $str2 .='<img src="'.$IMG.'/'.$k.'.png" class="super-list-f">';
                        }else{
                            $ke = $k+1;
                            $str2 .='<span class="super-list-serial">NO.'.$ke.'</span>';
                        }
                        $str2 .='<img src="'.$v['head_img'].'" class="super-list-head">';
                        $str2 .='<h5 class="super-list-tit">'.$v['nick'].'</h5>';
                        $str2 .='<h6 class="super-list-num">'.$v['total'].'</h6>';
                        $str2 .='<a class="super-list-a" href="imay://com.imay.live/openwith?type=16&nextShortLiveId='.$v['short_live_id'].'"><img src="'.$IMG.'/btn_watch.png" class="super-list-watch"></a>';
                
                
                        $str2 .='</li>';
                    }
                    $week_end ='</ul>';
                    $sring2 =$week_stat.$str2.$week_end;
                
                    $weeks2 = $week_info[1] ? $week_info[1] : '';
                    if($weeks2){
                        $pai2 = '<div class="super-bot">
                            <span class="super-list-serial">36</span>
                            <img src="'.$list['my_head_img'].'" class="super-list-head">
                            <h5 class="super-list-tit">'.$list['my_nick'].'</h5>
                            <a class="super-thumbs-up">
                                <img src="'.$IMG.'/icn_praise.png" class="super-thumbs-i">
                                <span class="super-thumbs-txt">'.$weeks2['like'].'</span>
                            </a>
                            <a class="super-step-down">
                                <img src="'.$IMG.'/icn_step.png" class="super-step-i">
                                <span class="super-step-txt">'.$weeks2['tread'].'</span>
                            </a>
                        </div>';
                    }
                    $str_week2 = $sring2.$pai2;
                } 
                
                //第三周
                $week3 = $list['week3_rank'] ? $list['week3_rank'] : '';
                if(!empty($week3)){
                    $week_stat = '<ul class="super-list-ul">';
                    $str3 = '';
                    foreach($week3 as $k=>$v){
                        $str3 .='<li>';
                        if($k<3){
                            $str3 .='<img src="'.$IMG.'/'.$k.'.png" class="super-list-f">';
                        }else{
                            $ke = $k+1;
                            $str3 .='<span class="super-list-serial">NO.'.$ke.'</span>';
                        }
                        $str3 .='<img src="'.$v['head_img'].'" class="super-list-head">';
                        $str3 .='<h5 class="super-list-tit">'.$v['nick'].'</h5>';
                        $str3 .='<h6 class="super-list-num">'.$v['total'].'</h6>';
                        $str3 .='<a class="super-list-a" href="imay://com.imay.live/openwith?type=16&nextShortLiveId='.$v['short_live_id'].'"><img src="'.$IMG.'/btn_watch.png" class="super-list-watch"></a>';
                
                
                        $str3 .='</li>';
                    }
                    $week_end ='</ul>';
                    $sring3 =$week_stat.$str3.$week_end;
                
                    $weeks3 = $week_info[2] ? $week_info[2] : '';
                    if($weeks3){
                        $pai3 = '<div class="super-bot">
                            <span class="super-list-serial">36</span>
                            <img src="'.$list['my_head_img'].'" class="super-list-head">
                            <h5 class="super-list-tit">'.$list['my_nick'].'</h5>
                            <a class="super-thumbs-up">
                                <img src="'.$IMG.'/icn_praise.png" class="super-thumbs-i">
                                <span class="super-thumbs-txt">'.$weeks3['like'].'</span>
                            </a>
                            <a class="super-step-down">
                                <img src="'.$IMG.'/icn_step.png" class="super-step-i">
                                <span class="super-step-txt">'.$weeks3['tread'].'</span>
                            </a>
                        </div>';
                    }
                    $str_week3 = $sring3.$pai3;
                }
            //print_r($str_week2);
            
            $rd = array(
                'status'=>1,
                'week1'=>$str_week1,
                'week2'=>$str_week2,
                'week3'=>$str_week3,
                'count' => $count ? $count : 1,
            );
            
            
        }
        
        echo json_encode($rd);
        exit;
        
    }
    
}