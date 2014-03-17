<?php
// 本类由系统自动生成，仅供测试用途
class IndexAction extends Action {
    public function index(){
        header("Content-type:text/html;charset=utf-8");
        $cr = M("t_gtj_cr");
        $rs = $cr->field('title, add_time, content')->order('id desc')->select();
        // $rs = $cr->select();
        // echo $cr->getLastSql();exit;
        // dump($rs);exit;
        $churang = M("t_gtj_churang");
        foreach ($rs as $key => $value) {
            // dump($key);
            unset($data);
            $data['id'] = $key + 534;
            $data['title'] = $value['title'];
            $data['content'] = $value['content'];
            $data['add_time'] = substr($value['add_time'], 0, 10);
            // dump($data);
            $row_id = $churang->add($data);
            if ($row_id) {
                echo $row_id . "success" . "<br />";
            } else {
                echo $row_id . "fail" . "<br />";
            }
        }
        // echo 'string';
    }
}