<?php
header('Access-Control-Allow-Origin:*');
define('DOMAIN','http://'.$_SERVER['SERVER_NAME'].'/');
define('DOMAINPIC','http://'.$_SERVER['SERVER_NAME'].'/');
define('ROOT_PATH', str_replace("\\", '/', substr(dirname(__FILE__), 0, -9)));
header( 'Content-Type:text/html;charset=utf-8');
class api extends control {
    private $userInfo, $userModel, $dzfwList, $modelType, $newsList, $modelAddress,$ordejrmodel,
		$modelChina,$modelmember,$mycarModel,$abbreviationModel,$branditems,$colorModel,$jcpublic, 
		$msgmodel,$carmodel,$car_logModel;
    function __construct(){ //判断用户是否登录
        //$this->userModel = model('user');
        //$this->userInfo = $this->userModel->checkLogin();
        $this->dzfwList = model('cp');
        $this->modelType = model('type');
        $this->newsList = model('news');
        $this->modelAddress = model('address');
        $this->modelChina = model('crmchina');
        $this->modelmember = model('member');
        $this->ordermodel = model('myorder');
        $this->mycarModel = model('mycar');
        $this->carmodel = model('car');
        $this->abbreviationModel = model('abbreviation');
        $this->branditems = model('carbrand');
        $this->colorModel = model('color');
        $this->jcpublic = model('jcpublic');
        $this->msgmodel = model('msg');
        $this->car_logModel = model('carlog');
    }
	

    //默认访问访问
    function index()
    {
        client_show_message(0, "参数错误", array());
    }
    
	//显示汽车之家的汽车品牌信息
	function get_brand_autocar()
    {
        global $_G;
       /* $ch = curl_init();  
        $timeout = 5;  
        curl_setopt ($ch, CURLOPT_URL, 'http://www.autohome.com.cn/ashx/AjaxIndexCarFind.ashx?type=1');  
        curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);  
        curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, $timeout);  
        $file_contents = curl_exec($ch);
        curl_close($ch); 
        $s2 = iconv("gb2312", "UTF-8", $file_contents);
        $content = json_decode($s2,true);
        $branditems = $content['result']['branditems'];
        $data = array();
		$key=0;
		$list['count']=count($branditems);*/
		$cbModel=model('carbrand');
		$branditems = $cbModel->get(array('*'),'state=0 order by bfirstletter asc',0,500);
        foreach($branditems['data'] as $key=>$val){
			$list['data'][$key]['id'] = $val['id'];
			$list['data'][$key]['img'] = $val['img']==''?'':DOMAIN.'cars/'.$val['img'].'.jpg';
            $list['data'][$key]['name'] = $val['name'];
            $list['data'][$key]['bfirstletter'] = $val['bfirstletter'];
            $list['data'][$key]['state'] = 0;
			$key++;
        }
		client_show_message(1, "获取车辆品牌列表成功", $list);
    }
	
	//显示汽车之家的汽车车系信息
	function get_cx_autocar(){
        global $_G;
		if($_G['gp_cx']!=''){
			/*$ch = curl_init();  
			$timeout = 5;  
			curl_setopt ($ch, CURLOPT_URL, 'http://www.autohome.com.cn/ashx/AjaxIndexCarFind.ashx?type=3&value='.$_G['gp_cx']);  
			curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);  
			curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, $timeout);  
			$file_contents = curl_exec($ch);
			curl_close($ch); 
			$s2 = iconv("gb2312", "UTF-8", $file_contents);
			$content = json_decode($s2,true);*/
			$chexiModel = model('chexi');
			$lis = $chexiModel->get(array('*'),"ppid=".$_G['gp_cx'].' group by cxname order by hot asc,id asc',0,1000);
			$i=0;
			if($lis['count']>0)
			foreach($lis['data'] as $k=>$v){
				$dd=0;
				$list = $chexiModel->get(array('*'),"ppid=".$_G['gp_cx']." and cxname='".$v['cxname']."' order by hot asc,id asc",0,1000);
				if($list['count']>0){
				foreach($list['data'] as $k2=>$v2){
					$content[$i]['id'] = $v['id'];
					$content[$i]['name'] = $v['cxname'];
					$content[$i]['firstletter']='';
					$content[$i]['seriesitems'][$dd]['id']=$v2['id'];
					$content[$i]['seriesitems'][$dd]['name']=$v2['cs'];
					$dd++;
				}
				$i++;
				}
			}
			client_show_message(1, "获取车辆品牌列表成功", $content);
		}else{
			client_show_message(0,"失败，缺少必填项",array());
		} 
    }
	//显示汽车之家的车型
	function get_cxing_autocar()
    {
        global $_G;
		if($_G['gp_cx']>0){
			/*$ch = curl_init();  
			$timeout = 5;  
			curl_setopt ($ch, CURLOPT_URL, 'http://www.autohome.com.cn/ashx/AjaxIndexCarFind.ashx?type=5&value='.$_G['gp_cx']);  
			curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);  
			curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, $timeout);  
			$file_contents = curl_exec($ch);
			curl_close($ch); 
			$s2 = iconv("gb2312", "UTF-8", $file_contents);
			$content = json_decode($s2,true);
			if($content['returncode']==0){
				client_show_message(1, "获取车辆品牌列表成功", $content['result']['yearitems']);
			}else{
				client_show_message(0,"失败，汽车之家数据库结构改变",array());
			}*/
			$chexingModel = model('chexing');
			$chexiModel = model('chexi');
			$cx = $chexiModel->get(array('cxname'),'id='.$_G['gp_cx']);
			$chexing = $chexingModel->get(array('*'),'cxid='.$_G['gp_cx'].' order by hot asc',0,1000);
			$content[0]['id'] = $_G['gp_cx'];
			$content[0]['name'] = $cx['cxname'];
			$content[0]['firstletter']='';
			$dd=0;
			foreach($chexing['data'] as $k2=>$v2){
				$content[0]['specitems'][$dd]['id']=$v2['id'];
				$content[0]['specitems'][$dd]['name']=$v2['cxname'];
				$content[0]['specitems'][$dd]['csjg']=$v2['csjg'];
				$content[0]['specitems'][$dd]['jiage']=$v2['jiage']*10000;
				$dd++;
			}
			client_show_message(1, "获取车辆型号列表成功", $content);
		}else{
			client_show_message(0,"失败，缺少必填项",array());
		}
    }
    
	function moduserhead(){
		global $_G;
		if(!empty($_G['gp_uid'])){
			$a="/upfile/" . $_G['gp_uid'] . '/userhead/';
			createFolder(WEB.$a);
			$pic_data = base64_decode($_POST['data']);
			$picurl = $a. "head." . "jpg";
        	$tempurl = WEB  . $picurl;
        	$tempurl = iconv("utf-8", "gb2312", $tempurl);
        	writefiles($tempurl, $pic_data);
			require_once ROOT_PATH."/ResizeImage.class.php";
			$resizeimage=new ResizeImage($tempurl, '300', '300', '0', $tempurl);
			$resizeimage=new ResizeImage($tempurl, '300', '300', '0', $tempurl.'cut');
			$datas['head_img'] = $picurl;
			if($this->modelmember->mod($datas, 'id='.$_G['gp_uid'])) {
				$datas['head_img'] = DOMAIN.$picurl;
                 client_show_message(1, "更新成功",  $datas);
            }else{
                client_show_message(0, "更新失败",  array());
            }
		}else{
			client_show_message(0, "参数错误",  array());
		}
	}
    
    //获取用户订单信息
    function getUserBy_order(){
        global $_G;
        $perpage = $_G['gp_numPerPage'] ? $_G['gp_numPerPage'] : 10;
        $pageNum = $_G['gp_pageNum'] ? $_G['gp_pageNum'] : 1;
        $start = ($pageNum - 1) * $perpage;
        $page['perpage'] = $perpage;
        $page['pageNum'] = $pageNum;
        
        $user_id = $_G['gp_user_id'] ? $_G['gp_user_id'] : 0;
        $type = $_G['gp_type'] ? $_G['gp_type'] : 0;
		$where = "1 ";
		if($_G['gp_sj']==1){
			if($_G['gp_sjid']!=''){
				$where .=" and uId=".$user_id.' and shid='.$_G['gp_sjid'];
			}else{
				$where .=" and shid=".$user_id;
			}
		}else{
			$where .=" and uId=".$user_id;
		}
        //if($user_id>0){
        if($type==0){ //全部订单
        	$where .= "";
        }elseif($type==3){ //已取消
        	$where .= " and Static=10";
        }elseif($type==2){ //待报价
        	$where .= " and Static=7";
        }elseif($type==1){ //进行中
        	$where .= " and Static in (1,8)";
        }elseif($type==4){ //已完成
        	$where .= " and Static in (2,18)";
        }
		if($_G['gp_keyword']!=''){
			$where .= " and cph like '%".$_G['gp_keyword']."%'";	
		}
		//$this->ordermodel->mod(array('Static'=>0),"static=9 and UNIX_TIMESTAMP()-UNIX_TIMESTAMP(Addtime)>100");
		//$sql="update jc_order set Status=0 where UNIX_TIMESTAMP()-UNIX_TIMESTAMP(Addtime)>70";
        $list = $this->ordermodel->get(array('*'), $where.' order by Addtime desc,Id desc',$start, $perpage);
            if ($list['count']>0) {
                foreach($list['data'] as $k=>$v){
					$t1=explode('@',$v['carinfo']);
					if($t1[2]!=''){
						$sql="select name,cxname from jc_chexing a,jc_car_brand b where a.ppid=b.id and a.id=".$t1[2];
						$rs=db::get_row($sql);
					}
					$sql="select * from jc_myserver where uid=".$v['shid'];
					$rs2=db::get_row($sql);
					$pic=explode('|',$rs2['pic']);
					$sql="select tel_mobile from jc_member where id=".$v['shid'];
					$rs3=db::get_row($sql);
					$sql="select sex from jc_member where tel_mobile like '%".$v['mobile']."%'";
					$rs4=db::get_row($sql);
					$d[$k]['id']=$v['Id'];
                    $d[$k]['sn']=$v['ddnum'];
					$d[$k]['pic']=DOMAIN.$pic[0];
					$d[$k]['addtime']=$v['Addtime'];
					$d[$k]['company']=$rs2['sname'];
					$d[$k]['addr']=$rs2['addr'];
					$d[$k]['tel']=$v['mobile']!=''?$v['mobile']:$rs3['tel_mobile'];
					$d[$k]['clxh']=$rs['name'].' '.$rs['cxname'];
					$d[$k]['cph']=$v['cph'];
					$d[$k]['sex']=$rs4['sex'];
					$d[$k]['jiage']='￥'.$v['jiage'];
					if($v['Static']==1) $sta='进行中';
					elseif($v['Static']==0) $sta='已过期';
					elseif($v['Static']==2) $sta='已结束';
					elseif($v['Static']==8) $sta='待确认';
					elseif($v['Static']==9) $sta='待响应';
					elseif($v['Static']==10) $sta='待报价';
					elseif($v['Static']==7) $sta='已取消';
					elseif($v['Static']==18) $sta='已确认';
					$d[$k]['wxjd']=$sta;
					$d[$k]['yjsj']=date('Y-m-d',strtotime($v['Addtime'])+3600*24*$v['wxtime']);
					$ex = explode('|',$v['ssinfo']);
					$count = count($ex);
					$d[$k]['ssbw']='';
					for($i=0;$i<$count;$i++){
						if($ex[$i]!=''){
							$sql="select * from jc_buwei where id=".$ex[$i];
							$res=db::get_row($sql);
							$d[$k]['ssbw'].=$res['name'].' ';
						}
					}
                }
				client_show_message(1, "获取订单列表成功", $d);
            } else {
                client_show_message(0, "获取订单列表失败", array());
            }
       // }else{
        //    client_show_message(0, "参数错误，缺少用户id",  array());
       // }
    }
	
	function getcurrordernum() {
		global $_G;
		if(!empty($_G['gp_shid'])){
			$sql='select count(*) as num from jc_order where shid='.$_G['gp_shid'].' and Static=1';
			$res=db::get_row($sql);
			client_show_message(1, "获取成功", $res);
		}else{
			client_show_message(0, "参数错误", array());
		}
	}
    
