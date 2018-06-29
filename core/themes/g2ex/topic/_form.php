<?php
/**
 * @link http://www.simpleforum.org/
 * @copyright Copyright (c) 2017 Simple Forum
 * @author Jiandong Yu admin@simpleforum.org
 */
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use app\models\Topic;
$settings = Yii::$app->params['settings'];
$this->registerAssetBundle('app\assets\Select2Asset');
$this->registerJs('$(".access_auth").select2({});');
\app\themes\g2ex\layouts\autosizeAsset::register($this);
if($model->isNewRecord){
$editorClass = '\app\plugins\\'. $model['node']['editor']. '\\'. $model['node']['editor'];
$editor = new $editorClass();
}else{
$editorClass = '\app\plugins\\'. $model['editor']. '\\'. $model['editor'];
$editor = new $editorClass();
}
$editor->registerAsset($this);
$editor->registerTagItAsset($this);
\app\themes\g2ex\layouts\emojiAsset::register($this);
?>
<?php $form = ActiveForm::begin(); ?>
<?php
if( $action === 'edit' && Yii::$app->getUser()->getIdentity()->isAdmin()) {
echo '<div class="cell msl" style="border-bottom:1px solid #e2e2e2;">','<div class="ckbox">', $form->field($model, 'invisible')->checkbox(), '</div>','<div class="ckbox">', $form->field($model, 'comment_closed')->checkbox(), '</div>','<div class="ckbox">', $form->field($model, 'star')->checkbox(), '</div>','<div class="ckbox">', $form->field($model, 'alltop')->checkbox(), '</div>','<div class="ckbox">', $form->field($model, 'top')->checkbox(), '</div>','</div>';}?>
<?php 
if($model->isNewRecord){
echo $form->field($model, 'editor')->hiddenInput(['value'=>$model['node']['editor']])->label(false);
}else{
echo $form->field($model, 'editor')->hiddenInput(['value'=>$model['editor']])->label(false);
} ?>
<div class="cell"><div class="fr fade" id="title_remaining">120</div>主题标题</div>
<div class="cell" style="padding: 0px; background-color: #fff;">
<?=$form->field($model, 'title')->textArea(['rows' => '1','placeholder'=>'请输入主题标题，如果标题能够表达完整内容，则正文可以为空','class'=>'msl', 'id'=>'topic_title','maxlength'=>120])->label(false); ?>
</div>
<div class="cell"><div class="fr fade" id="content_remaining">20000</div>正文 <span class="emotion">&nbsp;</span></div>
<div class="mc"><?=$form->field($content, 'content')->textArea(['id'=>'editor','class'=>'msl','autofocus'=>'autofocus', 'maxlength'=>30000])->label(false); ?></div>
<div class="cell"><?=$form->field($model, 'access_auth')->dropDownList(Topic::$access, ['class'=>'access_auth','style'=>'width: 300px; font-size: 14px; display: none;'])->label(false); ?></div>
<div class="cell"><div class="fr fade">最多4个标签，以空格分隔</div>标签</div>
<?=$form->field($model, 'tags')->textInput(['id'=>'tags', 'maxlength'=>60])->label(false); ?>
<div class="cell" style="overflow: hidden;"><?=Html::submitButton($model->isNewRecord ? '发布主题' : '编辑主题', ['class' => 'super normal button']); ?>
<?php if( Yii::$app->getUser()->getIdentity()->canUpload($settings) ) {$editor->registerUploadAsset($this);echo '<div id="fileuploader">图片上传</div>';}?>
</div>
<?php ActiveForm::end(); ?>
<script>
autosize(document.querySelectorAll('textarea'));
</script>