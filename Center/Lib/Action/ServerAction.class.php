<?php

class ServerAction extends Action{
	
	
	//线路生成
    public function dopostchanpin() {
		//链接服务器生成
		$clientdataID = $_REQUEST['chanpinID'];
		$xianlu = FileGetContents(CLIENT_INDEX."Client/_getxianlu/chanpinID/".$clientdataID);
		if($xianlu['error']){
			$returndata['msg'] = $xianlu['msg'];
			$returndata['error'] = 'true';
			echo serialize($returndata);
			exit;
		}
		if($xianlu['serverdataID']){
			$returndata['msg'] = "客户端产品已经提交！";
			$returndata['error'] = 'true';
			echo serialize($returndata);
			exit;
		}
		//获得客户端操作记录
		$record = FileGetContents(CLIENT_INDEX."Client/_getActHistory/dataID/".$clientdataID."/datatype/线路/status/提交到网店");
		if(!$record){
			$returndata['msg'] = "客户端记录获取失败！";
			$returndata['error'] = 'true';
			echo serialize($returndata);
			exit;
		}
		$Chanpin = D("Chanpin");
		$newdata['xianlu'] = $xianlu;
		$newdata['status'] = '上架';
		$newdata['user_name'] = $record['user_name'];
		$newdata['bumen_copy'] = $record['bumen_copy'];
		$newdata['clientID'] = 111;//端ID
		$newdata['clientdataID'] = $clientdataID;//数据ID
		$newdata['xianlu']['datatext'] = serialize($xianlu);
		C('TOKEN_ON',false);
		if(false !== $Chanpin->relation("xianlu")->myRcreate($newdata)){
			$chanpinID = $Chanpin->getRelationID();
			$ViewZituan = D("ViewZituan");
			//子团
			foreach($xianlu['zituanlist'] as $v){
				if($Chanpin->getLastmodel() != 'add'){
					$zt = $ViewZituan->where("`chutuanriqi` = '$v[chutuanriqi]'")->find();
					$zituan['chanpinID'] = $zt['chanpinID'];
				}
				$zituan['parentID'] = $chanpinID;
				$zituan['status'] = '上架';
				$zituan['user_name'] = $newdata['user_name'];
				$zituan['bumen_copy'] = $newdata['bumen_copy'];
				$zituan['clientID'] = $newdata['clientID'];
				$zituan['clientdataID'] = $v['chanpinID'];//客户端子团ID
				$zituan['zituan']['title_copy'] = $xianlu['title'];
				$zituan['zituan']['guojing_copy'] = $xianlu['guojing'];
				$zituan['zituan']['kind_copy'] = $xianlu['kind'];
				$zituan['zituan']['zhuti_copy'] = $xianlu['zhuti'];
				$zituan['zituan']['chutuanriqi'] = $v['chutuanriqi'];
				$zituan['zituan']['baomingjiezhi'] = $v['baomingjiezhi'];
				$zituan['zituan']['renshu'] = $v['renshu'];
				$zituan['zituan']['adult_price'] = $xianlu['shoujia']+$v['adultxiuzheng'];
				$zituan['zituan']['child_price'] = $xianlu['ertongshoujia']+$v['childxiuzheng'];
				$zituan['zituan']['tuanhao'] = $v['tuanhao'];
				$zituan['zituan']['second_confirm'] = $v['second_confirm'];
				$Chanpin->relation("zituan")->myRcreate($zituan);
			}
			//同步生成到dede
			A("ServerMethod")->_updatetocms($chanpinID);
			echo serialize($chanpinID);	
		}
		else{
			$returndata['msg'] = "推送失败！";
			$returndata['error'] = 'true';
			echo serialize($returndata);
			exit;
		}
	}
	
	
	