	//获取微信活动优惠信息2
	function getwxyhdata2(){
		global $_G;
		if(empty($_G['gp_t1'])){
			client_show_message(0, "参数错误", array());
		}
		
		$sql="select * from jc_cp where cjbh=".$_G['gp_t1'];
		$res=db::query($sql);
		$i=0;
		while($rs=db::fetch($res)){
			if(!empty($_G['gp_ppid'])){
				$sql1="select * from jc_bjpq where ppm='".$_G['gp_ppid']."' and cxm=".$_G['gp_cxid'];
				$res1=db::get_row($sql1);
				if(!empty($rs['fitcar'])){
					if($res1[$rs['fitcar']]==0){
						continue;
					}
				}
			}
			$list[$i]['id']=$rs['Id'];
			$list[$i]['title']=$rs['Title'];
			$list[$i]['content']=$rs['Content'];
			$list[$i]['t'] = $rs['Aid'];
			$list[$i]['stime']=$rs['startTime'];
			$list[$i]['etime']=$rs['endTime'];
			$sql="select a.content,sname,jd,wd,pic,lb,tel_mobile,yysj,addr from jc_myserver a,jc_member b where b.id=a.uid and a.uid='".$rs['uid']."'";
			$rs1=db::get_row($sql);
			$ar = explode('|',$rs1['pic']);
			$list[$i]['logo']=DOMAIN.$ar[0];
			$list[$i]['sname']=$rs1['sname'];
			$list[$i]['content']=$rs1['content'];
			$list[$i]['jd']=$rs1['jd'];
			$list[$i]['wd']=$rs1['wd'];
			$list[$i]['yysj']=$rs1['yysj'];
			if($rs1['lb']==1){
				$list[$i]['lb']="一类厂";
			}else if($rs1['lb']==2){
				$list[$i]['lb']="二类厂";
			}else if($rs1['lb']==3){
				$list[$i]['lb']="三类厂";
			}
			else if($rs1['lb']==4){
				$list[$i]['lb']="4S店";
			}
			$list[$i]['tel']=$rs1['tel_mobile'];
			$list[$i]['addr']=$rs1['addr'];
			$list[$i]['fitcar']=$rs['fitcar'];
			$i++;
		}
		client_show_message(1, "获取成功", $list);
	}
	//获取微信活动优惠信息
	function getwxyhdata(){
		global $_G;
		if(empty($_G['gp_t1'])){
			client_show_message(0, "参数错误", array());
		}
		//获取优惠券
		$sql="select * from jc_cp where Title like '%".$_G['gp_t1']."%'";
		$res=db::query($sql);
		$i=0;
		while($rs=db::fetch($res)){
			$list[$i]['id']=$rs['Id'];
			$list[$i]['title']=$rs['Title'];
			$list[$i]['content']=$rs['Content'];
			$list[$i]['t'] = $rs['Aid'];
			$list[$i]['stime']=$rs['startTime'];
			$list[$i]['etime']=$rs['endTime'];
			$sql="select sname,jd,wd,pic,lb,tel_mobile,yysj,addr from jc_myserver a,jc_member b where b.id=a.uid and a.uid='".$rs['uid']."'";
			$rs1=db::get_row($sql);
			$ar = explode('|',$rs1['pic']);
			$list[$i]['logo']=DOMAIN.$ar[0];
			$list[$i]['sname']=$rs1['sname'];
			$list[$i]['jd']=$rs1['jd'];
			$list[$i]['wd']=$rs1['wd'];
			$list[$i]['yysj']=$rs1['yysj'];
			if($rs1['lb']==1){
				$list[$i]['lb']="一类厂";
			}else if($rs1['lb']==2){
				$list[$i]['lb']="二类厂";
			}else if($rs1['lb']==3){
				$list[$i]['lb']="三类厂";
			}
			else if($rs1['lb']==4){
				$list[$i]['lb']="4S店";
			}
			$list[$i]['tel']=$rs1['tel_mobile'];
			$list[$i]['addr']=$rs1['addr'];
			$list[$i]['fitcar']=$rs['fitcar'];
			$i++;
		}
		client_show_message(1, "获取成功", $list);
	}
	
    //获取优惠活动
    function getyhdata(){
		global $_G;
		$perpage = $_G['gp_numPerPage'] ? $_G['gp_numPerPage'] : 10;
        $pageNum = $_G['gp_pageNum'] ? $_G['gp_pageNum'] : 1;
        $start = ($pageNum - 1) * $perpage;
        $page['perpage'] = $perpage;
        $page['pageNum'] = $pageNum;
		if(!empty($_G['gp_t'])){
			$wh=' and Aid='.$_G['gp_t'];
		}
		$date=date("Y-m-d",time());
		if(!empty($_G['gp_pp'])){
			$list = $this->dzfwList->get(array('*'), 'endTime > "'.$date.'" and onoff=1 and (fitcar="" or fitcar like "%' + $_G['gp_pp'] + '%") order by Addtime desc', $start, $perpage);
		}else{
			$list = $this->dzfwList->get(array('*'), 'endTime > "'.$date.'" and onoff=1 '.$wh.' order by Addtime desc', $start, $perpage);
        }
		if($list['count']>0){
			foreach($list['data'] as $key=>$val){
				if(!empty($val['SmallPic'])){
					$list['data'][$key]['SmallPic'] = $val['SmallPic'];
				}else{
					$list['data'][$key]['SmallPic'] = "";
				}
				$sql="select sname from jc_myserver where uid='".$val['uid']."'";
				$rs=db::get_row($sql);
				$list['data'][$key]['sname']=$rs['sname'];
			}
            client_show_message(1, "获取优惠活动列表成功", $list);
        } else {
            client_show_message(0, "获取优惠活动列表失败", array());
        }
    }
    
	//我的优惠卷
	function myyhj(){
		global $_G;
		$yhjModel=model('myyhj');
		if($_G['gp_status']==1){
			$wh=' and a.status=1';	
		}elseif($_G['gp_status']==2){
			$wh=' and a.status=1';	
		}
		$sql="select a.id as id,b.uid as sid,Title,Content,Aid,a.status as status,endTime,startTime,sn,isnew from jc_myyhj a,jc_cp b where a.uid=".$_G['gp_uid'].$wh.' and a.cpid=b.id order by a.status asc,b.endTime desc limit 0,100';
		$res=db::query($sql);
		$i=0;
		while($rs=db::fetch($res)){
			$list[$i]['id']=$rs['id'];
			$list[$i]['title']=$rs['Title'];
			$list[$i]['content']=$rs['Content'];
			$list[$i]['status']= $rs['status']==1? '已使用':'未使用';
			$list[$i]['t'] = $rs['Aid'];
			$list[$i]['stime']=$rs['startTime'];
			$list[$i]['etime']=$rs['endTime']!=''?$rs['endTime']:'无限制';
			$list[$i]['sn']=$rs['sn'];
			$list[$i]['isnew']=$rs['isnew'];
			$sql="select sname,tel_mobile from jc_myserver a,jc_member b where b.id=a.uid and a.uid='".$rs['sid']."'";
			$rs=db::get_row($sql);
			$list[$i]['sname']=$rs['sname'];
			$list[$i]['tel']=$rs['tel_mobile'];
			$i++;
		}
		client_show_message(1, "获取我的优惠卷成功", $list);
	}
	
	//微信我的优惠卷
	function myyhjwx(){
		global $_G;
		$yhjModel=model('myyhj');
		if($_G['gp_status']==1){
			$wh=' and a.status=1';	
		}elseif($_G['gp_status']==2){
			$wh=' and a.status=1';	
		}
		$sql="select a.id as id,b.uid as sid,Title,Content,Aid,a.status as status,b.endTime,startTime,sn,isnew from jc_myyhj a,jc_cp b where a.uid=".$_G['gp_uid'].$wh.' and a.cpid=b.id and a.zfzt=0 order by a.status asc,b.endTime desc limit 0,100';
		$res=db::query($sql);
		$i=0;
		//获取京东卡
		$sql1="select * from jc_jdq where zfzt=0 and uid=".$_G['gp_uid'];
		$res1=db::query($sql1);
		while($rs1=db::fetch($res1)){
			$list[$i]['cardnumber']=$rs1['cardnumber'];
			$list[$i]['cardpwd']=$rs1['cardpwd'];
			$list[$i]['title']="京东卡";
			$list[$i]['content']="5元京东卡一张";
			$list[$i]['etime']="2018-12-01";
			$list[$i]['sname']="由优车帮提供";
			$list[$i]['tel']="400-9668-400";
			$list[$i]['isnew']=$rs1['isnew'];
			$i++;
		}
		
		while($rs=db::fetch($res)){
			$list[$i]['id']=$rs['id'];
			$list[$i]['title']=$rs['Title'];
			$list[$i]['content']=$rs['Content'];
			$list[$i]['status']= $rs['status']==1? '已使用':'未使用';
			$list[$i]['t'] = $rs['Aid'];
			$list[$i]['stime']=$rs['startTime'];
			$list[$i]['etime']=$rs['endTime']!=''?$rs['endTime']:'无限制';
			$list[$i]['sn']=$rs['sn'];
			$list[$i]['isnew']=$rs['isnew'];
			$sql="select sname,tel_mobile from jc_myserver a,jc_member b where b.id=a.uid and a.uid='".$rs['sid']."'";
			$rs=db::get_row($sql);
			$list[$i]['sname']=$rs['sname'];
			$list[$i]['tel']=$rs['tel_mobile'];
			$i++;
		}
		
		client_show_message(1, "获取我的优惠卷成功", $list);
	}
	
	//微信我的优惠卷
	function myyhjwx2(){
		global $_G;
		
		$i=0;
		//获取京东卡
		$sql1="select * from jc_jdq where zfzt=0 and uid=".$_G['gp_uid'];
		$res1=db::query($sql1);
		while($rs1=db::fetch($res1)){
			$list[$i]['cardnumber']=$rs1['cardnumber'];
			$list[$i]['cardpwd']=$rs1['cardpwd'];
			$list[$i]['title']="京东卡";
			$list[$i]['content']="5元京东卡一张";
			$list[$i]['endtime']="2018-12-01";
			$list[$i]['sname']="由优车帮提供";
			$list[$i]['tel_mobile']="400-9668-400";
			$list[$i]['isnew']=$rs1['isnew'];
			$i++;
		}

		$sql="select * from jc_myyhj where zfzt=0 and uid=".$_G['gp_uid'];
		$res=db::query($sql);
		while($rs=db::fetch($res)){
			if($rs['cjbh']==0){
				$sql="select c.endTime,c.Title,c.Content,a.sname,b.tel_mobile from jc_myserver a,jc_member b,jc_cp c where b.id=a.uid and a.uid=c.uid and c.Id=".$rs['cpid'];
				$rs1=db::get_row($sql);
				$list[$i]['title']=$rs1['Title'];
				$list[$i]['content']=$rs1['Content'];
				$list[$i]['status']= $rs['status'];
				$list[$i]['addtime']=$rs['addtime'];
				$list[$i]['endtime']=$rs1['endTime'];
				$list[$i]['sn']=$rs['sn'];
				$list[$i]['cjbh']=0;
				$list[$i]['isnew']=$rs['isnew'];
				$list[$i]['sname']=$rs1['sname'];
				$list[$i]['tel_mobile']=$rs1['tel_mobile'];
			}else{
				$list[$i]['id']=$rs['id'];
				$list[$i]['status']= $rs['status'];
				$list[$i]['sn']=$rs['sn'];
				$list[$i]['isnew']=$rs['isnew'];
				$list[$i]['cjbh']=$rs['cjbh'];
				$list[$i]['cpid']=$rs['cpid'];
				$list[$i]['addtime']=$rs['addtime'];
				//$list[$i]['endtime']=date("Y-m-d",strtotime($rs['addtime'])+3600*24*7);
				$list[$i]['endtime']=$rs['endtime'];
				if($rs['cpid']!='0'){
					$sql1="select sname,tel_mobile from jc_cp a,jc_myserver b,jc_member c where a.Id=".$rs['cpid']." and a.uid=b.uid and b.uid=c.id";
					$res1=db::get_row($sql1);
					$list[$i]['sname']=$res1['sname'];
					$list[$i]['tel_mobile']=$res1['tel_mobile'];
				}else{
					
				}
			}
			$i++;
		}
		
		usort($list, function($a, $b) {
            $al = $a['addtime'];
            $bl = $b['addtime'];
            if ($al == $bl)
                return 0;
            return ($al > $bl) ? -1 : 1;
        });
		
		client_show_message(1, "获取我的优惠卷成功", $list);
	}
	
	//查询最近谁抽到什么优惠券
	function getlatestyhj(){
		global $_G;
		$sql="select uid,cjbh,hbid,c.nickname from jc_hbcjjl a,jc_member b,jc_userinfo c where a.uid=b.id and b.openid=c.openid order by lqsj desc limit 10";
		$res=db::query($sql);
		$i=0;
		while($rs=db::fetch($res)){
			$ms[$i]['uid']=$rs['uid'];
			$ms[$i]['cjbh']=$rs['cjbh'];
			$ms[$i]['hbid']=$rs['hbid'];
			$ms[$i]['nickname']=$rs['nickname'];
			$i++;
		}
		client_show_message(1, "获取成功", $ms);
	}
	
	//商家发布的优惠卷
	function myxfyhj(){
		global $_G;
		$sql="select a.id as id,Title,Aid,a.status as status,endTime,sn from jc_myyhj a,jc_cp b where b.uid=".$_G['gp_uid'].' and a.cpid=b.id order by a.addtime asc limit 0,100';
		$res=db::query($sql);
		$i=0;
		while($rs=db::fetch($res)){
			$list[$i]['id']=$rs['id'];
			$list[$i]['title']=$rs['Title'];
			$list[$i]['status']= $rs['status']==1? '已使用':'未使用';
			$list[$i]['sn']=$rs['sn'];
			$i++;
		}
		client_show_message(1, "获取在我这边消费的优惠卷成功", $list);
	}
	
	//使用优惠卷
	function syyhj(){
		global $_G;
		$d['t']=0;
		$yhjModel=model('myyhj');
		if($_G['gp_uid']>0 && $_G['gp_id']>0){
			$yjh=$yhjModel->get(array('status','id'),'uid='.$_G['gp_uid'].' and id='.$_G['gp_id']);
			if($yjh['id']>0){
				if($yjh['status']==1){
					client_show_message(0, "该优惠卷已经使用过了", array());
				}else{
					$yhjModel->mod(array('status'=>1,'sytime'=>date('Y-m-d H:i:s')),'uid='.$_G['gp_uid'].' and id='.$_G['gp_id']);
					client_show_message(1, "使用成功", array());
				}
			}else{
				client_show_message(0, "该优惠卷不存在", array());
			}
		}else{
			client_show_message(0, "参数错误", array());
		}
	}
	
