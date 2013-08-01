<?php

class ServerMethodAction extends CommonAction{
	
	
    public function _initialize() {
		if($_REQUEST['_URL_'][0] == 'ServerMethod'){
			$this->display('Index:error');
			exit;
		}
	}
	
	
    public function _listChanpin($class_name,$where,$pagenum = 20) {
		
		$where['status_system'] = 1;
		$where = A("Method")->_facade($class_name,$where);//过滤搜索项
		
		$ViewClass = D($class_name);
        import("@.ORG.Page");
        C('PAGE_NUMBERS',10);
		$count = $ViewClass->where($where)->count();
		$p= new Page($count,$pagenum);
		$page = $p->show();
		if(!$order)
			$order = 'time desc';
        $chanpin = $ViewClass->where($where)->order($order)->limit($p->firstRow.','.$p->listRows)->select();
		$redata['page'] = $page;
		$redata['chanpin'] = $chanpin;
		return $redata;
		
	}
	
	
	public function _zituanlist($dotype) {
		if($_REQUEST['kind_copy'] == '近郊游')$this->assign("markpos",'近郊游');
		elseif($_REQUEST['kind_copy'] == '长线游')$this->assign("markpos",'长线游');
		elseif($_REQUEST['kind_copy'] == '韩国')$this->assign("markpos",'韩国');
		elseif($_REQUEST['kind_copy'] == '日本')$this->assign("markpos",'日本');
		elseif($_REQUEST['kind_copy'] == '台湾')$this->assign("markpos",'台湾');
		elseif($_REQUEST['kind_copy'] == '港澳')$this->assign("markpos",'港澳');
		elseif($_REQUEST['kind_copy'] == '东南亚')$this->assign("markpos",'东南亚');
		elseif($_REQUEST['kind_copy'] == '欧美岛')$this->assign("markpos",'欧美岛');
		elseif($_REQUEST['kind_copy'] == '自由人')$this->assign("markpos",'自由人');
		elseif($_REQUEST['kind_copy'] == '包团')$this->assign("markpos",'包团');
		else $this->assign("markpos",'全部');
		$datalist = $this->_listChanpin('ViewZituan',$_REQUEST);
		$ViewDingdan = D("ViewDingdan");
		$i = 0;
		foreach($datalist['chanpin'] as $v){
			//搜索订单
			$dingdanall = $ViewDingdan->where("`parentID` = '$v[chanpinID]'")->findall();
			foreach($dingdanall as $vol){
				if($vol['status'] == '确认' || $vol['status'] == '占位'){
					$datalist['chanpin'][$i]['dingdan_renshu'] += $vol['chengrenshu'] + $vol['ertongshu'];
				}
			}
			$datalist['chanpin'][$i]['shengyu_num'] = $v['renshu'] - $datalist['chanpin'][$i]['dingdan_renshu'];
			$i++;
		}
		
		$this->assign("page",$datalist['page']);
		$this->assign("chanpin_list",$datalist['chanpin']);
		if($dotype == '产品搜索'){
			A("Method")->showDirectory("子团产品");
			$this->display('ServerChanpin:zituanlist');
		}
		return $datalist['chanpin'];
	}
	
	
	
	public function _xianlu($dotype) {
		$chanpinID = $_REQUEST["chanpinID"];
		if($dotype == '子团产品'){
			$ViewZituan = D("ViewZituan");
			$zituan = $ViewZituan->where("`chanpinID` = '$chanpinID'")->find();
			$chanpinID = $zituan['parentID'];
		}
		$ViewXianlu = D('ViewXianlu');
		$xianlu = $ViewXianlu->where("`chanpinID` = '$chanpinID'")->find();
		$xianlu = simple_unserialize($xianlu['datatext']);
		list($fuwu1,$fuwu2) = split('[,]',$xianlu['daoyoufuwu']);
		if(!$fuwu2){
			if($fuwu1 == '全陪')
			$xianlu['quanpei'] = $fuwu1;
			if($fuwu1 == '地陪')
			$xianlu['dipei'] = $fuwu1;
		}
		else{
			$xianlu['quanpei'] = $fuwu1;
			$xianlu['dipei'] = $fuwu2;
		}
		if($xianlu['guojing'] == '境外' || $xianlu['kind'] == '包团')
			$xianlu['xianlu_ext'] = simple_unserialize($xianlu['xianlu_ext']);
		//主题
		$this->assign("xianlu",$xianlu);
		$this->assign("datatitle",' : "'.$xianlu['title'].'"');
		if(!$dotype){
			A("Method")->showDirectory("基本信息");
			$this->display('ServerChanpin:xianlu');
		}
		if($dotype == '行程'){
			A("Method")->showDirectory("行程");
			$xianlu['datatext'] = simple_unserialize($xianlu['datatext']);
			$xingcheng_1 = $xianlu['datatext']['xingcheng'];
			$this->assign("chanpin",$xianlu);
			$this->assign("xingcheng_1",$xingcheng_1);
			$this->assign("xingcheng",$xianlu['xingchenglist']);
			$this->display('ServerChanpin:xingcheng');
		}
		if($dotype == '成本售价'){
			A("Method")->showDirectory("成本售价");
			$shoujia = $xianlu['shoujialist'];
			$shoujia = A("Method")->_fenlei_filter($shoujia);
			$chengbenlist = $xianlu['chengbenlist'];
			$this->assign("shoujia",$shoujia);
			$this->assign("chanpin",$xianlu);
			$this->assign("chengben",$chengbenlist);
			$this->display('ServerChanpin:chengbenshoujia');
		}
		if($dotype == '子团管理'){
			A("Method")->showDirectory("子团管理");
			$zituanAll = $xianlu['zituanlist'];
			$this->assign("zituanAll",$zituanAll);
			$this->display('ServerChanpin:zituan');
		}
		if($dotype == '子团产品'){
			A("Method")->showDirectory("子团产品");
			$this->assign("markpos",'基本信息');
			$zituanAll = $xianlu['zituanlist'];
			$this->assign("zituanAll",$zituanAll);
			$zituan['xianlulist']['xianlu'] = $xianlu;
			$zituan['xianlulist']['xianlu']['xianlu_ext'] = $xianlu['xianlu_ext'];
			$zituan['xianlulist']['shoujia'] = A("Method")->_fenlei_filter($xianlu['shoujialist']);
			$zituan['xianlulist']['xingcheng'] = $xianlu['xingchenglist'];
			$zituan['xianlulist']['chengben'] = $xianlu['chengbenlist'];
			$this->assign("zituan",$zituan);
			$this->assign("datatitle",' : "'.$zituan['title_copy'].'/团期'.$zituan['chutuanriqi'].'"');
			$title = $_REQUEST['typemark'].'--'.$zituan['title_copy'].'--'.$zituan['chutanriqi'];
			$xianlu['datatext'] = simple_unserialize($xianlu['datatext']);
			$xingcheng_1 = $xianlu['datatext']['xingcheng'];
			$this->assign("xingcheng_1",$xingcheng_1);
			$this->display('ServerChanpin:zituanxinxi');
		}
		
		
	}
	