	//线路生成
    public function dopostchanpin_qianzheng() {
		//链接服务器生成
		$clientdataID = $_REQUEST['chanpinID'];
		$qianzheng = FileGetContents(CLIENT_INDEX."Client/_getqianzheng/chanpinID/".$clientdataID);
		if($qianzheng['error']){
			$returndata['msg'] = $qianzheng['msg'];
			$returndata['error'] = 'true';
			echo serialize($returndata);
			exit;
		}
		if($qianzheng['serverdataID']){
			$returndata['msg'] = "客户端产品已经提交！";
			$returndata['error'] = 'true';
			echo serialize($returndata);
			exit;
		}
		//获得客户端操作记录
		$record = FileGetContents(CLIENT_INDEX."Client/_getActHistory/dataID/".$clientdataID."/datatype/签证/status/提交到网店");
		if(!$record){
			$returndata['msg'] = "客户端记录获取失败！";
			$returndata['error'] = 'true';
			echo serialize($returndata);
			exit;
		}
		$Chanpin = D("Chanpin");
		$newdata['qianzheng'] = $qianzheng;
		$newdata['user_name'] = $record['user_name'];
		$newdata['bumen_copy'] = $record['bumen_copy'];
		$newdata['clientID'] = 111;//端ID
		$newdata['clientdataID'] = $clientdataID;//数据ID
		$newdata['qianzheng']['datatext'] = serialize($qianzheng);
		C('TOKEN_ON',false);
		if(false !== $Chanpin->relation("qianzheng")->myRcreate($newdata)){
			$chanpinID = $Chanpin->getRelationID();
			//同步生成到dede
			A("ServerMethod")->_updatetocms_qianzheng($chanpinID);
			echo serialize($chanpinID);	
		}
		else{
			$returndata['msg'] = "推送失败！";
			$returndata['error'] = 'true';
			echo serialize($returndata);
			exit;
		}
	}
	
	
	
