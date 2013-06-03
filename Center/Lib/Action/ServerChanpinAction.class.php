<?php

class ServerChanpinAction extends Action{
	
    public function _initialize() {
		$this->_myinit();	
	}
	
    public function _myinit() {
		$this->assign("navposition",'旅游产品');
	}
	
    public function index() {
		A("Method")->showDirectory("线路产品");
		$chanpin_list = A('ServerMethod')->_listChanpin('ViewXianlu',$_REQUEST);
		$this->assign("page",$chanpin_list['page']);
		$this->assign("chanpin_list",$chanpin_list['chanpin']);
		$this->display('index');
    }
	
	public function left_fabu($htmltp='',$pagetype='') {
		$this->display('ServerChanpin:'.$htmltp);
	}
	
    public function zituanlist() {
		A('ServerMethod')->_zituanlist('产品搜索');
    }
	
	
	public function header_chanpin() {
		$this->display('ServerChanpin:header_chanpin');
	}
	
	public function header_kongguan() {
		$this->display('ServerChanpin:header_kongguan');
	}
	
	
    public function xianlu() {
		A('ServerMethod')->_xianlu();
    }
	
    public function xingcheng() {
		A('ServerMethod')->_xianlu('行程');
    }
	
    public function chengbenshoujia() {
		A('ServerMethod')->_xianlu('成本售价');
    }
	
    public function zituan() {
		A('ServerMethod')->_xianlu('子团管理');
    }
	
	public function zituanxinxi() {
		A('ServerMethod')->_xianlu('子团产品');
	}
	
	public function zituandingdan() {
		A("Method")->showDirectory("子团产品");
		$this->assign("markpos",'子团订单');
		$chanpinID = $_REQUEST['chanpinID'];
		$ViewZituan = D("ViewZituan");
		$zituan = $ViewZituan->where("`chanpinID` = '$chanpinID'")->find();
		$this->assign("zituan",$zituan);
		$this->assign("datatitle",' : "'.$zituan['title_copy'].'/团期'.$zituan['chutuanriqi'].'"');
		$ViewDingdan = D("ViewDingdan");
		$dingdanlist = $ViewDingdan->order("time desc")->where("`parentID` = '$_REQUEST[chanpinID]' AND `status_system` = '1'")->findall();
		$DataCD = D("DataCD");
		$i = 0;
		foreach($dingdanlist as $v){
		//新老客户数
			$dingdanlist[$i]['xinkehu_num'] = $DataCD->where("`dingdanID` = '$v[chanpinID]' and `laokehu` = '0'")->count();
			$dingdanlist[$i]['laokehu_num'] = $DataCD->where("`dingdanID` = '$v[chanpinID]' and `laokehu` = '1'")->count();
			$i++;
		}
		//剩余人数
		$tuanrenshu = A("Method")->_getzituandingdan($_REQUEST['chanpinID']);
		$this->assign("tuanrenshu",$tuanrenshu);
		$this->assign("dingdanlist",$dingdanlist);
		$this->display('zituandingdan');
	}
	
	
	
	
	
	//文章流程
	public function testdede() {
		C('TOKEN_ON',false);
		$ViewXianlu = D("ViewXianlu");
		$mid =  0;//会员ID
		$xianlu = $ViewXianlu->relation("zituanlist")->where("`chanpinID` = '156'")->find();
		//线路文章
		A("ServerMethod")->_processArticle($xianlu,'DEDEAddonarticleXianlu',$mid,A_XIANLU_TYPEID,A_XIANLU_CHANNEL);
		
	}
	
	
	
	
	
	
	
	
	
	
	
}
?>