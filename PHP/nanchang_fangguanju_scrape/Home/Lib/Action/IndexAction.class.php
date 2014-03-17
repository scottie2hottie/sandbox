<?php
// 本类由系统自动生成，仅供测试用途
class IndexAction extends Action {

    public function index_()
    {
    	include 'phpQuery-onefile.php';
    	header("Content-type: text/html; charset=utf-8");
    	$path = 'http://nc.jxgtt.gov.cn/Column.shtml?p5=2962&slandno=all&slandno=all&saddress=all&saddress=all&sman=all&sman=all&p7=';
    	for ($i=1; $i <= 4; $i++) { 
    		$path_arr[] = $path . $i;
    	}
    	// dump($path_arr);exit;
    	foreach ($path_arr as $key => $value) {
	    	// $rs = $this->curl_file_get_contents($path);
	    	// echo $rs;exit;
	    	phpQuery::newDocumentFile($value);  
			$links = pq('.contlistmd table')->find('tr');
			// dump($links);exit;
			$link_arr = array();
			foreach($links as $link) {  
				// dump($link);
			   // echo pq($link)->find('a')->attr('href')."<br>";  
			   $link_arr[] = pq($link)->find('a')->attr('href');
			}
			// dump($link_arr);exit;
			for ($i=3; $i <= 17; $i++) { 
				$link_arr_revised[] = 'http://nc.jxgtt.gov.cn/' . $link_arr[$i];
			}
		}
		// dump($link_arr_revised);exit;
		$LinksModel = M('Links');
		// $data['']
		foreach ($link_arr_revised as $kk => $vv) {
			unset($data);
			// dump($vv);exit;
			$data['link'] = $vv;
			$rs = $LinksModel->add($data);
			// echo $LinksModel->getLastSql();exit;
			if($rs) {
				echo "success" . "<br />";
			} else {
				echo "fail" . "<br />";
			}
		}
    }

    public function xiangxi_neirong()
    {
    	header("Content-type: text/html; charset=utf-8");
    	$reg = '/<td\s+bgcolor=\"\#FFFFFF\">([^<]*)/i';
    	$LinksModel = M('Links');
    	$links_arr = $LinksModel->field('link')->select();
    	// dump($links_arr);exit;
    	$sub_page_arr = array();
    	foreach ($links_arr as $key => $value) {
    		$sub_page = $this->curl_file_get_contents($value['link']);
    		// echo $sub_page;exit;
    		preg_match_all($reg, $sub_page, $matches);
    		// dump($matches);exit;
			unset($matches_filtered);
    		foreach ($matches[1] as $k => $v) {
	    		$matches_filtered[] = str_replace('&nbsp;', '', $v);
    		}
    		// dump($matches_filtered);
    		$sub_page_arr[] = $matches_filtered;
    		// dump($a);exit;
    		// dump($matches[1]);exit;
    	}
    	// dump($sub_page_arr);exit;
    	$ContentModel = M('Content');
    	foreach ($sub_page_arr as $kk => $vv) {
    		unset($data);
    		$data['land_id'] = $vv[0];
    		$data['location'] = $vv[1];
    		$data['jiaoyi_method'] = $vv[2];
    		$data['jiaoyi_time'] = $vv[3];
    		$data['land_yongtu'] = $vv[4];
    		$data['land_area'] = $vv[5];
    		$data['guihua_zhibiao'] = $vv[6];
    		$data['begin_price'] = $vv[7];
    		$data['deal_unit_price'] = $vv[8];
    		$data['deal_total_price'] = $vv[9];
    		$data['bid_owner'] = $vv[10];
    		$data['remarks'] = $vv[11];
    		if($ContentModel->add($data)) {
    			echo $kk . "success" . "<br />";
    		} else {
    			echo $kk . "fail" . "<br />";
    		}
    	}

    }

    private function curl_file_get_contents($url)
    {
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_TIMEOUT, 15);
		curl_setopt($ch, CURLOPT_USERAGENT, _USERAGENT_);
		curl_setopt($ch, CURLOPT_REFERER,_REFERER_);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$r = curl_exec($ch);
		curl_close($ch);
		return $r;
	}
}