<?php
/**
 * @link http://www.simpleforum.org/
 * @copyright Copyright (c) 2015 Simple Forum
 * @author Jiandong Yu admin@simpleforum.org
 */

use yii\helpers\Html;
use yii\widgets\LinkPager;
use app\models\Ad;
$settings = Yii::$app->params['settings'];
$title ='广告管理';
$this->title = Html::encode($settings['site_name']) .' › '. $title;
$currentPage = $pages->page+1;
?>
<?php echo $this->render('@app/views/common/login'); ?>
<?php echo $this->render('@app/views/common/side'); ?>
</div>
<div id="Main">
<div class="sep20"></div>
<div class="box">
<div class="header"><?php echo Html::a('管理后台', ['admin/setting/']), '<span class="chevron">&nbsp;›&nbsp;</span>', $title;?></div>
<div class="box">
<div class="cell"><?php echo Html::a('添加新广告', ['add'],['class'=>'super normal button']); ?></div>
<?php if($pages->pagecount > 1) {?>
<div class="cell">
<table cellpadding="0" cellspacing="0" border="0" width="100%">
<tr><td width="80%" align="left">
<?php echo LinkPager::widget(['pagination' => $pages,'maxButtonCount'=>10,'prevPageLabel'=>false,'nextPageLabel'=>false]);?>
<?php if ($currentPage!==$pages->pagecount){;?>
<div class="pagination"><li><span class="fade"> ... </span></li><li><a href="?p=<?php echo $pages->pagecount;?>" class="page_normal"><?php echo $pages->pagecount;?></a></li></div><?php ;};?>
&nbsp;
<input type="number" class="page_input" autocomplete="off"  value="<?php echo $currentPage;?>" min="1" max="<?php echo $pages->pagecount;?>" onkeydown="if (event.keyCode == 13)location.href = '?p=' + this.value">
</td>
<td width="20%" align="right">
<div class="fr">
<?php echo LinkPager::widget(['pagination' => $pages,'maxButtonCount'=>0,'nextPageLabel'=>'<i class="iconfont icon-chevronright"></i>','prevPageLabel'=>'<i class="iconfont icon-chevronleft"></i>']);?></div>
</td>
</tr>
</table>
</div>
<?php ;};?>
<div>
<table cellpadding="5" cellspacing="0" border="0" width="100%" class="data">
<tbody>
<tr>
<th width="50" align="center" class="h">ID</th>
<th width="50" align="center" class="h">排序</th>
<th width="40" align="center" class="h">显示</th>
<th width="auto" align="center" class="h">广告名</th>
<th width="100" align="center" class="h">节点</th>
<th width="100" align="center" class="h">到期时间</th>
<th width="120" align="center" class="h" style="border-right: none;">操作</th>
</tr>

<?php
foreach($ads as $ad) {
echo '<tr><td width="50" align="center" class="d">', $ad['id'], '</td><td width="50" align="center" class="d">', $ad['sortid'], '</td><td width="40" align="center" class="d">'; if ($ad['invisible']==0){echo '<span class="negative">显</span>';}else{echo '<span class="positive">隐</span>';}echo '</td><td width="auto" align="left" class="d">', $ad['name'],'</td><td width="100" align="left" class="d">', Html::a(Html::encode($ad['node']['name']), ['topic/node', 'name'=>$ad['node']['ename']]),'</td><td width="100" align="center" class="d">', $ad['expires'], '</td><td width="120" height="20" align="center" class="d" style="border-right: none;">', 
Html::a('编辑', ['edit', 'id'=>$ad['id']],['class' => 'super normal button']), '&nbsp; &nbsp;', 
Html::a('删除', ['delete', 'id'=>$ad['id']] ,['class' => 'super normal button',
    'data' => [
        'confirm' => '注意：删除后将不会恢复！确认删除！',
        'method' => 'post',
]]), '</td></tr>';
}?>
</tbody></table>
<?php if($pages->pagecount > 1) {?>
<div class="cell">
<table cellpadding="0" cellspacing="0" border="0" width="100%">
<tr><td width="80%" align="left">
<?php echo LinkPager::widget(['pagination' => $pages,'maxButtonCount'=>10,'prevPageLabel'=>false,'nextPageLabel'=>false]);?>
<?php if ($currentPage!==$pages->pagecount){;?>
<div class="pagination"><li><span class="fade"> ... </span></li><li><a href="?p=<?php echo $pages->pagecount;?>" class="page_normal"><?php echo $pages->pagecount;?></a></li></div><?php ;};?>
&nbsp;
<input type="number" class="page_input" autocomplete="off"  value="<?php echo $currentPage;?>" min="1" max="<?php echo $pages->pagecount;?>" onkeydown="if (event.keyCode == 13)location.href = '?p=' + this.value">
</td>
<td width="20%" align="right">
<div class="fr">
<?php echo LinkPager::widget(['pagination' => $pages,'maxButtonCount'=>0,'nextPageLabel'=>'<i class="iconfont icon-chevronright"></i>','prevPageLabel'=>'<i class="iconfont icon-chevronleft"></i>']);?></div>
</td>
</tr>
</table>
</div>
<?php ;};?>
</div>
</div>
</div>
</div>