	//更新线路产品
    public function updatechanpin() {
		//链接服务器生成
		$clientdataID = $_REQUEST['chanpinID'];
		$xianlu = FileGetContents(CLIENT_INDEX."Client/_getxianlu/chanpinID/".$clientdataID);
		if($xianlu['error']){
			$returndata['msg'] = $xianlu['msg'];
			$returndata['error'] = 'true';
			echo serialize($returndata);
			exit;
		}
		if(!$xianlu['serverdataID']){
			$returndata['msg'] = "客户端产品不存在！";
			$returndata['error'] = 'true';
			echo serialize($returndata);
			exit;
		}
		$Chanpin = D("Chanpin");
		$chanpin = $Chanpin->relation("xianlu")->where("`clientdataID` = '$clientdataID' AND `chanpinID` = '$xianlu[serverdataID]'")->find();
		if(!$chanpin){
			$returndata['msg'] = "服务器产品不存在！";
			$returndata['error'] = 'true';
			echo serialize($returndata);
			exit;
		}
		C('TOKEN_ON',false);
		//更新线路
		$chanpin['xianlu']['title'] = $xianlu['title'];
		$chanpin['xianlu']['zhuti'] = $xianlu['zhuti'];
		$chanpin['xianlu']['tianshu'] = $xianlu['tianshu'];
		$chanpin['xianlu']['chutuanriqi'] = $xianlu['chutuanriqi'];
		$chanpin['xianlu']['shoujia'] = $xianlu['shoujia'];
		$chanpin['xianlu']['chufadi'] = $xianlu['chufadi'];
		$chanpin['xianlu']['mudidi'] = $xianlu['mudidi'];
		$chanpin['xianlu']['datatext'] = serialize($xianlu);
		if(false !== $Chanpin->relation("xianlu")->myRcreate($chanpin)){
			//更新子团
			$zituanlist = $Chanpin->relationGet("zituanlist");
			foreach($xianlu['zituanlist'] as $vol){
				$is_has = 0;
				foreach($zituanlist as $v){
					//子团存在
					if($v['clientdataID'] == $vol['chanpinID'] && $v['chutuanriqi'] == $vol['chutuanriqi']){
						$v['status'] = $vol['status_shop'];
						$v['zituan']['title_copy'] = $xianlu['title'];
						$v['zituan']['zhuti'] = $xianlu['zhuti'];
						$v['zituan']['baomingjiezhi'] = $vol['baomingjiezhi'];
						$v['zituan']['renshu'] = $vol['renshu'];
						$v['zituan']['tuanhao'] = $vol['tuanhao'];
						$v['zituan']['second_confirm'] = $vol['second_confirm'];
						$v['zituan']['adult_price'] = $xianlu['shoujia']+$vol['adultxiuzheng'];
						$v['zituan']['child_price'] = $xianlu['ertongshoujia']+$vol['childxiuzheng'];
						if(false === $Chanpin->relation("zituan")->myRcreate($v)){
							$returndata['msg'] = "子团推送错误！";
							$returndata['detail'] = $Chanpin;
							$returndata['error'] = 'true';
							echo serialize($returndata);
							exit;
						}
						$is_has = 1;
						break;
					}
				}
				//新增
				if($is_has == 0){
					$zituan['parentID'] = $xianlu['serverdataID'];
					$zituan['user_name'] = $chanpin['user_name'];
					$zituan['bumen_copy'] = $chanpin['bumen_copy'];
					$zituan['clientID'] = $chanpin['clientID'];
					$zituan['clientdataID'] = $vol['chanpinID'];//客户端子团ID
					$zituan['status'] = $vol['status_shop'];
					$zituan['zituan']['title_copy'] = $xianlu['title'];
					$zituan['zituan']['guojing_copy'] = $xianlu['guojing'];
					$zituan['zituan']['kind_copy'] = $xianlu['kind'];
					$zituan['zituan']['zhuti_copy'] = $xianlu['zhuti'];
					$zituan['zituan']['chutuanriqi'] = $vol['chutuanriqi'];
					$zituan['zituan']['baomingjiezhi'] = $vol['baomingjiezhi'];
					$zituan['zituan']['renshu'] = $vol['renshu'];
					$zituan['zituan']['tuanhao'] = $vol['tuanhao'];
					$zituan['zituan']['second_confirm'] = $vol['second_confirm'];
					$zituan['zituan']['adult_price'] = $xianlu['shoujia']+$vol['adultxiuzheng'];
					$zituan['zituan']['child_price'] = $xianlu['ertongshoujia']+$vol['childxiuzheng'];
					$Chanpin->relation("zituan")->myRcreate($zituan);
				}
			}
			//不存在子团下架
			foreach($zituanlist as $v){
				$mark = 0;
				foreach($xianlu['zituanlist'] as $vol){
					if($v['clientdataID'] == $vol['chanpinID'] && $v['chutuanriqi'] == $vol['chutuanriqi']){
						$mark = 1;
						break;
					}
				}
				if($mark == 0){
					$v['status'] = '下架';
					if(false === $Chanpin->mycreate($v)){
						$returndata['msg'] = "子团状态修改失败！";
						$returndata['error'] = 'true';
						echo serialize($returndata);
						exit;
					}
				}
			}
		}
		else{
			$returndata['msg'] = "线路推送错误！";
			$returndata['error'] = 'true';
			echo serialize($returndata);
			exit;
		}
		echo serialize($xianlu);
	}
	
	
	
	
	//更新产品状态
    public function updatechanpin_status($clientdataID='',$chanpintype='',$echomsg=1) {
		//链接服务器生成
		if(!$clientdataID)
			$clientdataID = $_REQUEST['chanpinID'];
		if(!$chanpintype)
			$chanpintype = $_REQUEST['chanpintype'];
		if($chanpintype == '子团'){
			$zituan = FileGetContents(CLIENT_INDEX."Client/_getzituan/chanpinID/".$clientdataID);
			if($zituan['error']){
				$returndata['msg'] = $xianlu['msg'];
				$returndata['error'] = 'true';
				if($echomsg){
					echo serialize($returndata);
					exit;
				}
			}
			if(!$zituan['xianlulist']['serverdataID']){
				$returndata['msg'] = "客户端产品不存在！";
				$returndata['error'] = 'true';
				if($echomsg){
					echo serialize($returndata);
					exit;
				}
			}
			C('TOKEN_ON',false);
			$Chanpin = D("Chanpin");
			$chanpin = $Chanpin->where("`clientdataID` = '$clientdataID'")->find();
			$chanpin['status'] = $zituan['status_shop'];
			if(true === $Chanpin->myRcreate($chanpin)){
				if($echomsg)
					echo serialize($chanpin);
			}
			else
				return false;
		}
		if($chanpintype == '线路'){
			$xianlu = FileGetContents(CLIENT_INDEX."Client/_getxianlu/chanpinID/".$clientdataID);
			if($xianlu['error']){
				$returndata['msg'] = $xianlu['msg'];
				$returndata['error'] = 'true';
				echo serialize($returndata);
				exit;
			}
			if(!$xianlu['serverdataID']){
				$returndata['msg'] = "客户端产品不存在！";
				$returndata['error'] = 'true';
				echo serialize($returndata);
				exit;
			}
			C('TOKEN_ON',false);
			$Chanpin = D("Chanpin");
			$chanpin = $Chanpin->where("`clientdataID` = '$clientdataID'")->find();
			$chanpin['status'] = $xianlu['status_shop'];
			dump($chanpin);
			if(false !== $Chanpin->myRcreate($chanpin)){
				dump($xianlu['zituanlist']);
				dump($xianlu);
				//修改子团
				foreach($xianlu['zituanlist'] as $v_zt){
					dump($v_zt);
					$this->updatechanpin_status($v_zt['chanpinID'],'子团',0);
				}
				echo serialize($chanpin);
			}
			dump($Chanpin);
		}
	}
	
	
	
	
	