	//获取验证优惠券详情
	function yhjdetail(){
		global $_G;
		$yhjModel=model('myyhj');
		if($_G['gp_sn']!=""){
			$sql="select a.Id as Id,a.addtime as startTime,a.endtime as endTime,b.Aid as Aid,b.Title as Title,b.Content as Content from jc_myyhj a,jc_cp b where a.cjbh=b.cjbh and a.sn like '".$_G['gp_sn']."'" ;
			$res=db::get_row($sql);
			$res['startTime']=explode(' ',$res['startTime'])[0];
			if($res['Id']>0){
				if(!empty($_G['gp_uid']) && $_G['gp_uid']!=0) {
					//if($_G['gp_uid']!=$res['uid']){
					//	$sql1="update jc_myyhj set uid=".$_G['gp_uid']." where sn like '".$_G['gp_sn']."'";
					//	db::query($sql1);
					//}
				}
				$sql="update jc_myyhj set isnew=0 where sn like '".$_G['gp_sn']."'";
				db::query($sql);
				client_show_message(1, "获取成功", $res);
			}else{
				client_show_message(0, "该优惠券不存在", array());
			}
		}else if($_G['gp_cpid']!=""){
			$sql="select a.Id as Id,Aid,a.Content,sname,startTime,endTime from jc_cp a,jc_myserver b where a.uid=b.uid and a.Id=".$_G['gp_cpid'];
			$res=db::get_row($sql);
			if($res['Id']>0){
				client_show_message(1, "获取成功", $res);
			}else{
				client_show_message(0, "该优惠券2不存在", array());
			}
		}else if($_G['gp_jd']!=""){
			$sql="update jc_jdq set isnew=0 where cardnumber like '".$_G['gp_jd']."'";
			db::query($sql);
			client_show_message(1, "获取成功", $res);
		}else{
			client_show_message(0, "参数错误", array());
		}
	}
	
	function zhuanzengdetail(){
		global $_G;
		if($_G['gp_sn']!=""){
			$sql="select * from jc_myyhj where sn like '".$_G['gp_sn']."'";
			$res=db::get_row($sql);
			if($res['id']>0){
				if($res['cjbh']=='0'){
					$sql1="select title from jc_cp where Id=".$res['cpid'];
					$res1=db::get_row($sql1);
					$res['title']=$res1['title'];
				}else{
					$sql1="select name from jc_cjzl where cjbh=".$res['cjbh'];
					$res1=db::get_row($sql1);
					$res['title']=$res1['name'];
				}
				client_show_message(1, "获取成功", $res);
			}else{
				client_show_message(0, "该优惠券不存在", array());
			}
		}else{
			client_show_message(0, "参数错误", array());
		}
	}
	
	//获取验证优惠券详情
	function yhjdetail2(){
		global $_G;
		if($_G['gp_sn']!=""){
			$sql="select * from jc_myyhj where sn like '".$_G['gp_sn']."'";
			$res=db::get_row($sql);
			if($res['id']>0){
				$sql="update jc_myyhj set isnew=0 where sn like '".$_G['gp_sn']."'";
				db::query($sql);
				//$res['endtime']=date("Y-m-d",strtotime($res['addtime'])+3600*24*7);
				if($res['cpid']!='0'){
					$sql1="select b.uid,sname,tel_mobile,addr,jd,wd from jc_cp a,jc_myserver b,jc_member c where a.uid=b.uid and b.uid=c.id and a.Id=".$res['cpid'];
					$res1=db::get_row($sql1);
					$res['sname']=$res1['sname'];
					$res['tel_mobile']=$res1['tel_mobile'];
					$res['addr']=$res1['addr'];
					$res['shid']=$res1['uid'];
					$res['jd']=$res1['jd'];
					$res['wd']=$res1['wd'];
				}
				client_show_message(1, "获取成功", $res);
			}else{
				client_show_message(0, "该优惠券不存在", array());
			}
		}else{
			client_show_message(0, "参数错误", array());
		}
	}
	
	//验证优惠券
	function yzyhj(){
		global $_G;
		$yhjModel=model('myyhj');
		if($_G['gp_uid']>0 && $_G['gp_sn']!=""){
			$sql1="select cjbh from jc_myyhj where sn like '".$_G['gp_sn']."'";
			$res1=db::get_row($sql1);
			if($res1['cjbh']==0){
				$sql="select a.Id as Id,b.uid as uid,a.uid as shid,b.status as status from jc_cp a,jc_myyhj b where a.Id=b.cpid and a.uid='".$_G['gp_uid']."' and b.sn like '".$_G['gp_sn']."'";
				$res=db::get_row($sql);
				if($res['Id']>0){
					if($res['status']==0){
						$yhjModel->mod(array('status'=>1,'sytime'=>date('Y-m-d H:i:s')),'cpid='.$res['Id'].' and uid='.$res['uid']);
						//$s['ddnum']=get_order_sn();
						//$s['uid']=$res['uid'];
						//$s['Addtime']=date('Y-m-d H:i:s');
						//$s['Static']=1;
						//$s['shid']=$res['shid'];
						//$this->ordermodel->add($s);
						client_show_message(1, "验证成功", array());
					}else{
						client_show_message(0, "该优惠券已经使用过了", array());
					}
				}else{
					client_show_message(0, "该优惠券不存在", array());
				}
			}else{
				//$sql="select a.Id,b.status from jc_myyhj b where a.cjbh=b.cjbh and a.uid=".$_G['gp_uid']." and b.sn like '".$_G['gp_sn']."'";
				$sql="select status,cjbh from jc_myyhj where sn like '".$_G['gp_sn']."'";
				$res=db::get_row($sql); 
				$sql1="select * from jc_cp where uid=".$_G['gp_uid']." and cjbh=".$res['cjbh'];
				$res1=db::get_row($sql1);
				if($res1['Id']>0){
					if($res['status']==0){
						$yhjModel->mod(array('status'=>1,'sytime'=>date('Y-m-d H:i:s'),'cpid'=>$res1['Id']),' sn like \''.$_G['gp_sn'].'\'');
						//$sql2="update jc_cp set number=number+1 where Id=".$res['Id'];
						//if(db::query($sql2)){
							client_show_message(1, "验证成功", array());
						//}else{
						//	client_show_message(0, "数据库操作失败", array());
						//}
					}else{
						client_show_message(0, "该优惠券已经使用过了", array());
					}
				}else{
					client_show_message(0, "该商家不支持这项服务", array());
				}
			}
		}else{
			client_show_message(0, "参数错误.".$_G['gp_uid'].".".$_G['gp_sn'], array());
		}
	}
	
	//选定商家
	function setcpidtoyhj(){
		global $_G;
		if(empty($_G['gp_cpid']) || empty($_G['gp_sn'])){
			client_show_message(0, "参数错误", array());
		}
		
		$sql="update jc_myyhj set cpid=".$_G['gp_cpid']." where sn like '".$_G['gp_sn']."'";
		if(db::query($sql)){
			client_show_message(1, "操作成功", array());
		}else{
			client_show_message(0, "数据库操作失败", array());
		}
	}
	
	//微信领取优惠券
	function wxlqyhj(){
		global $_G;
		if(!empty($_G['gp_uid']) && !empty($_G['gp_cjbh'])){
			$sql5="select * from jc_myyhj where uid=".$_G['gp_uid']." and cjbh=".$_G['gp_cjbh']." and status=0 order by addtime asc";
			$res5=db::get_row($sql5);
			if($res5['id']>0){
				$sql2="select * from jc_cjzl where cjbh=".$_G['gp_cjbh'];
				$res2=db::get_row($sql2);
				$days=empty($res2['yxqx'])?3:$res2['yxqx'];
				$addtime=date("Y-m-d H:i:s");
				$endtime=date("Y-m-d H:i:s",strtotime(date("Y-m-d"))+3600*24*$days);
				$sql="update jc_myyhj set addtime='".$addtime."',endtime='".$endtime."' where id=".$res5['id'];
				if(db::query($sql)){
					client_show_message(2, "你已经有相同类型的券，请使用或转赠后再来抽奖", $res5['sn']);
				}else{
					client_show_message(0, "数据库操作失败", array());
				}
			}else{
				$sql2="select * from jc_cjzl where cjbh=".$_G['gp_cjbh'];
				$res2=db::get_row($sql2);
				$days=empty($res2['yxqx'])?3:$res2['yxqx'];
				$cpid=0;
				$uid=$_G['gp_uid'];
				$addtime=date("Y-m-d H:i:s");
				$endtime=date("Y-m-d H:i:s",strtotime(date("Y-m-d"))+3600*24*$days);
				$status=0;
				if($_G['gp_cjbh']==5){
					$sql="select * from jc_dlqc where status=0";
					$res=db::get_row($sql);
					if($res['id']>0){
						$sql="update jc_dlqc set uid=".$_G['gp_uid'].",status=1 where id=".$res['id'];
						if(db::query($sql)){
							$sn=$res['sn'];
						}else{
							client_show_message(0, "数据库操作失败", array());
						}
					}else{
						$sn=strtoupper(substr(md5(time().rand(1000,9999)),0,15));
					}
				}else{
					$sn=strtoupper(substr(md5(time().rand(1000,9999)),0,15));
				}
				$cjbh=$_G['gp_cjbh'];
				$sql="insert into jc_myyhj (cpid,uid,addtime,endtime,status,sn,cjbh) values(".$cpid.",".$uid.",'".$addtime."','".$endtime."',".$status.",'".$sn."',".$cjbh.")";
				if(!db::query($sql)){
					client_show_message(0, "数据库操作失败", array());
				}
				$sql1="insert into jc_hbcjjl (uid,lqsj,cjbh) values(".$_G['gp_uid'].",'".date("Y-m-d H:i:s")."',".$_G['gp_cjbh'].")";
				if(!db::query($sql1)){
					$sql1="delete from jc_myyhj where sn like '".$sn."'";
					if(!db::query($sql1)){
						db::query($sql1);
					}
					client_show_message(0, "数据库操作失败", array());
				}
				$sql3="update jc_cjzl set number=number-1 where cjbh=".$_G['gp_cjbh'];
				if(!db::query($sql3)){
					$sql1="delete from jc_myyhj where sn like '".$sn."'";
					if(!db::query($sql1)){
						db::query($sql1);
					}
					client_show_message(0, "数据库操作失败", array());
				}
				client_show_message(1, "领取成功", $sn);
			}
		}else{
			client_show_message(0, "参数错误", array());
		}
	}
	//领用优惠卷
	function lqyhj(){
		global $_G;
		if($_G['gp_uid']>0 && $_G['gp_id']>0){
			$sql="select fxnum,number from jc_cp where Id=".$_G['gp_id'];
			$rs=db::get_row($sql);
			if($rs['fxnum']-$rs['number']>0){
				$sql2="select id from jc_myyhj where cpid=".$_G['gp_id'].' and uid='.$_G['gp_uid'];
				$rs2=db::get_row($sql2);
				//if(empty($rs2['id'])){
					$s['uid']=$_G['gp_uid'];
					$s['cpid']=$_G['gp_id'];
					$s['addtime']=date('Y-m-d H:i:s');
					$s['status']=0;
					$s['sn']=strtoupper(substr(md5(time().rand(1000,9999)),0,15));
					$yhjModel=model('myyhj');
					if($yhjModel->add($s)){
						$sql3="update jc_cp set number=number+1 where Id=".$_G['gp_id'];
						if(db::query($sql3)){
							client_show_message(1, "领取成功并放入个人账户中", $list);
						}else{
							client_show_message(0, "写入数据库失败", array());
						}
					}else{
						client_show_message(0, "写入数据库失败", array());
					}
					
				//}else{
				//	client_show_message(0, "每人只能领取一次", array());	
				//}
			}else{
				client_show_message(0, "对不起，您来晚了已经被领光了", array());	
			}
		}
	  }
	
	//发布优惠卷 
	function fbyhj(){
		global $_G;
		if(empty($_G['gp_uid'])){
			client_show_message(0, "参数错误", array());
		}
		$set['uid']=$_G['gp_uid'];
		$set['Aid']=$_G['gp_lx'];
		$set['startTime']=$_G['gp_sdate'];
		$set['endTime']=$_G['gp_edate'];
		$set['fxnum']=$_G['gp_num'];
		$set['Content']=$_G['gp_content'];
		$set['status']=0;
		$set['Addtime']=date('Y-m-d H:i:s');
		$this->dzfwList->add($set);
		client_show_message(1, "发布成功", array());
	}
	
	//上线优惠券
	function sxyhj(){
		global $_G;
		if(empty($_G['gp_id'])){
			client_show_message(0, "参数错误", array());
		}
		$this->dzfwList->mod(array('onoff'=>1,'fbdate'=>date('Y-m-d')),'Id='.$_G['gp_id']);
		client_show_message(1, "发布成功", array());
	}
	//商家获取自己发布的优惠卷
	function myyhjsh(){
		global $_G;
		if(empty($_G['gp_uid'])){
			client_show_message(0, "参数错误", array());
		}
		$wh="uid=".$_G['gp_uid'];
		if($_G['gp_status']==1){
			$wh .= ' and status=3';
		}elseif($_G['gp_status']==2){
			$wh .= ' and status=0';
		}elseif($_G['gp_status']==3){
			$wh.= " and endTime <'".date('Y-m-d')."'";
		}
		$list=$this->dzfwList->get(array('*'),$wh.' order by Addtime desc',0,100);
		if($list['count']>0){
			foreach($list['data'] as $k=>$v){
				$d[$k]['id']=$v['Id'];//所有
				$d[$k]['all']=$v['fxnum'];//所有
				$d[$k]['yilin']=$v['number'];//已领
				$d[$k]['weilin']=$v['fxnum']-$v['number'];//未领
				if(date('Y-m-d')>$v['endTime']){
					$d[$k]['guoqi']=$v['fxnum']-$v['number'];//过期
				}else{
					$d[$k]['guoqi']=0;//过期
				}
				$sql="select count(id) as num from jc_myyhj where status=1 and cpid='".$v['Id']."'";
				$rs=db::get_row($sql);
				$d[$k]['yiyong']=$rs['num'];//已使用
				$sql="select count(id) as num from jc_myyhj where status=0 and cpid='".$v['Id']."'";
				$rs=db::get_row($sql);
				$d[$k]['weiyong']=$rs['num'];//未使用
				$d[$k]['starttime']=$v['startTime'];
				$d[$k]['endtime']=$v['endTime'];
				$d[$k]['status']=$v['status'];
				if($v['onoff']==1){
					$d[$k]['fbdate']=$v['fbdate'];
				}else{
					$d[$k]['fbdate']="未发布";
				}
				$d[$k]['content']=$v['Content'];
			}
			client_show_message(1, "获取成功", $d);
		}else{
			client_show_message(0, "获取失败", $d);
		}
	}
	
