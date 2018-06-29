<?php
/**
 * @link http://www.simpleforum.org/
 * @copyright Copyright (c) 2017 Simple Forum
 * @author Jiandong Yu admin@simpleforum.org
 */
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Alert;
use app\models\UploadForm;
$settings = Yii::$app->params['settings'];
$this->title = Html::encode($settings['site_name']);
$title = '头像上传';
$this->title = Html::encode($settings['site_name']) .' › '. $title;
$session = Yii::$app->getSession();
$me = Yii::$app->getUser()->getIdentity();
$isGuest = Yii::$app->getUser()->getIsGuest();
if( !$isGuest ) {
    $me = Yii::$app->getUser()->getIdentity();
    $myInfo = $me->userInfo;
}
?>
<?=$this->render('@app/views/common/login'); ?>
</div>
<div id="Main">
<div class="sep20"></div>
<div class="box">
<div class="header"><?=Html::a(Html::encode($settings['site_name']), ['/']); ?> <span class="chevron">&nbsp;›&nbsp;</span> <?=Html::a('设置', ['my/settings']); ?> <span class="chevron">&nbsp;›&nbsp;</span> 头像上传</div>
<?php if ($me->isWatingActivation()) : ?>
<?php if ( $session->hasFlash('activateMailNG') ) {echo  '<div class="problem">'.$session->getFlash('activateMailNG').'</div>';
} else if ( $session->hasFlash('activateMailOK') ) {echo '<div class="message">'.$session->getFlash('activateMailOK').'</div>';}?>
<div class="problem">
您还没有激活，请进入注册时填写的邮箱(<?=$me->email; ?>)，点击激活链接。<br /><br />
<?=Html::a('重发激活邮件', ['service/send-activate-mail']); ?>  <?=Html::a('修改邮箱', ['service/email']); ?>
</div>	
<?php endif; ?>
<?php if ( $session->hasFlash('setAvatarNG') ) {?>
<div class="problem" onclick="$(this).slideUp('fast');"><?=$session->getFlash('setAvatarNG');?></div>
<?php } else if ( $session->hasFlash('setAvatarOK') ) {?>
<div class="message" onclick="$(this).slideUp('fast');"><?=$session->getFlash('setAvatarOK');?></div>
<?php }?>
<div class="cell" id="form">
<?php $form = ActiveForm::begin(['action' => ['service/avatar'],'options' => ['enctype' => 'multipart/form-data'],]); ?>
<table cellpadding="0" cellspacing="0" border="0" width="100%">
<tbody><tr>
    <td width="120" align="right">当前头像&nbsp;</td>
    <td width="auto" align="left">&nbsp;&nbsp;&nbsp;<?=Html::img('@web/'.str_replace('{size}', 'large', $me->avatar)), ' &nbsp; ', Html::img('@web/'.str_replace('{size}', 'normal', $me->avatar)), ' &nbsp; ', Html::img('@web/'.str_replace('{size}', 'small', $me->avatar)); ?></td>
</tr>
<tr>
<td width="auto" align="left" colspan="2"><?=$form->field((new UploadForm(Yii::$container->get('avatarUploader'))), 'file')->fileInput(); ?></td>
</tr>
<tr>
<td width="120" align="right"></td>
<td width="auto" align="left"><span class="gray" style="margin-left:10px;">支持 2MB 以内的 PNG / JPG / GIF 文件</span></td>
</tr>
<tr>
<td width="auto" align="left" colspan="2"><div class="sep10"></div><?=Html::submitButton('开始上传', ['class' => 'super normal button']); ?></td>
</tr>
</tbody></table>
<?php ActiveForm::end(); ?>
</div>
</div>
</div>