	//更新签证产品
    public function updatechanpin_qianzheng() {
		//链接服务器生成
		$clientdataID = $_REQUEST['chanpinID'];
		$qianzheng = FileGetContents(CLIENT_INDEX."Client/_getqianzheng/chanpinID/".$clientdataID);
		if($qianzheng['error']){
			$returndata['msg'] = $qianzheng['msg'];
			$returndata['error'] = 'true';
			echo serialize($returndata);
			exit;
		}
		if(!$qianzheng['serverdataID']){
			$returndata['msg'] = "客户端产品不存在！";
			$returndata['error'] = 'true';
			echo serialize($returndata);
			exit;
		}
		$Chanpin = D("Chanpin");
		$chanpin = $Chanpin->relation("qianzheng")->where("`clientdataID` = '$clientdataID' AND `chanpinID` = '$qianzheng[serverdataID]'")->find();
		if(!$chanpin){
			$returndata['msg'] = "服务器产品不存在！";
			$returndata['error'] = 'true';
			echo serialize($returndata);
			exit;
		}
		C('TOKEN_ON',false);
		//更新
		$chanpin['qianzheng']['title'] = $qianzheng['title'];
		$chanpin['qianzheng']['shoujia'] = $qianzheng['shoujia'];
		$chanpin['qianzheng']['datatext'] = serialize($qianzheng);
		if(false === $Chanpin->relation("qianzheng")->myRcreate($chanpin)){
			$returndata['msg'] = "签证推送错误！";
			$returndata['error'] = 'true';
			echo serialize($returndata);
			exit;
		}
		echo serialize($qianzheng);
	}
	
	
	//线路
    public function getxianlubyID() {
		$erpxianluID = $_REQUEST['erpxianluID'];
		if(!$erpxianluID){
			$json['error'] = true;
			$json['msg'] = '该线路不存在';
		}
		$ViewXianlu = D("ViewXianlu");
		$xianlu = $ViewXianlu->relation("zituanlist")->where("`chanpinID` = '$erpxianluID'")->find();
		$i = 0;
		foreach($xianlu['zituanlist'] as $v){
			//不显示下架子团
			if($v['status'] == '下架')
				continue;
			$json['data'][$i]['chanpinID'] = $v['chanpinID'];
			$json['data'][$i]['date'] = $v['chutuanriqi'];
			$json['data'][$i]['enddate'] = jisuanriqi($v['chutuanriqi'],$v['baomingjiezhi'],'减少');
			$json['data'][$i]['renshu'] = $v['renshu'];
			$json['data'][$i]['adult_price'] = $v['adult_price'];
			$json['data'][$i]['child_price'] = $v['child_price'];
			$json['data'][$i]['erpno'] = $v['tuanhao'];
			$json['data'][$i]['second_confirm'] = $v['second_confirm'];
			$i++;
		}
		$json = json_encode($json);
		echo  $_GET['jsoncallback'].'('.$json.')';
	}
	
	
	//子团
    public function getzituanbyID() {
		$chanpinID = $_REQUEST['chanpinID'];
		$ViewZituan = D("ViewZituan");
		$zituan = $ViewZituan->relation("xianlulist")->where("`chanpinID` = '$chanpinID'")->find();
		if(!$zituan){
			$returndata['msg'] = '子团获取失败！';
			$returndata['error'] = 'true';
			echo serialize($returndata);
		}
		else
			echo serialize($zituan);
	}
	
	
	//签证
    public function getqianzhengbyID() {
		$chanpinID = $_REQUEST['chanpinID'];
		$ViewQianzheng = D("ViewQianzheng");
		$qianzheng = $ViewQianzheng->where("`chanpinID` = '$chanpinID'")->find();
		if(!$qianzheng){
			$returndata['msg'] = '签证获取失败！';
			$returndata['error'] = 'true';
			echo serialize($returndata);
		}
		else
			echo serialize($qianzheng);
	}
	
	
	//产品预订
    public function _dopostbook1() {
		$chanpin = A("Method")->_checkchanpin($_REQUEST['chanpinID']);
		if(false === $chanpin){
			echo "产品不存在或已经停止销售！！";
			exit;
		}
		$chanpin = str_replace('﻿','',$chanpin);//未知原因数据序列化后多3个不可见字符问题，序列化失败解决办法。
		$chanpin = unserialize($chanpin);
		//提交到购物车
		$rows['chanpinID'] = $_REQUEST['chanpinID'];
		$rows['chengrenshu'] = $_REQUEST['chengrenshu'];
		$rows['ertongshu'] = $_REQUEST['ertongshu'];
		$rows['adlutprice'] = $chanpin['adult_price'];
		$rows['childprice'] = $chanpin['child_price'];
		$rows['title']     = $chanpin['title_copy'];
		$rows['chufadi']     = $chanpin['xianlulist']['chufadi'];
		$rows['chutuanriqi']     = $chanpin['chutuanriqi'];
		$rows['tuanhao']     = $chanpin['tuanhao'];
		$rows['tianshu']     = $chanpin['xianlulist']['tianshu'];
		//dump($rows);
		DEDEShopCar_addItem($rows['chanpinID'], $rows);
		$orderID = 'OrdersId_'.$_REQUEST['chanpinID'];
		redirect(SITE_INDEX."Order/book2/orderID/".$orderID);
	}
	
	
	