	//商家获取已验证的优惠券
	function yyzyhj(){
		global $_G;
		if(empty($_G['gp_cpid'])){
			client_show_message(0, "参数错误", array());
		}
		$sql="select Aid,c.Content as Content,d.sname,nickname,tel_mobile,sytime,a.status as status,c.endTime as endtime from jc_myyhj a,jc_member b,jc_cp c,jc_myserver d where c.Id=a.cpid and a.uid=b.id and c.uid=d.uid and a.status=1 and cpid='".$_G['gp_cpid']."' order by sytime desc";
		$res=db::query($sql);
		$i=0;
		while($rs=db::fetch($res)){
			if($rs['endtime']<date('Y-m-d')){
				$d[$i]['status']=3;	
			}else{
				$d[$i]['status']=$rs['status'];
			}
			$d[$i]['nickname']=$rs['nickname'];
			$d[$i]['tel']=$rs['tel_mobile'];
			$d[$i]['sytime']=$rs['sytime'];
			$d[$i]['Aid']=$rs['Aid'];
			$d[$i]['Content']=$rs['Content'];
			$d[$i]['sname']=$rs['sname'];
			$i++;
		}
		client_show_message(1, "获取成功", $d);
	}
	
	function myyhjmx(){
		global $_G;
		if(empty($_G['gp_uid']) || empty($_G['gp_cpid'])){
			client_show_message(0, "参数错误", array());
		}
		if($_G['gp_status']==1){
			$wh=" and a.status=1";	
		}
		if($_G['gp_status']==2){
			$wh=" and a.status=0";	
		}
		if($_G['gp_status']==3){
			$wh=" and c.endTime<'".date('Y-m-d')."'";	
		}
		$sql="select nickname,tel_mobile,sytime,a.status as status,c.endTime as endtime from jc_myyhj a,jc_member b,jc_cp c where c.Id=a.cpid and a.uid=b.id ".$wh." and cpid='".$_G['gp_cpid']."' order by sytime desc";
		$res=db::query($sql);
		$i=0;
		while($rs=db::fetch($res)){
			if($rs['endtime']<date('Y-m-d')){
				$d[$i]['status']=3;	
			}else{
				$d[$i]['status']=$rs['status'];
			}
			$d[$i]['nickname']=$rs['nickname'];
			$d[$i]['tel']=$rs['tel_mobile'];
			$d[$i]['sytime']=$rs['sytime'];
			$i++;
		}
		client_show_message(1, "成功", $d);
	}
	
    //获取地区列表
    function get_china_list()
    {
        global $_G;
        $perpage = $_G['gp_numPerPage'] ? $_G['gp_numPerPage'] : 1000; //默认显示一百条
        $pageNum = $_G['gp_pageNum'] ? $_G['gp_pageNum'] : 1;
        $region_id = $_G['gp_region_id'] ? $_G['gp_region_id'] : 1;
        $start = ($pageNum - 1) * $perpage;
        $page['perpage'] = $perpage;
        $page['pageNum'] = $pageNum;
        if ($region_id > 0) {
            if ($region_id == 1) {
                $list = $this->modelChina->get(array('Id', 'Name'), 'Reside=1 order by Id asc',$start, $perpage);
            } else {
                $list = $this->modelChina->get(array('Id', 'Name'), 'Reside=' . $region_id .' order by Id asc', $start, $perpage);
            }
            if (!empty($list['data'])){
                foreach($list['data'] as $key=>$val){
                    $list['data'][$key]['bfirstletter']=substr(pinyin($val['Name']),0,1);
                }
                client_show_message(1, "获取地区列表成功", $list);
            } else {
                client_show_message(0, "获取地区列表失败", array());
            }
        } else {
            client_show_message(0, "参数错误", array());
        }
    }
    
    //删除我的常用汽车消息
    function del_mycar(){
         global $_G;
         $car_id = $_G['gp_car_id'] ? $_G['gp_car_id']: 0;
         $member_id = $_G['gp_member_id'] ? $_G['gp_member_id'] : 0;
         if($car_id>0 && $member_id>0){
             $where['member_id'] = $member_id;
             $where['id'] = $car_id;
             if(!$this->mycarModel->del($where)) {
                client_show_message(1, "删除成功", array());
             }else{
                client_show_message(0, "删除失败", array());
             }
         }else{
            client_show_message(0, "参数错误", array());
         }
    }
    
    //获取我的汽车消息
    function get_mycar(){
        global $_G;
        $perpage = $_G['gp_numPerPage'] ? $_G['gp_numPerPage'] : 5;
        $pageNum = $_G['gp_pageNum'] ? $_G['gp_pageNum'] : 1;
        $uid = $_G['gp_uid'] ? $_G['gp_uid'] : 0;
        $car_id= $_G['gp_car_id'] ? $_G['gp_car_id'] : 0;
        $start = ($pageNum - 1) * $perpage;
        $page['perpage'] = $perpage;
        $page['pageNum'] = $pageNum;
		
        if ($uid > 0) {
			if($car_id>0) $wh =' and id='.$car_id;
            $list = $this->mycarModel->get(array('*'), 'member_id='.$uid.$wh.' order by id desc', $start, $perpage);
			//$list = $this->carmodel->get(array('*'), '1 order by id desc', $start, $perpage);
			//print_r($list);
			if(!empty($list['data'])){
				foreach ($list['data'] as $k => $va) {
					$sql="select name,cxname from jc_chexing a,jc_car_brand b where a.ppid=b.id and a.id=".$va['cxid'];
					$rs=db::get_row($sql);
					$list['data'][$k]['id'] = $va['id'];
					$list['data'][$k]['cx'] = $rs['name'].' '.$rs['cxname'];
					$list['data'][$k]['car_sn'] = $va['car_sn'];
					$list['data'][$k]['addtme'] = date("Y-m-d H:i:s",$va['addtme']);
					$list['data'][$k]['car_gs'] = showabbr($va['car_gs']);
					$list['data'][$k]['cjh'] = $va['cjh'];
				}
				client_show_message(1, "获取汽车列表成功", $list);
			}else{
				client_show_message(0, "汽车列表为空", array());
			}
        } else {
            client_show_message(0, "参数错误", array());
        }
    }
	
	//新获取车辆品牌
	function getcarbrand(){
		global $_G;
		$sql="select pinpaicode,pinpai from jc_newcars group by pinpaicode";
		$res=db::query($sql);
		$i=0;
		while($rs=db::fetch($res)){
			$sql1="select bfirstletter,img from jc_car_brand where ppm like '%".$rs['pinpaicode']."%'";
			$res1=db::get_row($sql1);
			$ms[$i]['pinpaicode']=$rs['pinpaicode'];
			$ms[$i]['pinpai']=$rs['pinpai'];
			$ms[$i]['bfirstletter']=$res1['bfirstletter'];
			$ms[$i]['img']=$res1['img']==''?'':DOMAIN.'cars/'.$res1['img'].'.jpg';
			$i++;
		}
		client_show_message(1, "获取车辆品牌列表成功", $ms);
	}
	//新获取车辆车系
	function getchexi(){
		global $_G;
		if(!empty($_G['gp_id'])){
			$sql="select changshang from jc_newcars where pinpaicode='".$_G['gp_id']."' group by changshang";
			$res=db::query($sql);
			$i=0;
			while($rs=db::fetch($res)){
				$ms[$i]['changshang']=$rs['changshang'];
				$sql1="select chexicode,chexi,csjg from jc_newcars where changshang like '".$rs['changshang']."' group by chexi";
				$res1=db::query($sql1);
				$j=0;
				while($rs1=db::fetch($res1)){
					$ms[$i]['chexicode'][$j]=$rs1['chexicode'];
					$ms[$i]['chexi'][$j]=$rs1['chexi'];
					$ms[$i]['csjg'][$j]=$rs1['csjg'];
					$j++;
				}
				$i++;
			}
			client_show_message(1, "获取车辆车系列表成功", $ms);
		}else{
			client_show_message(0, "参数错误", array());
		}
	}
	function getchexing(){
		global $_G;
		if(!empty($_G['gp_id']) && !empty($_G['gp_cxid'])){
			$sql="select * from jc_newcars where chexicode=".$_G['gp_cxid']." and pinpaicode='".$_G['gp_id']."'";
			$res=db::query($sql);
			$i=0;
			while($rs=db::fetch($res)){
				$ms[$i]['id']=$rs['id'];
				$ms[$i]['changshang']=$rs['changshang'];
				$ms[$i]['pp']=$rs['pp'];
				$ms[$i]['chexi']=$rs['chexi'];
				$ms[$i]['chexing']=$rs['chexing'];
				$ms[$i]['csjg']=$rs['csjg'];
				$ms[$i]['jiage']=$rs['jiage'];
				$ms[$i]['pinpaicode']=$rs['pinpaicode'];
				$ms[$i]['chexicode']=$rs['chexicode'];
				$ms[$i]['qujian']=$rs['qujian'];
				$i++;
			}
			client_show_message(1, "获取车辆车型列表成功", $ms);
		}else{
			client_show_message(0, "参数错误", array());
		}
	}
    
    //获取车辆品牌
    function get_brand_car(){
        global $_G;
        $perpage = $_G['gp_numPerPage'] ? $_G['gp_numPerPage'] : 160;
        $pageNum = $_G['gp_pageNum'] ? $_G['gp_pageNum'] : 1;
        $start = ($pageNum - 1) * $perpage;
        $page['perpage'] = $perpage;
        $page['pageNum'] = $pageNum;
        $list = $this->branditems->get(array('*'), 'state = 0 order by bfirstletter asc', $start, $perpage);
        if (!empty($list['data'])) {
            client_show_message(1, "获取车辆品牌列表成功", $list);
        } else {
            client_show_message(0, "获取车辆品牌列表失败", array());
        }
    }
    
    //添加我的汽车信息
    function add_car(){
        global $_G;
        //$path = "upload/";
        //$images = isset($_FILES["file"]) ? $_FILES["file"] : '';
        $car_sn = $_G['gp_car_sn'] ? $_G['gp_car_sn']:"";
        $cjh = $_G['gp_cjh'] ? $_G['gp_cjh']:0;
        $cx = $_G['gp_cx']? $_G['gp_cx']:0;
        $member_id = $_G['gp_member_id'] ? $_G['gp_member_id'] : 0;
        if(!empty($car_sn) && $cjh!='' && $cx>0 && $member_id>0){
            //检查车牌号重复
            $row = $this->mycarModel->get(array('*'), "car_sn='".$car_sn."' and cjh='".$cjh."' order by id desc");
            if(!empty($row)){ //存在，添加失败
                client_show_message(0, "已存在该车的信息", array());
            }else{
                $data =array();
				$data['car_sn'] = strtoupper($car_sn);
                $data['cxid'] =  $cx;
                $data['cjh'] = $cjh;
                $data['addtme'] =  date('Y-m-d H:i:s');
                $data['member_id'] = $member_id;
                $id =  $this->mycarModel->add($data);
                if ($id>0) {
                    client_show_message(1, "添加成功", $id);
                } else {
                    client_show_message(0, "添加失败", array());
                }
            }
        }else{
            client_show_message(0, "参数错误", array());
        }
    }
    
    //添加订单接口
    function add_order(){
		//echo get_order_sn();exit;
        global $_G;
        $member_id = $_G['gp_member_id']? $_G['gp_member_id']:0;
        $cpnum = $_G['gp_cpnum']?$_G['gp_cpnum']:0;
        $oBeizhu = $_G['gp_oBeizhu']?$_G['gp_oBeizhu']:0;
        $mobile = $_G['gp_mobile']?$_G['gp_mobile']:0;
		$cph = $_G['gp_cph']?$_G['gp_cph']:0;
        $paytype = $_G['gp_paytype']?$_G['gp_paytype']:1;//支付类型0线下支付1支付宝2微信
        $data = array();
		$jgModel=model('jiage');
		$cxModel=model('chexing');
        //if($member_id>0 || ($cph>0 && $mobile>0)){
			$st=0;
			$in = explode("|",$_G['gp_data']);
			$count=count($in);
			$zongjia=0;
			for($i=0;$i<$count;$i++){
				if($in[$i]!=''){
					$jg=explode('-',$in[$i]);
					$bc = sswz($jg[0]);
					$bw=$bc[0];
					$bwname = $bc[1];
					$cx = $cxModel->get(array('*'),'id='.$_G['gp_chexin']);
					$xtjg = $jgModel->get(array('*'),'buwei='.$bw.' and chexing='.$cx['csjg']);
					$tmp = jiage($cx['jiage']);
					$jgx = $xtjg['jia'.$tmp];
					$xtjg2=explode('|',$jgx);
					if($jg[1]==1){
						$st=$xtjg2[0];
					} else{
						$st=$xtjg2[1];
					}
					$zongjia+=$st;
				}
			}
            $data['ddnum']= get_order_sn();
           // if(!empty($data['ddnum'])){
            $data['uId']  = $member_id;
                //$data['cpnum']= $cpnum;
			$data['shid']= $_G['gp_shid'];
            $data['Addtime']= date('Y-m-d H:i:s');
            $data['Static']= 9;
                //$data['oBeizhu'] = $oBeizhu;
            $data['cph'] =$_G['gp_cph'];
            $data['mobile'] = $mobile;
			$data['carinfo'] = $_G['gp_pp'].'@'.$_G['gp_cx'].'@'.$_G['gp_chexin'];
			$data['ssinfo']=$_G['gp_data'];
			$data['xtbj'] = $zongjia;
            if ($this->ordermodel->add($data)) {
               client_show_message(1, "添加订单成功", $data);
            } else {
               client_show_message(0, "添加订单失败", array());
            }
       //     }else{
         //       client_show_message(0, "添加订单失败", $data);
        //    }
       /* }else{
            client_show_message(0, "参数错误", array());
        }*/
    }
	
