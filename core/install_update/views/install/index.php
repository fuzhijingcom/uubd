<?php
/**
 * @link http://www.simpleforum.org/
 * @copyright Copyright (c) 2015 Simple Forum
 * @author Jiandong Yu admin@simpleforum.org
 */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

extract($check->result);

$settings = Yii::$app->params['settings'];
$this->title = Html::encode($settings['site_name']) .' › 环境检测';
?>
</div>
<div id="Main" style="margin: 0px 20px 0px 20px;">
<div class="sep20"></div>
<div class="box">
<div class="header"><?php echo Html::a(Html::encode($settings['site_name']) , ['/']), '<span class="chevron">&nbsp;›&nbsp;</span>环境检测';?></div>
<table cellpadding="5" cellspacing="0" border="0" width="100%" class="data">
<tbody>
<tr>
<th colspan="3"  class="h" style="border-right: none;">服务器环境</th>
</tr>
<tr>
<td colspan="3"  class="d" style="border-right: none;"><?php echo $check->getServerInfo() . ' ' . $check->getNowDate() ?></td>
</tr>
<tr>
<th colspan="3" class="h" style="border-right: none;">检测结果</th>
</tr>
</tbody>
</table>
<?php if ($summary['errors'] > 0): ?>
<div class="problem">
<strong>您的网站空间不符合要求，具体查看下面的列表</strong>
</div>
<?php elseif ($summary['warnings'] > 0): ?>
<div class="message">
<?php if ($summary['errors'] == 0) {Yii::$app->getSession()->set('install-step', 1);echo Html::a('下一步：数据库设置', ['db-setting'], ['class'=>'fr super normal button']);}?><div class="sep5"></div>
<strong>您的网站空间符合最基本的要求，请确认下面列表中的警告项目</strong>
</div>
<?php else: ?>
<div class="message">
<?php if ($summary['errors'] == 0) {Yii::$app->getSession()->set('install-step', 1);echo Html::a('下一步：数据库设置', ['db-setting'], ['class'=>'fr super normal button']);}?><div class="sep5"></div><strong>恭喜，您的网站空间符合要求。</strong>
</div>
<?php endif; ?>
<table cellpadding="5" cellspacing="0" border="0" width="100%" class="data">
<tbody>
<tr>
<th class="h">条件</th>
<th class="h">结果</th>
<th class="h" style="border-right: none;">备注</th>
</tr>
<?php foreach ($requirements as $requirement): ?>
<tr class="<?php echo $requirement['condition'] ? 'green' : ($requirement['mandatory'] ? 'negative' : 'blue') ?>">
<td class="d">
<?php echo $requirement['name'] ?>
</td>
<td class="d">
<span class="result"><?php echo $requirement['condition'] ? '通过' : ($requirement['mandatory'] ? '失败' : '警告') ?></span>
</td>
<td class="d" style="border-right: none;">
<?php echo $requirement['memo'] ?>
</td>
</tr>
<?php endforeach; ?>
</tbody>
</table>
</div>
</div>