	//检查用户登录
//    public function getinfo() {
//		$json['uid'] = 1;
//		$json = json_encode($json);
//		echo  $_GET['jsoncallback'].'('.$json.')';
//	
//	}
	
	
	//接收推送订单
    public function dopostOrder() {
		$orderID = $_REQUEST['orderID'];
		$Dingdan = D("Dingdan");
		$order = $Dingdan->where("`orderID` = '$orderID'")->find();
		if($order){
			$returndata['msg'] = "订单已经存在服务器！";
			$returndata['error'] = 'true';
			echo serialize($returndata);
			exit;
		}
		$order = FileGetContents(WEB_INDEX."B2CService/getorder/orderID/".$orderID);
		if($order['error']){
			$returndata['msg'] = '网站订单获取失败！';
			$returndata['error'] = 'true';
			echo serialize($returndata);
			exit;
		}
		//判断状态
		if($order['status'] != '已支付'){
			$returndata['msg'] = '订单状态错误！';
			$returndata['error'] = 'true';
			echo serialize($returndata);
			exit;
		}
		//获得产品
		$Chanpin = D("Chanpin");
		$chanpin = $Chanpin->where("`chanpinID` = '$order[serverdataID]'")->find();
		if(!$chanpin){
			$returndata['msg'] = '服务器产品获取失败！';
			$returndata['error'] = 'true';
			echo serialize($returndata);
			exit;
		}
		//保存订单
		C('TOKEN_ON',false);
		$Chanpin = D("Chanpin");
		$dingdan['parentID'] = $order['serverdataID'];
		$dingdan['dingdan']['erp_parentID'] = $chanpin['clientdataID'];
		$dingdan['dingdan']['title'] = $order['title_copy'];
		$dingdan['dingdan']['chengrenshu'] = $order['chengrenshu'];
		$dingdan['dingdan']['ertongshu'] = $order['ertongshu'];
		$dingdan['dingdan']['price'] = $order['price'];
		$dingdan['dingdan']['lxr_telnum'] = $order['lxr_telnum'];
		$dingdan['dingdan']['lxr_email'] = $order['lxr_email'];
		$dingdan['dingdan']['lxr_name'] = $order['lxr_name'];
		$dingdan['dingdan']['orderID'] = $order['orderID'];
		$dingdan['dingdan']['orderNo'] = $order['orderNo'];
		$dingdan['dingdan']['type'] = $order['type'];
		$dingdan['dingdan']['adult_price'] = $order['adult_price'];
		$dingdan['dingdan']['child_price'] = $order['child_price'];
		$dingdan['dingdan']['webdingdanID'] = $order['id'];
		$dingdan['dingdan']['datatext'] = serialize($order);
		if(false !== $Chanpin->relation('dingdan')->myRcreate($dingdan)){
			$dingdan['chanpinID'] = $Chanpin->getRelationID();
			//推送到erp
			$order = FileGetContents(CLIENT_INDEX."Client/dopostOrder/orderID/".$order['orderID']);
			echo serialize($dingdan);
		}
		else{
			$returndata['msg'] = '订单服务器推送失败！';
			$returndata['error'] = 'true';
			echo serialize($returndata);
			exit;
		}
	}
	
	
	
