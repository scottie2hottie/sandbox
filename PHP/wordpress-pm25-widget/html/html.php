<?php 
  $air_quality_levels = array(
    "优" => "一级",
    "良" => "二级",
    "轻度污染" => "三级",
    "中度污染" => "四级",
    "重度污染" => "五级",
    "严重污染" => "六级"
  );

  $impact_on_health = array(
    "优" => "空气质量令人满意,基本无空气污染",
    "良" => "空气质量可接受,但某些污染物可能对极少数异常敏感人群健康有较弱影响",
    "轻度污染" => "易感人群症状有轻度加剧,健康人群出现刺激症状",
    "中度污染" => "进一步加剧易感人群症状,可能对健康人群心脏、呼吸系统有影响",
    "重度污染" => "心脏病和肺病患者症状显著加剧,运动耐受力降低,健康人群普遍出现症状",
    "严重污染" => "健康人群运动耐受力降低,有明显 强烈症状,提前出现某些疾病"
  );

  $advised_action = array(
    "优" => "各类人群可正常活动",
    "良" => "极少数异常敏感人群应减少户外活动",
    "轻度污染" => "儿童、老年人及心脏病、呼吸系统疾病患者应减少长时间、高强度的户外锻炼",
    "中度污染" => "儿童、老年人及心脏病、呼吸系统疾病患者避免长时间、高强度的户外锻炼,一般人群适量减少户外运动",
    "重度污染" => "儿童、老年人和心脏病、肺病患者应停留在室内,停止户外运动,一般人群减少户外运动",
    "严重污染" => "儿童、老年人和病人应当留在室内,避免体力消耗,一般人群应避免户外活动"
  );
?>

<?php if (empty($pm_result)): ?> 
  <?php echo "数据获取出错了，请稍后再试！" ?>
<?php else: ?>
  <div id="dym">
    <div id="main">
      <div id="top">
        <p id="cityName"><?php echo $visitor_city; ?></p>
        <p id="date"><?php echo date("Y年m月d日") ?></p>
      </div>
      <div id="middle">
        <p id="aqiName">AQI空气质量指数</p>
        <p id="aqi" class="yellow"><?php echo $pm_result[count($pm_result)-1]->aqi; ?></p>
        <p id="level"><?php $air_quality = $pm_result[count($pm_result)-1]->quality; echo $air_quality_levels[$air_quality]; ?>：<?php echo $air_quality; ?></p>
        <p id="message" class="msg"><?php echo $impact_on_health[$air_quality]; ?></p>
        <p id="suggest" class="msg">建议：<?php echo $advised_action[$air_quality]; ?></p>
      </div>
      <div id="bottom">
        <p id="pm25_title">PM2.5</p>
        <table>
          <tr id="pm25_data" valign="middle">
            <td width="50%" id="pm2_5" class="yellow"><?php echo $pm_result[count($pm_result)-1]->{'pm2_5'}; ?></td>
            <td width="50%" id="pm2_5_24h" class="green"><?php echo $pm_result[count($pm_result)-1]->{'pm2_5_24h'}; ?></td>
          </tr>
          <tr style="font-size: 14px;background-color: #23a2c3;height:28px;line-height:28px" valign="middle">
            <td id="time">
              <?php 
                $datetime = $pm_result[count($pm_result)-1]->{'time_point'}; 
                $time = strtotime($datetime);
                echo date("H:i", $time);
              ?>
            </td>
            <td>24h</td>
          </tr>
        </table>
      </div>
      <div id="checkPoint"><?php echo $visitor_city; ?>有<?php echo count($pm_result)-1; ?>个监测站点</div>
      <table id="checkPointTab" class="hide" style="font-size: 12px;">
        <tr>
          <td></td>
          <td>AQI</td>
          <td>PM2.5_1h</td>
          <td>PM2.5_1d</td>
        </tr>
        <?php for ($i=0; $i < count($pm_result)-1; $i++) : ?>
          <tr>
            <td><?php echo $pm_result[$i]->position_name; ?></td>
            <td><?php echo $pm_result[$i]->aqi; ?></td>
            <td><?php echo $pm_result[$i]->pm2_5; ?></td>
            <td><?php echo $pm_result[$i]->pm2_5_24h; ?></td>
          </tr>
        <?php endfor; ?>
          
      </table>
    </div>
  </div>
<?php endif; ?>