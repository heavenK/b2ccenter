<?php

class ServerDingdanAction extends Action{
	
    public function _initialize() {
		$this->_myinit();	
	}
	
    public function _myinit() {
		$this->assign("navposition",'订单管理');
	}
	
    public function index() {
		A("Method")->showDirectory("订单控管");
		if($_REQUEST['status']){
			$this->assign("markpos",$_REQUEST['status']);
		}
		$chanpin_list = A('ServerMethod')->_listChanpin('ViewDingdan',$_REQUEST);
		$this->assign("page",$chanpin_list['page']);
		$this->assign("chanpin_list",$chanpin_list['chanpin']);
		$this->display('dingdanlist');
	}
	
    public function dingdanxinxi() {
		A("Method")->showDirectory("订单信息");
		$ViewDingdan = D("ViewDingdan");
		$dingdan = $ViewDingdan->relation("zituanlist")->where("`chanpinID` = '$_REQUEST[chanpinID]'")->find();
		//tuanyuan
		$tuanyuan = $ViewDingdan->relationGet("tuanyuanlist");
		$this->assign("tuanyuan_has",1);
		if(!$tuanyuan){
			$this->assign("tuanyuan_has",0);
			for($i=0;$i<$dingdan['chengrenshu'];$i++){
				$tuanyuan[$i]['manorchild'] = '成人';
				$tuanyuan[$i]['price'] = $shoujia['adultprice'];
			}
			for($i;$i<$dingdan['chengrenshu']+$dingdan['ertongshu'];$i++){
				$tuanyuan[$i]['manorchild'] = '儿童';
				$tuanyuan[$i]['price'] = $shoujia['childprice'];
			}
			for($i;$i<$dingdan['chengrenshu']+$dingdan['ertongshu']+$dingdan['lingdui_num'];$i++){
				$tuanyuan[$i]['manorchild'] = '领队';
				$tuanyuan[$i]['price'] = 0;
			}
		}
		$i = 0;
		foreach($tuanyuan as $v){
			$tuanyuan[$i]['datatext'] = simple_unserialize($v['datatext']);
			$i++;
		}
		$this->assign("tuanyuan",$tuanyuan);
		//提成数据
		$ticheng = $ViewDataDictionary->where("`type` = '提成' AND `status_system` = '1'")->findall();
		$this->assign("ticheng",$ticheng);
		//用户列表
		$ViewUser = D("ViewUser");
		$userlist = $ViewUser->where("`status_system` = '1'")->findall();
		$this->assign("userlist",$userlist);
		//获得个人部门及分类列表
		$bumenfeilei = A("Method")->_getbumenfenleilist();
		$this->assign("bumenfeilei",$bumenfeilei);
		//签字
		$ViewTaskShenhe = D("ViewTaskShenhe");
		$task = $ViewTaskShenhe->where("`dataID` = '$dingdan[chanpinID]' and `datatype` = '订单' and `status` != '待检出' and `status_system` = '1'")->order("processID asc ")->findall();
		$this->assign("task",$task);
		if($_REQUEST['showtype'] == 1){
			A("Method")->showDirectory("子团产品");
			$this->assign("markpos",'订单信息');
			$this->assign("datatitle",' : "'.$dingdan['zituanlist']['title_copy'].'/团期'.$dingdan['zituanlist']['chutuanriqi'].'"');
			$this->display('Chanpin:dingdanxinxi');
		}
		else
		$this->display('dingdanxinxi');
	}
	
	
}
?>