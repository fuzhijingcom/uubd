<?php
/**
 * @link http://simpleforum.org/
 * @copyright Copyright (c) 2017 Simple Forum
 * @author Jiandong Yu admin@simpleforum.org
 */
use yii\helpers\Html;
use yii\widgets\LinkPager;
$settings = Yii::$app->params['settings'];
$title ='插件管理';
$this->title = Html::encode($settings['site_name']) .' › '. $title;
?>
<?=$this->render('@app/views/common/login'); ?>
<?=$this->render('@app/views/common/side'); ?>
</div>
<div id="Main">
<div class="sep20"></div>
<div class="box">
<div class="header"><?=Html::a('管理后台', ['admin/setting/']), '<span class="chevron">&nbsp;›&nbsp;</span>', Html::a('插件管理', ['index']);?></div>
<div class="box">
<div class="cell"><?=Html::a('已安装插件', ['index'],['class'=>'super normal button']); ?></div>
<table cellpadding="5" cellspacing="0" border="0" width="100%" class="data">
<tbody>
<tr>
<th width="20" align="center" class="h">插件ID</th>
<th width="40" align="center" class="h">插件名</th>
<th width="40" align="center" class="h">版本</th>
<th width="50" align="center" class="h" style="border-right: none;">操作</th>
</tr>
<?php
if( !empty($plugins) ) {
    foreach($plugins as $plugin) {
        echo '<tr><td align="center" class="d">', $plugin['pid'], '</td>
      <td align="center" class="d">', Html::a(Html::encode($plugin['name']), ['view', 'pid'=>$plugin['pid']]), '</td>
      <td align="center" class="d">', Html::encode($plugin['version']) ,'</td>
      <td align="center" height="20" class="d" style="border-right: none;">', Html::a('安装', ['install', 'pid'=>$plugin['pid']],['class' => 'super normal button']), '</td>
    </tr>';
    }
}
?>
</tbody></table>
</div>
</div>
</div>