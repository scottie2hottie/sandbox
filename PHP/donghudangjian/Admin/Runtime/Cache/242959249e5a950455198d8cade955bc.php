<?php if (!defined('THINK_PATH')) exit();?><tr><td class='b1_1'>跳转地址</td><td class='b1_1'><input type='text' group='basic' name='redirecturl' id='redirecturl' size='50'  style='' value='<?php echo $addonlist['redirecturl'];?>' /></td></tr><tr><td class='b1_1'>正文内容</td><td class='b1_1'><script charset='utf-8' src='/Public/Editor/kindeditor/editor.php?theme=default&fm=true&id=Content'></script><textarea name='body' id='Content' group='basic' cols='60' rows='60' style='width:800px;height:300px;' ><?php echo $addonlist['body'];?></textarea></td></tr>