    public function getorder() {
		$orderID = $_REQUEST['orderID'];
		$ViewDingdan = D("ViewDingdan");
		$order = $ViewDingdan->where("`orderID` = '$orderID'")->find();
		if($order['type'] == '标准'){
			$order['zituanlist'] = $ViewDingdan->relationGet('zituanlist');
		}
		if(!$order){
			$returndata['msg'] = '订单获取失败！';
			$returndata['error'] = 'true';
			echo serialize($returndata);
		}
		else
			echo serialize($order);
		
	}
	
	
	
	
	
	
	
	
	
	
	
	
    public function test() {
		
		//jsonp1355985418062(
//		{
//		data:[
//		{groupid:14344,date:'2013-01-16',enddate:'2012-12-26',renshu:3,adult_price:14288,child_price:12859,lineid:38845,erpno:'CAI2013-PEK0120PEK0120-1000647'},
//		{groupid:14403,date:'2013-02-07',enddate:'2013-01-17',renshu:10,adult_price:16888,child_price:15188,lineid:39035,erpno:'CAI2013-PEK0120PEK0120-1000618'},
//		{groupid:14416,date:'2013-02-13',enddate:'2013-01-23',renshu:10,adult_price:16888,child_price:15188,lineid:39053,erpno:'CAI2013-PEK0120PEK0120-1000567'}
//		],
//		line:[
//		{id:38845,url:'http://www.caissa.com.cn/201211/38845.shtml'},
//		{id:39035,url:'http://www.caissa.com.cn/201211/39035.shtml'},
//		{id:39053,url:'http://www.caissa.com.cn/201211/39053.shtml'}
//		],
//		other:[],
//		status:1
//		}
//		)
	
	//数据返回信息包含：1，data子团信息，包括erp查询码。2.line子团显示页面数据。3.other相关产品信息。4.status标识线路报名状态
	//groupid标识group,group为data的一维数组。
		
		$aaa['data'][0]['groupid'] = '11111';
		$aaa['data'][0]['date'] = '2013-02-07';
		$aaa['data'][0]['enddate'] = '2013-02-07';
		$aaa['data'][0]['renshu'] = '3';
		$aaa['data'][0]['adult_price'] = '222222';
		$aaa['data'][0]['child_price'] = '33333333';
		$aaa['data'][0]['lineid'] = '38845';
		$aaa['data'][0]['erpno'] = 'CAI2013-PEK0120PEK0120-1000647';
		$aaa['data'][1]['groupid'] = '2222';
		$aaa['data'][1]['date'] = '2013-02-11';
		$aaa['data'][1]['enddate'] = '2013-02-11';
		$aaa['data'][1]['renshu'] = '3';
		$aaa['data'][1]['adult_price'] = '5555555';
		$aaa['data'][1]['child_price'] = '666666666';
		$aaa['data'][1]['lineid'] = '38845';
		$aaa['data'][1]['erpno'] = '543424234';
		$aaa['line'][0]['id'] = '38845';
		$aaa['line'][0]['url'] = 'http://www.caissa.com.cn/201211/38845.shtml';
		$aaa['line'][1]['id'] = '38845';
		$aaa['line'][1]['url'] = 'http://www.caissa.com.cn/201211/38845.shtml';
		$aaa['other'] = array();
		$aaa['status'] = 1;
		$aaa = json_encode($aaa);
		
		echo  $_GET['jsoncallback'].'('.$aaa.')';

	}
}
?>