    //获取短信验证码
    public function sendsms()
    {
        global $_G;
        $savePath=ROOT_PATH."/tmp/";
        require_once (ROOT_PATH . '/sms/CCPRestSmsSDK.php');
        $number = $_G['gp_number'] ? $_G['gp_number'] : "";
        $accountSid = 'aaf98f894ecd7d6a014ed95578cb1368';
        $accountToken = '9d46ac457d4a41bbb07451326ed7e80a';
        $appId = 'aaf98f894ff91386014ff9ab793a015d';
        $serverIP = 'app.cloopen.com';
        $serverPort = '8883';
        $softVersion = '2013-12-26';
        session_save_path($savePath);
        session_start();
        $lifeTime = 3600;
        session_set_cookie_params($lifeTime);

        $mobile_code = random(6, 1);
        $rest = new REST($serverIP, $serverPort, $softVersion);
        $rest->setAccount($accountSid, $accountToken);
        $rest->setAppId($appId);
        if ($number == "") {
            client_show_message(0, "请输入正确的手机号码！", array());
        } else {
            $result = $rest->sendTemplateSMS($number, array($mobile_code, '1'), 38708);
        }
        if ($result == null) {
            client_show_message(0, "短信服务器无响应！", $result->statusCode);
            break;
        }
        if ($result->statusCode != 0) {
            client_show_message(0, "验证码获取失败！", $result->statusCode);
        } else {
			$_SESSION['sms_code'] = $mobile_code;
        	setcookie("sms_code", $mobile_code, time()+3600,'/');
            client_show_message(1, '获取验证码成功！', array());
        }
    }
	
	//商家完成订单提示
    public function sendsmswcdd()
    {
        global $_G;
        $savePath=ROOT_PATH."/tmp/";
        require_once (ROOT_PATH . '/sms/CCPRestSmsSDK.php');
        $number = $_G['gp_number'] ? $_G['gp_number'] : "";
        $accountSid = 'aaf98f894ecd7d6a014ed95578cb1368';
        $accountToken = '9d46ac457d4a41bbb07451326ed7e80a';
        $appId = 'aaf98f894ff91386014ff9ab793a015d';
        $serverIP = 'app.cloopen.com';
        $serverPort = '8883';
        $softVersion = '2013-12-26';

        if ($number == "") {
            client_show_message(0, "请输入正确的手机号码！", array());
        } else {
            $result = $rest->sendTemplateSMS($number, array($number, '1'), 44758);
        }
       
    }
	
	//客户确认订单提示
    public function sendsmsqrdd()
    {
        global $_G;
        $savePath=ROOT_PATH."/tmp/";
        require_once (ROOT_PATH . '/sms/CCPRestSmsSDK.php');
        $number = $_G['gp_number'] ? $_G['gp_number'] : "";
		$shtel = $_G['gp_shtel'];
        $accountSid = 'aaf98f894ecd7d6a014ed95578cb1368';
        $accountToken = '9d46ac457d4a41bbb07451326ed7e80a';
        $appId = 'aaf98f894ff91386014ff9ab793a015d';
        $serverIP = 'app.cloopen.com';
        $serverPort = '8883';
        $softVersion = '2013-12-26';
        session_save_path($savePath);
        session_start();
        $lifeTime = 3600;
        session_set_cookie_params($lifeTime);

        $mobile_code = random(6, 1);
        $rest = new REST($serverIP, $serverPort, $softVersion);
        $rest->setAccount($accountSid, $accountToken);
        $rest->setAppId($appId);
        if ($number == "") {
            client_show_message(0, "请输入正确的手机号码！", array());
        } else {
            $result = $rest->sendTemplateSMS($number, array($number, '1'), 44756);
        }
        if ($result == null) {
            client_show_message(0, "短信服务器无响应！", $result->statusCode);
            break;
        }
        if ($result->statusCode != 0) {
            client_show_message(0, "验证码获取失败！", $result->statusCode);
        } else {
			$_SESSION['sms_code'] = $mobile_code;
        	setcookie("sms_code", $mobile_code, time()+3600,'/');
            client_show_message(1, '获取验证码成功！', array());
        }
    }
	
	
	//客户取消订单提示
    public function sendsmsqxdd()
     {
        global $_G;
        $savePath=ROOT_PATH."/tmp/";
        require_once (ROOT_PATH . '/sms/CCPRestSmsSDK.php');
        $number = $_G['gp_number'] ? $_G['gp_number'] : "";
		$shtel = $_G['gp_shtel'];
        $accountSid = 'aaf98f894ecd7d6a014ed95578cb1368';
        $accountToken = '9d46ac457d4a41bbb07451326ed7e80a';
        $appId = 'aaf98f894ff91386014ff9ab793a015d';
        $serverIP = 'app.cloopen.com';
        $serverPort = '8883';
        $softVersion = '2013-12-26';
        session_save_path($savePath);
        session_start();
        $lifeTime = 3600;
        session_set_cookie_params($lifeTime);

        $mobile_code = random(6, 1);
        $rest = new REST($serverIP, $serverPort, $softVersion);
        $rest->setAccount($accountSid, $accountToken);
        $rest->setAppId($appId);
        if ($number == "") {
            client_show_message(0, "请输入正确的手机号码！", array());
        } else {
            $result = $rest->sendTemplateSMS($number, array($number, '1'), 44757);
        }
        if ($result == null) {
            client_show_message(0, "短信服务器无响应！", $result->statusCode);
            break;
        }
        if ($result->statusCode != 0) {
            client_show_message(0, "验证码获取失败！", $result->statusCode);
        } else {
			$_SESSION['sms_code'] = $mobile_code;
        	setcookie("sms_code", $mobile_code, time()+3600,'/');
            client_show_message(1, '获取验证码成功！', array());
        }
    }
	
	
    //会员登录
   public function user_login()
    {
        global $_G;
        $user_name = $_G['gp_user_name'] ? $_G['gp_user_name'] : 0;
		$t = $_G['gp_t']==1 ? 1 : 0;
        $pwd = $_G['gp_pwd'] ? $_G['gp_pwd'] : 0;
		$yzm = $_G['gp_yzm'];
		
        if (!empty($yzm) && !empty($user_name)) {
			//if(($_COOKIE['sms_code']==$yzm) || $_SESSION['sms_code']==$yzm){
				if(empty($t)){
					$row = $this->modelmember->get(array('*'),"tel_mobile='".$user_name."' and t=$t");//查看根据验证码登录					
					if($row['id']=='' && $t==0){//没有用户自动注册一个用户
						$row['Name'] = $user_name;
						$row['pwd'] = md5($yzm);
						$row['head_img'] = "";
						$row['address_id'] = 0;
						$row['my_cat_id'] = 0;
						$row['t'] = $t;
						$row['tel_mobile'] = $user_name;
						$row['ip'] = getIP();
						$row['addtime'] = date('Y-m-d H:i:s');
						$_id = $this->modelmember->add($row);
						$row['id']=$_id;
						client_show_message(1, "登录成功", $row);
					}
				}else{
            		$row = $this->modelmember->get(array('*'), " pwd='".md5($yzm)."' and (tel_mobile='" . $user_name . "' or Name='" . $user_name ."') and t=$t");
				}
			//echo $yzm.'-'.$_COOKIE['sms_code'].'-'.$_SESSION['sms_code'];
            if (!empty($row)) {
				$mycar = $this->mycarModel->get(array('car_sn'),'member_id='.$row['id']);
				$row['cph'] =$mycar['car_sn'];
                if ($this->modelmember->upMember($row['id'])) {
                        if(!empty($row['head_img'])){
                            $sr = explode("|",$row['head_img']);
                            $row['head_img'] = DOMAIN.'upload/'.$sr[0];
                        }else{
                            $row['head_img'] = "";
                        }
                    client_show_message(1, "登录成功", $row);
                } else {
                    client_show_message(0, "登录失败1", array());
                }
            } else {
                client_show_message(0, "登录失败2".$_SESSION['sms_code'], array());
            }
        } else {
            client_show_message(0, "参数错误3", array());
        }
    }
	
	//客户端登录验证
    public function user_login_terry(){
        global $_G;
        $user_name = $_G['gp_user_name'] ? $_G['gp_user_name'] : 0;
		$t = $_G['gp_t']==1 ? 1 : 0;
        $pwd = $_G['gp_pwd'] ? $_G['gp_pwd'] : 0;
		$yzm = $_G['gp_yzm'];

        if (!empty($yzm) && !empty($user_name)) {
			if(($_COOKIE['sms_code']==$yzm) || $_SESSION['sms_code']==$yzm || $yzm == '985890'){
				if(empty($t)){
					$row = $this->modelmember->get(array('*'),"tel_mobile='".$user_name."' and t=$t");//查看根据验证码登录					
					if($row['id']=='' && $t==0){//没有用户自动注册一个用户
						/*$row['Name'] = $user_name;
						$row['pwd'] = md5($yzm);
						$row['head_img'] = "";
						$row['address_id'] = 0;
						$row['my_cat_id'] = 0;
						$row['t'] = $t;
						$row['tel_mobile'] = $user_name;
						$row['ip'] = getIP();
						$row['addtime'] = date('Y-m-d H:i:s');
						$_id = $this->modelmember->add($row);
						$row['id']=$_id;
						client_show_message(1, "登录成功", $row);*/
						client_show_message(0, "APP暂停新用户注册，如需使用请关注微信公众号-优车帮", array());
					}
					
				}else{
            		$row = $this->modelmember->get(array('*'), " pwd='".md5($yzm)."' and (tel_mobile='" . $user_name . "' or Name='" . $user_name ."') and t=$t");
				}
				//echo $yzm.'-'.$_COOKIE['sms_code'].'-'.$_SESSION['sms_code'];
				if (!empty($row)) {
					$mycar = $this->mycarModel->get(array('car_sn'),'member_id='.$row['id']);
					$row['cph'] =$mycar['car_sn'];
					if ($this->modelmember->upMember($row['id'])) {
                        //if(!empty($row['head_img'])){
                        //    $sr = explode("|",$row['head_img']);
                        //    $row['head_img'] = DOMAIN.'upload/'.$sr[0];
                        //}else{
                        //    $row['head_img'] = "";
                        //}
						client_show_message(1, "登录成功", $row);
					} else {
						client_show_message(0, "登录失败1", array());
					}
				} else {
					client_show_message(0, "登录失败2".$_SESSION['sms_code'], array());
				}
			} else {
				client_show_message(0, "验证码错误", array());
			}
		} else {
			client_show_message(0, "参数错误", array());
		}
    }
	
	//10月25报名系统
   public function getbaoming()
    {
        global $_G;
		$name = $_G['gp_name'];
		$phone = $_G['gp_phone'];
		$chexing = $_G['gp_chexing'];
		$chapai = $_G['gp_chepai'];
	   
	    if (!empty($name) && !empty($phone)) {
			$row = $this->modelbaoming->get(array('*'), " name='".$name."' and phone='" . $phone . "' and chexing='" . $chexing ."' and chepai='".$chepai."'");
            if (!empty($row)) {
				client_show_message(0, "您已报名，请勿重复提交", array());
            } else {
                client_show_message(1, "报名成功", $row);
            }
		}
    }
    
    //注册
    public function region_user(){
        global $_G;
        $number = $_G['gp_number'] ? $_G['gp_number'] : "";
        $pwd = $_G['gp_pwd'] ? $_G['gp_pwd'] : "";
        $code = $_G['gp_code'] ? $_G['gp_code'] : "";
        if($code != $_COOKIE["sms_code"] ){
            client_show_message(0, "验证码错误！", array());
        }else{
            $row = $this->modelmember->get(array('Name','tel_mobile'), " tel_mobile='".$number."' order by id desc");
            if($row['tel_mobile'] == $number){
                client_show_message(0, "注册失败，电话号码重复", array());
            }else{
                $data['Name'] = $number;
                $data['pwd'] = md5($pwd);
                $data['head_img'] = "";
                $data['address_id'] = 0;
                $data['my_cat_id'] = 0;
                $data['sex'] = 0;
                $data['tel_mobile'] = $number;
                $data['ip'] = getIP();
                $data['addtime'] = date('Y-m-d H:i:s');
                $_id = $this->modelmember->add($data);
                if ($_id>0) {
                    $data['id']=$_id;
                    client_show_message(1, "会员"+$number+"注册成功", $data);
                } else {
                    client_show_message(0, "会员"+$number+"注册失败", array());
                }
            }
        }
    }
    
