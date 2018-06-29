<?php
/**
 * @link http://www.simpleforum.org/
 * @copyright Copyright (c) 2017 Simple Forum
 * @author Jiandong Yu admin@simpleforum.org
 */
use yii\helpers\Html;
use app\components\SfHtml;
$settings = Yii::$app->params['settings'];
if(!Yii::$app->getUser()->getIsGuest()):
    $me = Yii::$app->getUser()->getIdentity();
    $myInfo = $me->userInfo;
?>
<div class="sep20"></div>
<div class="box">
<div class="cell">
    <table cellpadding="0" cellspacing="0" border="0" width="100%">
        <tr>
            <td width="48" valign="top"><?=SfHtml::uImglink($me); ?></td>
            <td width="10" valign="top"></td>
            <td width="auto" align="left"><span class="fr fade"><?php if ($me->isWatingActivation()) {
                echo ' <small class="red">', Html::a('未激活', ['my/settings'],['style'=>'color:red']), '</small>';
            } else if ($me->isWatingVerification()) {
                echo ' <small class="red">未验证</small>';}else {?>
            <img src="/<?=SfHtml::uGroupRank($me->score);?>" align="absmiddle" style="max-width: 30px;max-height: 14px; margin-bottom: 4px" title="<?=SfHtml::uGroup($me->score);?>"> <?=SfHtml::uGroup($me->score);?><?php } ?></span><span class="bigger"><?=SfHtml::uLink($me->username);?></span>
            </td>
        </tr>
    </table>
    <div class="sep10"></div>
 <table cellpadding="0" cellspacing="0" border="0" width="100%">
        <tr>
            <td width="33%" align="center"><?=Html::a('<span class="bigger">'.$myInfo->favorite_node_count.'</span><div class="sep3"></div><span class="fade">节点收藏</span>', ['my/nodes'],['class'=>'dark','style'=>'display: block;']);?></td>
            <td width="34%" style="border-left: 1px solid rgba(100, 100, 100, 0.4); border-right: 1px solid rgba(100, 100, 100, 0.4);" align="center"><?=Html::a('<span class="bigger">'.$myInfo->favorite_topic_count.'</span><div class="sep3"></div><span class="fade">主题收藏</span>', ['my/topics'],['class'=>'dark','style'=>'display: block;']);?></td>
            <td width="33%" align="center"><?=Html::a('<span class="bigger">'.$myInfo->favorite_user_count.'</span><div class="sep3"></div><span class="fade">特别关注</span>', ['my/following'],['class'=>'dark','style'=>'display: block;']);?></td>
        </tr>
    </table>
</div>
<div class="cell" title="现有<?=$me->score;?>铜币 / 升级需要<?=SfHtml::uGroupNext($me->score);?>铜币">
<div style="width: 100%; background-color: #f0f0f0; height: 3px; display: inline-block; vertical-align: middle;"><div style="width: <?=($me->score / SfHtml::uGroupNext($me->score) *100);?>%;max-width: 100%; background-color: #a9de62; height: 3px; display: inline-block;"></div></div>
</div>
<div class="cell" style="padding: 10px;">
    <table cellpadding="0" cellspacing="0" border="0" width="100%">
        <tr>
            <td width="auto" valign="middle" align="left"><input type="button" class="super normal button" value="创建新主题" onclick="location.href = '/new'"></td>
             <td width="10"></td>
            <td width="auto" valign="middle" align="right"><input type="button" class="super normal button" value="发送新私信" onclick="location.href = '/send'"></td>
        </tr>
    </table>
</div>
<div class="cell"><div class="fr"><?php if ($me->getSmsCount()>0) { echo Html::a('<img src="/static/images/dot_orange.png" align="absmiddle"> <strong class="red">'.$me->getSmsCount().' 条未读私信</strong>', ['my/sms']);}else{echo Html::a($me->getSmsCount().' 条未读私信', ['my/sms']);}; ?></div><?php if ($me->getSystemNoticeCount()>0) { echo Html::a('<img src="/static/images/dot_orange.png" align="absmiddle"> <strong class="red">'.$me->getSystemNoticeCount().' 条未读提醒</strong>', ['my/notifications']);}else{echo Html::a($me->getSystemNoticeCount().' 条未读提醒', ['my/notifications']);}; ?></div>
<div class="inner"><div class="fr" id="money"><?=Html::a(SfHtml::uScore($me->score), ['my/balance'], ['class'=>'balance_area']); ?></div><?php if ( intval(Yii::$app->params['settings']['close_register']) === 2 ) {;?><a href="/my/invite-codes" class="dark" title="我的邀请码"><i class="iconfont f20">&#xe619;</i> 邀请码</a><?php };?>&nbsp;</div>
<?php if ( $me->reg==0 ) {?>
<div class="dock_area">
<div class="inner"><span class="chevron">&nbsp;›&nbsp;</span> <a href="/balance">在你开始发帖之前，请先领取初始资本</a></div>
</div>
<?php }?>
</div>
<?php if( $me->checkTodaySigned() === false ) :?>
<div class="sep20"></div>
<div class="box"><div class="inner"><i class="iconfont icon-gift" style="color: #f90;"></i> &nbsp;<a href="/mission/daily">领取今日的登录奖励</a></div></div>
<?php endif; ?>
<?php else: ?>
<div class="sep20"></div>
<div class="box">
    <div class="cell">
        <strong><?=$settings['site_name']?> = go to explore</strong>
        <div class="sep5"></div>
        <span class="fade"><?=$settings['slogan']?></span>
    </div>
    <div class="inner">
        <div class="sep5"></div>
        <div align="center"><?=Html::a('现在注册', ['site/signup'], ['class'=>'super normal button']); ?>
        <div class="sep5"></div>
        <div class="sep10"></div>
        已注册用户请 &nbsp;<?=Html::a('登录', ['site/signin']); ?>
<?php
$auths = [];
foreach (Yii::$app->authClientCollection->getClients() as $client){
    if ($settings['auth_setting'][$client->getId()]['show'] != 1) {
        continue;
    }
    if ($client->getId() == 'weixinmp' && $client->type == 'mp') {
        $auths[] = Html::a('<span class="iconfont icon-'.$client->getId().'"></span>', 'javascript:void(0);', ['id'=>'weixinmp', 'link'=>Url::to(['site/auth', 'authclient'=>$client->getId()], true)]);
    } else {
        $auths[] = '&nbsp;'.Html::a('<span class="iconfont icon-'.$client->getId().'"></span>', ['site/auth', 'authclient'=>$client->getId()], ['title'=>$client->getTitle(),'class'=>'icon']);
    }
}
        echo ' '.implode(' ', $auths);
?>
        </div>
    </div>
</div>
<?php endif; ?>