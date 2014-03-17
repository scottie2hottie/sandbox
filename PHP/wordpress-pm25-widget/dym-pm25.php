<?php
/*
Plugin Name: PM 2.5 Mainland China
Plugin URI: http://localhost
Description: Displays a pm 2.5 of the current visitor's city
Author: Yanming Deng
Version: 0.1
Author URI: http://localhost
*/


class Dym_Pm25 extends WP_Widget
{

  function __construct()
  {
    $widget_ops = array(
      'classname' => 'widget_pm25', 
      'description' => __("Displays a pm 2.5 of the current visitor's city") 
    );
         
    $this->WP_Widget('random-picture-widget', __('PM 2.5 of visitor\'s city'), $widget_ops);
  }

  function widget($args, $instance)
  {
    extract($args);
    echo $before_widget;
    if (!empty( $title )) { 
      echo $before_title . $title . $after_title; 
    };

    $visitor_ip = $_SERVER['REMOTE_ADDR'];
    $visitor_city = $this->getCity($visitor_ip);
    // var_dump($visitor_city);
    $pm_result = $this->getPM25($visitor_city);

    wp_enqueue_style("style", plugins_url("css/style.css", __FILE__));

    require("html/html.php");
    echo $after_widget;
    //  Done
  }

  function getCity($ip)
  {
    // $url="http://int.dpool.sina.com.cn/iplookup/iplookup.php?format=json&ip=".$ip;
    $url = "http://ip.taobao.com/service/getIpInfo.php?ip=".$ip;
    $ip=json_decode(file_get_contents($url));
    if ($ip->code == 0) {
      $city = mb_substr($ip->data->city, 0, -1, 'utf-8');
      return $city;
    } else {
      return false;
    }
      
  }

  function getPM25($city)
  {
    if ($city == false) {
      return false;
    }
    $url = "http://www.pm25.in/api/querys/pm2_5.json?city={$city}&token=".base64_decode("eTRLZVZxQXRKUVpGWHNkUnF3ajk=");
    // $url = plugins_url("pm2_5.json", __FILE__);
    $result = json_decode(file_get_contents($url));
    if (!empty($result->error)) {
      return false;
    }
    return $result;
  }

  function form(){}

  function update(){}
}

function myplugin_register_widgets()
{
  register_widget('Dym_Pm25');
}
  
add_action("widgets_init", "myplugin_register_widgets");

add_action("wp_enqueue_scripts", function() {
  wp_enqueue_script("custom", plugins_url("js/custom.js", __FILE__), array("jquery"), true);
});

?>