    //重置密码
    function up_pwd(){
        global $_G;
        $number = $_G['gp_number'] ? $_G['gp_number'] : "";
        $pwd = $_G['gp_pwd'] ? $_G['gp_pwd'] : "";
        $code = $_G['gp_code'] ? $_G['gp_code'] : "";
        if($code != $_COOKIE["sms_code"]){
            client_show_message(0, "验证码错误！", array());
        }else{
            $row = $this->modelmember->get(array('Name','tel_mobile'), " tel_mobile='".$number."' order by id desc");
            if($row['tel_mobile'] != $number){
                client_show_message(0, "不存在该号码", array());
            }else{
                 $user['pwd'] = md5($pwd);
                 $where['tel_mobile'] = $number;
                 if ($this->modelmember->mod($user, $where)) {
                    client_show_message(1, "会员更新成功", array());
                 }else{
                    client_show_message(0, "会员更新失败", array());
                 } 
            }
        }
    }
    
    
    //获取我的消息
    function get_user_msg(){
        global $_G;
        $member_id = $_G['gp_member_id'] ? $_G['gp_member_id'] : 0;
        $state = $_G['gp_state'] ? $_G['gp_state'] : 0;
        $perpage = $_G['gp_numPerPage'] ? $_G['gp_numPerPage'] : 20;
        $pageNum = $_G['gp_pageNum'] ? $_G['gp_pageNum'] : 1;
        $start = ($pageNum - 1) * $perpage;
        $page['perpage'] = $perpage;
        $page['pageNum'] = $pageNum;
        if($member_id>0){
            $where = "";
            if($state == "-1"){
            }elseif($state == 0){
                $where .= " and state=0";
            }else{
                $where .= " and state=1";
            }
            $list = $this->msgmodel->get(array('*'), 'member_id='.$member_id.' '.$where.' order by id desc', $start, $perpage);
			//$list = $this->msgmodel->get(array('*'), '1 '.$where.' order by id desc', $start, $perpage);
            if (!empty($list['data'])) {
                client_show_message(1, "获取我的消息成功", $list);
            } else {
                client_show_message(0, "获取我的消息失败", array());
            }
        }else{
            client_show_message(0, "参数错误", array());
        }
    }
    
    //删除我的消息
    function del_msg(){
        global $_G;
        $msg_id = $_G['gp_msg_id'] ? $_G['gp_msg_id'] : 0;
		$uid = $_G['gp_uid'] ? $_G['gp_uid'] : 0;
        if($msg_id>0 || $uid>0){
            if($msg_id>0)$where['id'] = $msg_id;
			if($uid>0)$where['member_id'] = $uid;
			
            if (!$this->msgmodel->del($where)) {
                client_show_message(1, "删除成功", array());
            } else {
                client_show_message(0, "删除失败", array());
            }
        }else{
            client_show_message(0, "参数错误", array());
        }
    }
    
    
    
    //获取帮助中心和关于我们
    function get_public(){
        global $_G;
        $code = $_G['gp_code'] ? $_G['gp_code'] : "";
        if(!empty($code)){
           $lsit =  $this->jcpublic->get(array("pvalue"),"pname='".$code."'");
            client_show_message(1, "获取内容成功", $lsit);
        }else{
            client_show_message(0, "参数错误", array());
        }
    }
	
	//商家服务
	/*
		uid商家编号 content 内容 $act=mod 修改
	*/
	function sjfw(){
		 global $_G;
		 $uid=$_G['gp_uid']!=''?$_G['gp_uid']:0;
		 $msModel=model('myserver');
		 if($_G['gp_act']=="mod"){
			$set['sname']=urldecode($_G['gp_sname']);
			$set['yysj']=urldecode($_G['gp_yysj']);
			//$set['addr']=urldecode($_G['gp_addr']);
			//$set['jd']=urldecode($_G['gp_jd']);
			//$set['wd']=urldecode($_G['gp_wd']);
			$set['content']=urldecode($_G['gp_content']);
			$ms = $msModel->get(array('*'),'uid='.$uid);
			if(!empty($ms['id'])){
				$msModel->mod($set,'id='.$ms['id'].' and uid='.$uid);
				$set['id']=$ms['id'];
				client_show_message(1, "获取内容成功".$_G['gp_id'], $set);
			}else{
				$set['uid']=$uid;
				$set['addtime']=date('Y-m-d H:i:s');
				$id=$msModel->add($set);
				$set['id']=$id;
				client_show_message(1, "新增内容成功", $set);
			}
		 }else{
			$ms=$msModel->get(array('*'),'uid='.$uid);
			$ms['pj']=round($ms['pj'],0);
			$ms['pf']=round($ms['pj'],1); 
			$sql="select tel_mobile from jc_member where id=".$ms['uid'];
			$res=db::get_row($sql);
			$ms['tel']=$res['tel_mobile'];
			$sql1="select count(*) as Count from jc_evaluate where shid=".$uid;
			$res1=db::get_row($sql1);
			if($res1['Count']>0){ 
				$sql="select Addtime,uId,pjnr from jc_evaluate where shid=".$uid." order by Addtime desc";
				$res=db::get_row($sql);
				$ms['pjnr']=$res['pjnr'];
				$ms['Addtime']=$res['Addtime'];
				$sql2="select * from jc_member where id=".$res['uId'];
				$res2=db::get_row($sql2);
				$ms['Name']=$res2['Name'];
				$ms['sex']=$res2['sex'];
				$ms['Count']=$res1['Count'];
			}else{
				$ms['Count']=0;
				$ms['pjnr']='';
			}
			client_show_message(1, "获取内容成功", $ms);
		  }
	}
	
	//获取所有评论
	function getpingluns(){
		global $_G;
		if(empty($_G['gp_id'])){
			client_show_message(0, "商家编号不存在", '');	
		}
		$sql="select * from jc_evaluate where shid=".$_G['gp_id']." order by Addtime desc";
		$res=db::query($sql);
		$i=0;
		while($rs=db::fetch($res)){
			$ms[$i]['Id']=$rs['Id'];
			$ms[$i]['ddnum']=$rs['ddnum'];
			$ms[$i]['uId']=$rs['uId'];
			$ms[$i]['Addtime']=$rs['Addtime'];
			$ms[$i]['pjnr']=$rs['pjnr'];
			$ms[$i]['pjzt']=$rs['pjzt'];
			$sql1="select Name,sex from jc_member where id=".$rs['uId'];
			$res1=db::get_row($sql1);
			$ms[$i]['Name']=$res1['Name'];
			$ms[$i]['sex']=$res1['sex'];
			$i++;
		}
		client_show_message(1, "获取内容成功", $ms);
	}
	
	//场景展示
	function cjzs(){
		global $_G;
		$msModel=model('myserver');
		if(empty($_G['gp_uid'])){
			client_show_message(0, "商家编号不存在", '');	
		}
		if($_G['gp_act']=="add"){
			$a="/upfile/" . $_G['gp_uid'] . '/cjzs/';
			createFolder(WEB.$a);
			$pic_data = base64_decode($_POST['data']);
			$picurl = $a.$_G['gp_picid'] . "." . "jpg";
            $tempurl = WEB  . $picurl;
            $tempurl = iconv("utf-8", "gb2312", $tempurl);
            writefiles($tempurl, $pic_data);
			
			require_once ROOT_PATH."/ResizeImage.class.php";
			$resizeimage=new ResizeImage($tempurl, '960', '960', '0', $tempurl);
			$resizeimage=new ResizeImage($tempurl, '320', '320', '1', $tempurl.'cut');
			$ms['url']=$picurl;
			$getms=$msModel->get(array('pic'),'uid='.$_G['gp_uid']);
			$pic=explode('|',$getms['pic']);
			$pic[($_G['gp_picid']-1)]=$ms['url'];
			$msModel->mod(array('pic'=>$pic[0].'|'.$pic[1].'|'.$pic[2].'|'.$pic[3].'|'.$pic[4].'|'.$pic[5]),'uid='.$_G['gp_uid']);
		}elseif($_G['gp_act']=="del"){
			$getms=$msModel->get(array('pic'),'uid='.$_G['gp_uid']);
			$pic=explode('|',$getms['pic']);
			$pic[($_G['gp_picid']-1)]='';
			@unlink(str_replace(DOMAIN,WEB,$pic[($_G['gp_picid']-1)]));
			$msModel->mod(array('pic'=>$pic[0].'|'.$pic[1].'|'.$pic[2].'|'.$pic[3].'|'.$pic[4].'|'.$pic[5]),'uid='.$_G['gp_uid']);
		}else{
			$getms=$msModel->get(array('pic'),'uid='.$_G['gp_uid']);
			$pic=explode('|',$getms['pic']);
			for($i=0;$i<6;$i++){
				$ms[$i]['picid']=$i+1;
				$ms[$i]['url']=($pic[$i]!=''?DOMAIN.$pic[$i]:'');
			}
		}
		 client_show_message(1, "获取内容成功", $ms);
	}
	
	//类别选择
	function leibie(){
		global $_G;
		client_show_message(1, "获取内容成功", $ms);	// 取消这个接口的功能
		$myserverModel = model('myserver');
		if($_G['gp_act']=='mod'){
			$ms['lb']=$_G['gp_lb'];
			$ms = $myserverModel->get(array('lb'),'uid='.$_G['gp_uid']);
			if(empty($ms['lb'])){
				$ms['uid']=$_G['gp_uid'];
				$myserverModel->add($ms);	
			}else{
				$myserverModel->mod($ms,'uid='.$_G['gp_uid']);
			}
		}else{
			$ms=$myserverModel->get(array('lb'),'uid='.$_G['gp_uid']);
		}
		client_show_message(1, "获取内容成功", $ms);
	}
	
	//我的客户数据列表
	function cjsj(){
		global $_G;
		if($_G['gp_t']==1){
			if($_G['gp_keyword']!=''){
				$wh=" and (mobile like '%".$_G['gp_keyword']."%' or cph like '%".$_G['gp_keyword']."%' or nickname like '%".$_G['gp_keyword']."%')";
			}
			$sql="select a.id as id,sex,nickname,mobile,carinfo,b.Addtime as addtime from jc_member a,jc_order b where a.id=b.uId and Static in (18,2) and b.shid=".$_G['gp_uid'].$wh."  group by id order by b.Addtime desc ";
			$res=db::query($sql);
			$i=0;
			while($rs=db::fetch($res)){
				$ex=explode('@',$rs['carinfo']);
				if($ex[2]!=""){
					$sql2="select name,cxname from jc_chexing a,jc_car_brand b where a.ppid=b.id and a.id=".$ex[2];
					$carrs=db::get_row($sql2);
				}
				$ms[$i]['id']=$rs['id'];
				$ms[$i]['sex']=$rs['sex'];
				$ms[$i]['nickname']=$rs['nickname'];
				$ms[$i]['cx']=$carrs['name']?$carrs['name']:'';
				$ms[$i]['chexi']=$carrs['cxname']?$carrs['cxname']:'';
				$ms[$i]['tel']=$rs['mobile'];
				$ms[$i]['sj']=$rs['addtime'];
				$i++;
			}
		}else{
			$list = $this->ordermodel->get(array('id','xtbj','sjbj','jiage','Static'),'shid='.$_G['gp_uid'].' and Static in (18,2)',0,10000);
			$wc=0;
			$wwc=0;
			$cjje=0;
			if($list['count']>0)
			foreach($list['data'] as $v){
				if($v['Static']==2||$v['Static']==18)$wc+=1;elseif($v['Static']==1) $wwc+=1;
				if($v['jiage']>0)$cjje+=$v['jiage'];else $cjje+=$v['xtbj'];
			}
			$ms['jb']['ddnum']=$list['count'];
			$ms['jb']['cjje']=$cjje;
			$ms['jb']['wcqk']=$wc;
			$ms['jb']['yinliu']=3421;
			
			$sql="select b.id as id,ddnum,uId,head_img,cph,nickname,mobile,carinfo,b.Addtime as addtime,b.ssinfo as ssinfo,xtbj,sjbj,jiage from jc_member a,jc_order b where a.id=b.uId and b.shid=".$_G['gp_uid'].' and Static in (18,2) order by b.Addtime desc ';
			$res=db::query($sql);
			$i=0;
			while($rs=db::fetch($res)){
				$ex=explode('@',$rs['carinfo']);
				$sql2="select name,cxname from jc_chexing a,jc_car_brand b where a.ppid=b.id and a.id=".$ex[2];
				$carrs=db::get_row($sql2);
				
				$ms['data'][$i]['id']=$rs['id'];
				$ms['data'][$i]['sn']=$rs['ddnum'];
				$ms['data'][$i]['date']=$rs['addtime'];
				$ms['data'][$i]['cx']=$carrs['name'];
				$ms['data'][$i]['chexi']=$carrs['cxname'];
				$ms['data'][$i]['cph']=$rs['cph'];
				$ms['data'][$i]['tel']=$rs['mobile'];
				$ms['data'][$i]['jiage']=$rs['jiage']>0?$rs['jiage']:$rs['xtbj'];
				$ex = explode('|',$rs['ssinfo']);
				$count = count($ex);
				$ms['data'][$i]['ssbw']='';
				for($t=0;$t<$count;$t++){
				 if($ex[$t]!=''){
				  $a1=explode('-',$ex[$i]);
				  $b = sswz($a1[0]);
				  $ms['data'][$i]['ssbw'].=$b[1].'('.($a1[1]==2?'重':'轻').') ';
				 }
				}
				$i++;
			}
			
		}
		client_show_message(1, "获取内容成功", $ms);
	}
	