	//检查产品
	public function _checkchanpin($chanpinID) {
		$Chanpin = D("Chanpin");
		$data = $Chanpin->where("`chanpinID` = '$chanpinID'")->find();
		if($data)
		return $data;
		else
		return false;
	}
	
	//检查产品
	public function _updatetocms($chanpinID) {
		C('TOKEN_ON',false);
		$ViewXianlu = D("ViewXianlu");
		$mid =  1;//会员ID
		$xianlu = $ViewXianlu->relation("zituanlist")->where("`chanpinID` = '$chanpinID'")->find();
		if($xianlu['kind'] == '自由人'){
			//线路文章自由行
			$this->_processArticle($xianlu,'DEDEAddonarticleXianlu',$mid,B_XIANLU_TYPEID,B_XIANLU_CHANNEL);
		}
		else{
			//线路文章参团游
			$this->_processArticle($xianlu,'DEDEAddonarticleXianlu',$mid,A_XIANLU_TYPEID,A_XIANLU_CHANNEL);
		}
		
	}
	
	
	//检查产品
	public function _updatetocms_qianzheng($chanpinID) {
		C('TOKEN_ON',false);
		$ViewQianzheng = D("ViewQianzheng");
		$mid =  1;//会员ID
		$qianzheng = $ViewQianzheng->where("`chanpinID` = '$chanpinID'")->find();
		//签证
		$this->_processArticle($qianzheng,'DEDEAddonarticleQianzheng',$mid,A_QIANZHENG_TYPEID,A_QIANZHENG_CHANNEL);
		
	}
	
	
	//文章流程
	public function _processArticle($chanpin,$addonarticleModel,$mid,$typeid,$channel,$zituan='') {
		$DEDEAddonarticle = D($addonarticleModel);//自定义模型文章附表
		$DEDEArchives = D("DEDEArchives");//文章主表
		$DEDEArctiny = D("DEDEArctiny");
		//添加文档微表，此表用于索引，id与文章表id相同
		$arctiny['mid'] =  $mid;//会员ID
		$arctiny['typeid'] =  $typeid;//主栏目ID
		$arctiny['channel'] =  $channel;//频道模型
		$arctiny = $DEDEArctiny->create($arctiny);
		$arctinyID = $DEDEArctiny->add();//自增型主键，可获得ID
		//添加文章主表
		$archives['title'] = $chanpin['title'];//标题
		$archives['shorttitle'] =  $chanpin['zhuti'];//简略标题
		$archives['writer'] =  $chanpin['user_name'];//作者
		$archives['source'] =  $company['bumen_copy'];//来源
		$archives['id'] =  $arctinyID;//文章ID
		$archives['mid'] =  $mid;//会员ID
		$archives['typeid'] = $typeid;//主栏目ID
		$archives['channel'] = $channel;//频道模型
		$archives = $DEDEArchives->create($archives);
		$DEDEArchives->add();
		//添加文章附加表
		$addonarticle['aid'] =  $arctinyID;//文章ID
		$addonarticle['body'] =  $chanpin;
		$addonarticle['typeid'] =  $archives['typeid'];
		$addonarticle['serverdataid'] =  $chanpin['chanpinID'];//服务器ID
		if($addonarticleModel == 'DEDEAddonarticleXianlu'){
			$addonarticle['jiage'] =  $chanpin['shoujia'];
			//日期处理
			$addonarticle['chufariqi'] =  str_replace(";",",",$chanpin['chutuanriqi']);;
			$addonarticle['chufachengshi'] =  $chanpin['chufadi'];
			$addonarticle['mudidi'] =  $chanpin['mudidi'];
			$addonarticle['tianshu'] =  $chanpin['tianshu'];
		}
		if($addonarticleModel == 'DEDEAddonarticleQianzheng'){
			$addonarticle['jiage'] =  $chanpin['shoujia'];
		}
		$addonarticle['chufachengshi'] =  '大连';//默认
		$addonarticle = $DEDEAddonarticle->create($addonarticle);
		$DEDEAddonarticle->add();
		return $arctinyID;
	}
	
	
	
	
	
	
	
	
	
	
	
}
?>