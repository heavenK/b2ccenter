<?php

class ServerAction extends Action{
	
	
	//线路生成
    public function dopostchanpin() {
		//链接服务器生成
		$clientdataID = $_REQUEST['chanpinID'];
		$xianlu = FileGetContents(CLIENT_INDEX."Client/_getxianlu/chanpinID/".$clientdataID);
		$getres = json_decode($serverdataID,true);
		if($getres['error']){
			$returndata['msg'] = $getres['msg'];
			$returndata['error'] = 'true';
			echo json_encode($returndata);
			exit;
		}
		if($xianlu['serverdataID']){
			$returndata['msg'] = "客户端产品获得失败！";
			$returndata['error'] = 'true';
			echo json_encode($returndata);
			exit;
		}
		//获得客户端操作记录
		$record = FileGetContents(CLIENT_INDEX."Client/_getActHistory/dataID/".$clientdataID."/datatype/线路/status/提交到网店");
		if(!$record){
			$returndata['msg'] = "客户端记录获取失败！";
			$returndata['error'] = 'true';
			echo json_encode($returndata);
			exit;
		}
		$Chanpin = D("Chanpin");
		$newdata['xianlu'] = $xianlu;
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
				$zituan['zituan']['child_price'] = $xianlu['erongshoujia']+$v['childxiuzheng'];
				$zituan['zituan']['tuanhao'] = $v['tuanhao'];
				$Chanpin->relation("zituan")->myRcreate($zituan);
			}
			//同步生成到dede
			A("ServerMethod")->_updatetocms($chanpinID);
			echo serialize($chanpinID);	
		}
		else
			echo 'false';
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
			$json['data'][$i]['chanpinID'] = $v['chanpinID'];
			$json['data'][$i]['date'] = $v['chutuanriqi'];
			$json['data'][$i]['enddate'] = jisuanriqi($v['chutuanriqi'],$v['baomingjiezhi'],'减少');
			$json['data'][$i]['renshu'] = $v['renshu'];
			$json['data'][$i]['adult_price'] = $v['adult_price'];
			$json['data'][$i]['child_price'] = $v['child_price'];
			$json['data'][$i]['erpno'] = $v['bianhao'];
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
			echo 'false';
		}
		else
			echo serialize($zituan);
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
    public function getinfo() {
		$json['uid'] = 1;
		$json = json_encode($json);
		echo  $_GET['jsoncallback'].'('.$json.')';
	
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