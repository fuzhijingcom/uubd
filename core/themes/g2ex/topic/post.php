<?php
/**
 * @link http://www.simpleforum.org/
 * @copyright Copyright (c) 2017 Simple Forum
 * @author Jiandong Yu admin@simpleforum.org
 */
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Node;
use app\models\Topic;
$settings = Yii::$app->params['settings'];
$this->registerAssetBundle('app\assets\Select2Asset');
$this->registerJs('$(".nodes-select2").select2({placeholder:"请选择一个节点",allowClear: true});');
$this->registerJs('$(".access_auth").select2({});');
\app\themes\g2ex\layouts\autosizeAsset::register($this);
$editorClass = '\app\plugins\WysibbEditor\WysibbEditor';
$editor = new $editorClass();
$editor->registerAsset($this);
$editor->registerTagItAsset($this);
\app\themes\g2ex\layouts\emojiAsset::register($this);
$title = '创作新主题';
$this->title =Html::encode($settings['site_name']).' › '.$title;
?>
<?=$this->render('@app/views/common/login'); ?>
<?=$this->render('@app/views/common/tips'); ?>
</div>
<div id="Main">
<div class="sep20"></div>
<div class="box" id="new">
<div class="cell">
<div class="fr">
<a href="/new" class="super normal button">Markdown编辑器</a>&nbsp;&nbsp;<a href="/post" class="super normal button">UBB编辑器</a>
</div>
<?=Html::a(Html::encode($settings['site_name']), ['/']); ?> <span class="chevron">&nbsp;›&nbsp;</span> <?=$title; ?></div>
<?php $form = ActiveForm::begin(); ?>
<?=$form->field($model, 'editor')->hiddenInput(['value'=>'WysibbEditor'])->label(false);?>
<div class="cell"><div class="fr fade" id="title_remaining">120</div>主题标题</div>
<div class="cell" style="padding: 0px; background-color: #fff;">
<?=$form->field($model, 'title')->textArea(['rows' => '1','placeholder'=>'请输入主题标题，如果标题能够表达完整内容，则正文可以为空','class'=>'msl', 'id'=>'topic_title','maxlength'=>120])->label(false); ?>
</div>
<div class="cell"><div class="fr fade" id="content_remaining">20000</div>正文 <span class="emotion">&nbsp;</span></div>
<div class="mc"><?=$form->field($content, 'content')->textArea(['id'=>'editor','class'=>'msl', 'maxlength'=>30000])->label(false); ?></div>
<div class="cell"> <?=$form->field($model, 'node_id')->dropDownList(array(''=>'')+Node::getNodeList(), ['class'=>'nodes-select2','style'=>'width: 300px; font-size: 14px; display: none;'])->label(false); ?></div>
<div class="cell">最热节点 <?php $hotNodes = Node::getHotNodes();foreach($hotNodes as $hn) {echo Html::a(Html::encode($hn['name']), 'javascript:chooseNode("'.$hn['id'].'");', ['class'=>'node']).' ';}?></div>
<div class="cell"><?=$form->field($model, 'access_auth')->dropDownList(Topic::$access, ['class'=>'access_auth','style'=>'width: 300px; font-size: 14px; display: none;'])->label(false); ?></div>
<div class="cell"><div class="fr fade">最多4个标签，以空格分隔</div>标签</div>
<?=$form->field($model, 'tags')->textInput(['id'=>'tags', 'maxlength'=>60])->label(false); ?>
<div class="cell" style="overflow: hidden;"><?=Html::submitButton('发布主题', ['class' => 'super normal button']); ?>
<?php if( Yii::$app->getUser()->getIdentity()->canUpload($settings) ) {$editor->registerUploadAsset($this);echo '<div id="fileuploader">图片上传</div>';}?>
</div>
<?php ActiveForm::end(); ?>
</div>
</div>
<script>
autosize(document.querySelectorAll('textarea'));
</script>