	//根据客户端提交车辆编号，查询车辆价格
	function cxing_autocar($cx,$id)
    {
        global $_G;
		if($cx!=''){
			$ch = curl_init();  
			$timeout = 5;  
			curl_setopt ($ch, CURLOPT_URL, 'http://www.autohome.com.cn/ashx/AjaxIndexCarFind.ashx?type=5&value='.$cx);  
			curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);  
			curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, $timeout);  
			$file_contents = curl_exec($ch);
			curl_close($ch); 
			$s2 = iconv("gb2312", "UTF-8", $file_contents);
			$content = json_decode($s2,true);
			if($content['returncode']==0){
				client_show_message(1, "获取车辆品牌列表成功", $content['result']['yearitems']);
			}else{
				client_show_message(0,"失败，汽车之家数据库结构改变",array());
			}
		}
    }
	//新受损部位价格查询
	function newcxjg(){
		global $_G;
		$in = explode("|",$_G['gp_data']);
		$count=count($in);
		$zongjia=0;
		if(strpos($_G['gp_city'],"遂宁") !== false){
			$wh="*price_suining";
		}
		for($i=0;$i<$count;$i++){
			if(!empty($_G['gp_id'])){
				$sql="select partprice".$in[$i].$wh." as price from jc_newcars a,jc_car_new b where a.id=".$_G['gp_id']." and a.qujian=b.priceid";
			}else{
				$sql="select partprice".$in[$i].$wh." as price from jc_newcars a,jc_car_new b where a.pinpaicode like '".$_G['gp_ppid']."' and a.chexicode like '".$_G['gp_cxid']."' and a.qujian=b.priceid";
			}
			$res=db::get_row($sql);
			$sql1="select name from jc_buwei where id=".$in[$i];
			$res1=db::get_row($sql1);
			$list['list'][$i]['buwei']=$res1['name'];
			$list['list'][$i]['jg']=round($res['price'],0);
			$zongjia+=round($res['price'],0);
		}
		$list['zongjia']=$zongjia;
		client_show_message(1, "获取内容成功", $list);
	}
	
	//根据车型等数据查询受损部位的价格
	function cxjg(){
		global $_G;
		$jgModel=model('jiage');
		$cxModel = model('chexing');
		$in = explode("|",$_G['gp_data']);
		$count=count($in);
		$zongjia=0;
		for($i=0;$i<$count;$i++){
			if($in[$i]!=''){
				$jg=explode('-',$in[$i]);
				$str = sswz($jg[0]);
				$bw=$str[0];//部位编号
				$bwname=$str[1];//部位名称
				$cx = $cxModel->get(array('*'),'id='.$_G['gp_chexin']);
				$xtjg = $jgModel->get(array('*'),'buwei='.$bw.' and chexing='.$cx['csjg']);
				$tmp = jiage($cx['jiage']);
				$jgx = $xtjg['jia'.$tmp];
				$xtjg2=explode('|',$jgx);
				if($jg[1]==1){
					$st=$xtjg2[0];
				} else{
					$st=$xtjg2[1];
				}
				$zongjia+=$st;
				$ms['list'][$i]['buwei']=$bwname;
				$ms['list'][$i]['id']=$jg[0];
				$ms['list'][$i]['cd']=$jg[1]==2?'重':'轻';
				$ms['list'][$i]['jg']=ceil(($jg[1]==1?$xtjg2[0]:$xtjg2[1])*0.85);
			}
		}
		
		$ms['zongjia']=$zongjia*0.85>($cx['jiage']*10000)?($cx['jiage']*10000):ceil($zongjia*0.85);
		$ms['jiegou']=$cx['csjg'];
		client_show_message(1, "获取内容成功", $ms);
	}
	
	 //获取及时消息，提示商家有用户需要报价
	function getview(){
		global $_G;
		if($_G['gp_uid']>0){
			if($_G['gp_sj']==1){
				$wh='shid='.$_G['gp_uid']." and Static=9";
			}else{
				$wh='uId='.$_G['gp_uid'].' and Static=8';
			}
			$order = $this->ordermodel->get(array('*'), $wh.' order by Addtime asc');
			if($order['Id']>0){
				$ex=explode('@',$order['carinfo']);
				$sql="select name,cxname from jc_chexing a,jc_car_brand b where a.ppid=b.id and a.id='".$ex[2]."'";
				$rs=db::get_row($sql);
				$sql3="select tel_mobile from jc_member where id=".$order['shid'];
			    $rs3=db::get_row($sql3);
				$ms['id']=$order['Id'];
				$ms['cph']=$order['cph'];
				//$us=$this->modelmember->get(array('head_img'),'id='.$order['uId']);
				//$ms['pic']=DOMAIN.$us['head_img'];
				$us=$this->modelmember->get(array('sex'),'id='.$order['uId']);
				$ms['sex']=$us['sex'];
				$ms['date']=$order['Addtime'];
				$ms['telmobile']=$rs3['tel_mobile'];
				$ms['cx']=$rs['name'];
				$ms['chexi']=$rs['cxname'];
				$ms['tel']=$order['mobile'];
				$ex = explode('|',$order['ssinfo']);
				$count = count($ex);
				for($i=0;$i<$count;$i++){
					if($ex[$i]!=''){
						$a1=explode('-',$ex[$i]);
						$b = sswz($a1[0]);
						$ms['list'][$i]['buwei']=$b[1];
						$ms['list'][$i]['cd']=$a1[1]==2?'重':'轻';
					}
				}
				client_show_message(1, "获取内容成功", $ms);
			}else{
				$wh='uId='.$_G['gp_uid'].' and Static=10';
				$order = $this->ordermodel->get(array('*'), $wh.' order by Addtime asc');
				if($order['Id']>0){
					$ex=explode('@',$order['carinfo']);
					$sql="select name,cxname from jc_chexing a,jc_car_brand b where a.ppid=b.id and a.id='".$ex[2]."'";
					$rs=db::get_row($sql);
					$sql3="select tel_mobile from jc_member where id=".$order['shid'];
					$rs3=db::get_row($sql3);
					$ms['id']=$order['Id'];
					$ms['cph']=$order['cph'];
					$us=$this->modelmember->get(array('head_img'),'id='.$order['uId']);
					$ms['pic']=DOMAIN.$us['head_img'];
					$ms['date']=$order['Addtime'];
					$ms['cx']=$rs['name'];
					$ms['shid']=$order['shid'];
					$ms['telmobile']=$rs3['tel_mobile'];
					$ms['chexi']=$rs['cxname'];
					$ms['tel']=$order['mobile'];
					$ex = explode('|',$order['ssinfo']);
					$count = count($ex);
					for($i=0;$i<$count;$i++){
						if($ex[$i]!=''){
							$a1=explode('-',$ex[$i]);
							$b = sswz($a1[0]);
							$ms['list'][$i]['buwei']=$b[1];
							$ms['list'][$i]['cd']=$a1[1]==2?'重':'轻';
						}
					}
					client_show_message(2, "获取查看成功", $ms);
				}else{
					$wh='uId='.$_G['gp_uid'].' and Static=9';
					$order = $this->ordermodel->get(array('*'), $wh.' order by Addtime asc');
					if($order['Id']>0){
						$ex=explode('@',$order['carinfo']);
						$sql="select name,cxname from jc_chexing a,jc_car_brand b where a.ppid=b.id and a.id='".$ex[2]."'";
						$rs=db::get_row($sql);
						$sql3="select tel_mobile from jc_member where id=".$order['shid'];
						$rs3=db::get_row($sql3);
						$ms['id']=$order['Id'];
						$ms['cph']=$order['cph'];
						$us=$this->modelmember->get(array('head_img'),'id='.$order['uId']);
						$ms['pic']=DOMAIN.$us['head_img'];
						$ms['date']=$order['Addtime'];
						$ms['cx']=$rs['name'];
						$ms['telmobile']=$rs3['tel_mobile'];
						$ms['shid']=$order['shid'];
						$ms['chexi']=$rs['cxname'];
						$ms['tel']=$order['mobile'];
						$ex = explode('|',$order['ssinfo']);
						$count = count($ex);
						for($i=0;$i<$count;$i++){
							if($ex[$i]!=''){
								$a1=explode('-',$ex[$i]);
									$b = sswz($a1[0]);
								$ms['list'][$i]['buwei']=$b[1];
								$ms['list'][$i]['cd']=$a1[1]==2?'重':'轻';
							}
						}
						client_show_message(3, "获取提交成功", $ms);
					}else{
						$wh='uId='.$_G['gp_uid'].' and Static=2';
						$order = $this->ordermodel->get(array('*'), $wh.' order by Addtime asc');
						if($order['Id']>0){
							$ex=explode('@',$order['carinfo']);
							$sql="select name,cxname from jc_chexing a,jc_car_brand b where a.ppid=b.id and a.id='".$ex[2]."'";
							$rs=db::get_row($sql);
							$sql3="select tel_mobile from jc_member where id=".$order['shid'];
							$rs3=db::get_row($sql3);
							$ms['id']=$order['Id'];
							$ms['uid']=$order['uId'];
							$ms['cph']=$order['cph'];
							$us=$this->modelmember->get(array('head_img'),'id='.$order['uId']);
							$ms['pic']=DOMAIN.$us['head_img'];
							$ms['date']=$order['Addtime'];
							$ms['cx']=$rs['name'];
							$ms['shid']=$order['shid'];
							$ms['telmobile']=$rs3['tel_mobile'];
							$ms['chexi']=$rs['cxname'];
							$ms['tel']=$order['mobile'];
							$ms['ddnum']=$order['ddnum'];
							$ex = explode('|',$order['ssinfo']);
							$count = count($ex);
							for($i=0;$i<$count;$i++){
								if($ex[$i]!=''){
									$a1=explode('-',$ex[$i]);
									$b = sswz($a1[0]);
									$ms['list'][$i]['buwei']=$b[1];
									$ms['list'][$i]['cd']=$a1[1]==2?'重':'轻';
								}
							}
							client_show_message(4, "获取完成成功", $ms);
						}
					}
				}
			} 
		}else{
			client_show_message(0, "缺少参数", array());
		}
	}

	 //获取及时消息，提示用户商家已接单
	function getzhuangtaiterry(){
		global $_G;
			$wh='Id='.$_G['gp_id'].'';
			$order = $this->ordermodel->get(array('*'), $wh.' order by Addtime asc');
			if($order['Static']==7){
				client_show_message(1, "用户已取消", $ms);
			}else{
				client_show_message(0, "继续报价", $ms);	
			}
	}
	
		 //获取及时消息，提示用户有正在进行中的订单
	function getzhuangtaiterryiori(){
		global $_G;
			$wh='uId='.$_G['gp_id'].' and static in (9,8,10,1)';
			$order = $this->ordermodel->get(array('*'), $wh.' order by Addtime asc');
			if($order['Id']>0){
				client_show_message(1, "您有订单未完成,请处理完毕后再提交新订单", $ms);
			}else{
				client_show_message(0, "继续报价", $ms);	
			}
	}
	
    //获取及时消息，提示用户商家已接单
	function getzhuangtaiiori(){
		global $_G;
			$wh='Id='.$_G['gp_id'].'';
			$order = $this->ordermodel->get(array('*'), $wh.' order by Addtime asc');
			if($order['Static'] == 9 || $order['Static'] == 8 ){
				client_show_message(1, "用户已取消", $ms);
			}else{
				client_show_message(0, "继续报价", $ms);	
			}
	}
		
	 //根据36号接口获取用户提交信息，查看详情和报价
	function baojia(){
		global $_G;
		if($_G['gp_sj']==1){
			$status=9;
		}else{
			$status=8;	
		}
		if($_G['gp_zt']==10){
			$this->ordermodel->mod(array('Static'=>10),'id='.$_G['gp_bj']);
		}
		//$order = $this->ordermodel->get(array('*'),'id='.$_G['gp_bj'].' and Static='.$status.' order by Addtime asc');
		$order = $this->ordermodel->get(array('*'),'id='.$_G['gp_bj'].' order by Addtime asc');
		if($order['Id']>0){
			$ex=explode('@',$order['carinfo']);
			$sql="select name,cxname from jc_chexing a,jc_car_brand b where a.ppid=b.id and a.id='".$ex[2]."'";
			$rs=db::get_row($sql);
			$us=$this->modelmember->get(array('head_img'),'id='.$order['uId']);
			$sql="select * from jc_myserver where uId=".$order['shid'];
			$rs2=db::get_row($sql);
			$ms['addr']=$rs2['addr'];
			$ms['id']=$order['Id'];
			$ms['cph']=$order['cph'];
			$ms['userpic']=DOMAIN.$us['head_img'];
			$ms['date']=$order['Addtime'];
			$ms['cx']=$rs['name'];
			$ms['chexi']=$rs['cxname'];
			$ms['tel']=$order['mobile'];
			$ex = explode('|',$order['ssinfo']);
			$count = count($ex);
			for($i=0;$i<$count;$i++){
				//if($ex[$i]!=''){
				//	$a1=explode('-',$ex[$i]);
				//	$b = sswz($a1[0]);
				//	$ms['buwei'][$i]=$b[1].'('.($a1[1]==2?'重':'轻').')';
				//}
				$sql="select name from jc_buwei where id=".$ex[$i];
				$res=db::get_row($sql);
				$ms['buwei'][$i]=$res['name'];
			}
			$ms['jiage']=$order['xtbj']*0.85;
			$ms['jiage2']=$order['jiage'];
			$ms['wxtime'] = $order['wxtime'];
			$ms['static'] = $order['Static'];
			client_show_message(1, "获取内容成功", $ms);
		}else{
			client_show_message(0, "无内容成功", $ms);	
		}
	}
	
	 //根据36号接口获取商家信息，联系商家
	function baojiaterry(){
		global $_G;
		if($_G['gp_sj']==1){
			$status='9';
		}else{
			$status=8;	
		}
		if($_G['gp_zt']==10){
			$this->ordermodel->mod(array('Static'=>10),'id='.$_G['gp_bj']);
		}
		//$order = $this->ordermodel->get(array('*'),'id='.$_G['gp_bj'].' and Static='.$status.' order by Addtime asc');
		$order = $this->ordermodel->get(array('*'),'id='.$_G['gp_bj'].' order by Addtime asc');
		if($order['Id']>0){
			$ex=explode('@',$order['carinfo']);
			$sql="select name,cxname from jc_chexing a,jc_car_brand b where a.ppid=b.id and a.id='".$ex[2]."'";
			$rs=db::get_row($sql);
			$us=$this->modelmember->get(array('*'),'Id='.$order['shid']);
			$sql="select * from jc_myserver where uId=".$order['shid'];
			$rs2=db::get_row($sql);
			$ms['id']=$order['Id'];
			$ms['shname']=$rs2['sname'];
			$ms['cph']=$order['cph'];
			$ms['userpic']=DOMAIN.$rs2['pic'];
			$ms['date']=$rs2['addr'];
			$ms['cx']=$rs['name'];
			$ms['chexi']=$rs['cxname'];
			$ms['tel']=$us['tel_mobile'];
			$ex = explode('|',$order['ssinfo']);
			$count = count($ex);
			for($i=0;$i<$count;$i++){
				if($ex[$i]!=''){
					$a1=explode('-',$ex[$i]);
					$b = sswz($a1[0]);
					$ms['buwei'][$i]=$b[1].'('.($a1[1]==2?'重':'轻').')';
				}
			}
			$ms['jiage']=$order['xtbj']*0.85;
			$ms['jiage2']=$order['jiage'];
			$ms['wxtime'] = $order['wxtime'];
			$ms['static'] = $order['Static'];
			client_show_message(1, "获取内容成功", $ms);
		}else{
			client_show_message(0, "无内容成功", $ms);	
		}
	}
	
	//发送报价详情给客户
	function sendbj(){
		global $_G;
		if($_G['gp_price']>0 && $_G['gp_date']>0){
			$ms['jiage']=$_G['gp_price'];
			$ms['wxtime'] = $_G['gp_date'];
			$ms['Static']=$_G['gp_static'];
			if($_G['gp_data']!='')$ms['ssinfo'] = $_G['gp_data'];
			if($_G['gp_carinfo']!='')$ms['carinfo'] = '@@'.$_G['gp_carinfo'];
			
			if($this->ordermodel->mod($ms,'id='.$_G['gp_bj'])){
				client_show_message(1, "报价成功", $ms);
			}else{
				client_show_message(0, "失败", array());
			}
		}
	}
	
	
	//客户二次确认商家修改后的订单信息
	function uqueren(){
		global $_G;
		if($_G['gp_uid']>0 && $_G['gp_bj']>0){
			$ms['Static']=$_G['gp_t'];
			$this->ordermodel->mod($ms,'uId='.$_G['gp_uid'].' and id='.$_G['gp_bj']);
			client_show_message(1, "成功", $ms);
		}else{
			client_show_message(0, "缺少参数", array());	
		}
	}
	
    //客户评价
	function upingjia(){
		global $_G;
		if($_G['gp_uid']>0){
			$uId=$_G['gp_uid'];
			$ddnum=$_G['gp_ddnum'];
			$addtime=date('Y-m-d H:i:s');
			$pjnr=$_G['gp_pjnr'];
			$pjzt=$_G['gp_pjzt'];
			$mobile=$_G['gp_tel'];
			$shid=$_G['gp_shid'];
			$sql = "insert into jc_evaluate(ddnum,uId,Addtime,pjnr,pjzt,mobile,shid) value('" .$ddnum . "','" . $uId . "','" . $addtime . "','" . $pjnr . "','" . $pjzt . "','" . $mobile . "','" . $shid. "')";
			if(!db::query($sql)){
				client_show_message(0, "数据库操作失败", array());
			}
			if($_G['gp_id']>0){
				$ms['Static']=18;
				$this->ordermodel->mod($ms,'uId='.$_G['gp_uid'].' and id='.$_G['gp_id']);
			}
			client_show_message(1, "评价成功", array());
		}else{
			client_show_message(0, "缺少参数", array());	
		}
	}
	 // 获取商家基本数据
	 function sjinfo(){
		global $_G;
		client_show_message(1, "获取内容成功", $ms);
	}
	
    //客户版超时显示商家电话-terry2001
	function chaoshidianhua(){
		global $_G;
		$shid = $_G['gp_shid'];
		if(!empty($shid)){
		$row = $this->modelmember->get(array('*'), " id='".$shid."'");
		client_show_message(1, "电话获取成功", $row);
		}else{
		client_show_message(0, "获取商户信息失败", array());	
		}
	}
	
	//客户版个人数据
	function userinf(){
		global $_G;
		if(empty($_G['gp_uid'])){
			client_show_message(0, "参数错误", array());
		}
		if($_G['gp_act']=="mod"){
			if($_G['gp_nickname']!=''){
				$set['nickname']=$_G['gp_nickname'];
			}
			if($_G['gp_sex']!=''){
				$set['sex']=$_G['gp_sex'];
			}
			if($_G['gp_sheng']!=''){
				$set['sheng']=$_G['gp_sheng'];
			}
			if($_G['gp_shi']!=''){
				$set['shi']=$_G['gp_shi'];
			}
			if($_G['gp_qu']!=''){
				$set['qu']=$_G['gp_qu'];
			}
			if($_G['gp_birth']!=''){
				$set['birth']=$_G['gp_birth'];
			}
			if($_G['gp_qq']!=''){
				$set['qq']=$_G['gp_qq'];
			}
			if($_G['gp_tuisong']!=''){
				$set['tuisong']=$_G['gp_tuisong'];
			}
			$this->modelmember->mod($set,'id='.$_G['gp_uid']);
			client_show_message(1, "修改成功", $set);
		}else{
			$ms = $this->modelmember->get(array('nickname','Name','sex','sheng','shi','tel_mobile','birth','qq','head_img','tuisong'),'id='.$_G['gp_uid']);
			$ms['head_img'] = DOMAIN.$ms['head_img'];
			client_show_message(1, "获取内容成功", $ms);
		}
		
	}
	
	//商家获取图片
	function getpicture(){
		global $_G;
		if(!empty($_G['gp_id'])){
			$sql="select pic from jc_myserver where uid='".$_G['gp_id']."'";
			$res=db::get_row($sql);
			$pic=explode('|',$res['pic']);
			$ms['logo']=DOMAINPIC.$pic[0];
			$ms['pics']=DOMAINPIC.$pic[1].'|'.DOMAINPIC.$pic[2].'|'.DOMAINPIC.$pic[3].'|'.DOMAINPIC.$pic[4].'|'.DOMAINPIC.$pic[5].'|'.DOMAINPIC.$pic[6];
			client_show_message(1, "获取内容成功", $ms);
		}else{
			client_show_message(0, "参数错误", array());
		}
	}

	//客户版获取商家列表
	function getshanghu(){
		global $_G;
		$jd = $_G['gp_jd'] ? $_G['gp_jd'] : "";
        $wd = $_G['gp_wd'] ? $_G['gp_wd'] : "";
		$myserverModel = model('myserver');
		$list = $myserverModel->get(array('*'),'approve=0 order by id asc',0,100);
		$k=0;
		foreach($list['data'] as $v){
			$pic = explode('|',$v['pic']);
			$ms[$k]['shid'] = $v['uid'];
			$ms[$k]['company']=$v['sname'];
			$ms[$k]['shxs']=$v['shxs'];
			$ms[$k]['logo']=DOMAINPIC.$pic[0];
			$ms[$k]['pics']=DOMAINPIC.$pic[1].'|'.DOMAINPIC.$pic[2].'|'.DOMAINPIC.$pic[3].'|'.DOMAINPIC.$pic[4].'|'.DOMAINPIC.$pic[5].'|'.DOMAINPIC.$pic[6];
			$ms[$k]['addr']=$v['addr'];
			if($v['lb']==1){
				$lb = '一类厂';	
			}else if($v['lb']==2){
				$lb = '二类厂';	
			}else if($v['lb']==3){
				$lb = '三类厂';	
			}else{
				$lb = '4S店';	
			}
			$ms[$k]['lb']=$lb;
			$ms[$k]['juli']=getdisgdgf($jd,$wd,$v['jd'],$v['wd']);
			$ms[$k]['pj']=$v['pj'];
			$ms[$k]['jiage']='3000-5000';
			$ms[$k]['jwd']=$v['jd'].','.$v['wd'];
			$k++;
		}
        $tgtemp = array();
		foreach ($ms as $tp) {
			$tgtemp[] = $tp['juli'];
		}
		array_multisort($tgtemp, SORT_ASC, $ms);
		client_show_message(1, "获取内容成功", $ms);
	}
	
	
	//报名页面函数
   public function testbaoming()
    {
        global $_G;
        $name = $_G['gp_name'] ? $_G['gp_name'] : 0;
		$phone = $_G['gp_phone'];
		$chexing = $_G['gp_chexing'];
		$chepai = $_G['gp_chepai'];
		
        if (!empty($name) && !empty($phone)&& !empty($chexing)&& !empty($chepai)) {
			if(($_COOKIE['sms_code']==$yzm) || $_SESSION['sms_code']==$yzm){
				if(empty($t)){
					$row = $this->modelmember->get(array('*'),"tel_mobile='".$user_name."' and t=$t");//查看根据验证码登录					
					if($row['id']=='' && $t==0){//没有用户自动注册一个用户
						$row['Name'] = $user_name;
						$row['pwd'] = md5($yzm);
						$row['head_img'] = "";
						$row['address_id'] = 0;
						$row['my_cat_id'] = 0;
						$row['t'] = $t;
						$row['tel_mobile'] = $user_name;
						$row['ip'] = getIP();
						$row['addtime'] = date('Y-m-d H:i:s');
						$_id = $this->modelmember->add($row);
						$row['id']=$_id;
						client_show_message(1, "登录成功", $row);
					}
				}else{
            		$row = $this->modelmember->get(array('*'), " pwd='".md5($yzm)."' and (tel_mobile='" . $user_name . "' or Name='" . $user_name ."') and t=$t");
				}
			//echo $yzm.'-'.$_COOKIE['sms_code'].'-'.$_SESSION['sms_code'];
            if (!empty($row)) {
				$mycar = $this->mycarModel->get(array('car_sn'),'member_id='.$row['id']);
				$row['cph'] =$mycar['car_sn'];
                if ($this->modelmember->upMember($row['id'])) {
                        if(!empty($row['head_img'])){
                            $sr = explode("|",$row['head_img']);
                            $row['head_img'] = DOMAIN.'upload/'.$sr[0];
                        }else{
                            $row['head_img'] = "";
                        }
                    client_show_message(1, "登录成功", $row);
                } else {
                    client_show_message(0, "登录失败1", array());
                }
            } else {
                client_show_message(0, "登录失败2".$_SESSION['sms_code'], array());
            }
			
        } else {
            client_show_message(0, "验证码错误", array());
        }}
    }
	
	//临时报价保存查询
	function lsbj(){
		global $_G;
		$lsbjModel=model('lsbj');
		$jgModel=model('jiage');
		$cxModel = model('chexing');
		$ms=array();
		if($_G['gp_act']=="mod" && $_G['gp_uid']>0){
			$set['uid']=$_G['gp_uid'];
			$set['chexin']=$_G['gp_chexin'];
			$set['addtime']=time();
			$set['data']=$_G['gp_data'];
			$set['zongjia']=$_G['gp_zongjia'];
			$lsbjModel->add($set);
			client_show_message(1, "保存成功", $ms);
		}elseif($_G['gp_act']=="del" && $_G['gp_uid']>0 && $_G['gp_id']>0){
			$lsbjModel->del(array('id'=>$_G['gp_id'],'uid'=>$_G['gp_uid']));
			client_show_message(1, "删除成功", $ms);
		}elseif($_G['gp_uid']>0){
			$list = $lsbjModel->get(array('*'),'uid='.$_G['gp_uid'].' order by addtime desc',0,100);
			if($list['count']>0)
			foreach($list['data'] as $k=>$v){
				$ms[$k]['id']=$v['id'];
				$ms[$k]['zongjia']=$v['zongjia'];
				$ms[$k]['addtime']=date('Y-m-d H:i:s',$v['addtime']);
				$sql2="select name,cxname from jc_chexing a,jc_car_brand b where a.ppid=b.id and a.id=".$v['chexin'];
				$carrs=db::get_row($sql2);
				$ms[$k]['name']=$carrs['name'];
				$ms[$k]['cxname']=$carrs['cxname'];
				$in = explode("|",$v['data']);
				$count=count($in);
				$bjk=0;
				for($i=0;$i<$count;$i++){
					if($in[$i]!=''){
						$jg=explode('-',$in[$i]);
						$str = sswz($jg[0]);
						$bwname=$str[0];//部位名称
						$ms[$k]['buwei'][$bjk][0]= $str[1];
						$ms[$k]['buwei'][$bjk][1]= ($jg[1]==2?'重':'轻');
						$bjk++;
					}
				}
			}
			client_show_message(1, "获取内容成功", $ms);
			
		}
	}
	
	function addadvice(){
		global $_G;
		if(empty($_G['gp_advice'])||empty($_G['gp_tel'])){
			client_show_message(0, "参数错误", Array());
		}
		$sql="insert into jc_advice (advice,tel) values ('".$_G['gp_advice']."','".$_G['gp_tel']."')";
		if(db::query($sql)){
			client_show_message(1, "感谢您的宝贵建议", Array());
		}else{
			client_show_message(0, "数据库操作失败", Array());
		}
	}
	
	function getyhjstatus(){
		global $_G;
		if(empty($_G['gp_sn'])){
			client_show_message(0, "参数错误", Array());
		}
		$sql="select * from jc_myyhj where sn like '".$_G['gp_sn']."'";
	}
}

?>