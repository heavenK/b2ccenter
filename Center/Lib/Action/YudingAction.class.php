<?php

class YudingAction extends Action{
	
    public function adddingdan() {
		$chanpinID = $_REQUEST['chanpinID'];
		$ViewZituan = D("ViewZituan");
		$zituan = $ViewZituan->relation("xianlulist")->where("`chanpinID` = '$chanpinID'")->find();
		if(!$zituan){
			echo "产品不存在！";
			exit;
		}
		$xianlu = unserialize($zituan['xianlulist']['datatext']);
		$this->assign("zituan",$zituan);
		$this->assign("xianlu",$xianlu);
		$this->display();
    }
	
    public function dopostdingdan() {
		if(false === A("ServerMethod")->_checkchanpin($_REQUEST['parentID'])){
			echo $Chanpin->getError();
			exit;
		}
		$data = $_REQUEST;
		$data['dingdan'] = $_REQUEST;
		$UserData = D("UserData");
		if(false !== $UserData->relation("dingdan")->myRcreate($data)){
			if($UserData->getLastmodel() != 'add'){
				$usredataID = $UserData->getRelationID();
			}
			$this->assign("data",$data);
			$this->display('querendingdan');
		}
		else
		{
			echo $UserData->getError();
		}
	}
	
	
	
	
	
}
?>