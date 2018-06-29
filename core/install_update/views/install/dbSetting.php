<?php
/**
 * @link http://www.simpleforum.org/
 * @copyright Copyright (c) 2015 Simple Forum
 * @author Jiandong Yu admin@simpleforum.org
 */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Alert;
$settings = Yii::$app->params['settings'];
$this->title = Html::encode($settings['site_name']) .' › Mysql数据库设置';
?>
</div>
<div id="Main" style="margin: 0px 20px 0px 20px;">
<div class="sep20"></div>
<div class="box">
<div class="header"><?php echo Html::a(Html::encode($settings['site_name']) , ['/']), '<span class="chevron">&nbsp;›&nbsp;</span>Mysql数据库设置';?></div>
<?php if ( !empty($error) ) {?>
<div class="problem" onclick="$(this).slideUp('fast');"><?php echo $error;?></div>
<?php }?>
<div class="cell form">
<?php $form = ActiveForm::begin([
'layout' => 'horizontal',
'id' => 'form-dbinfo'
]); ?>
<?php echo $form->field($model, 'host')->hint('windows下使用127.0.0.1'); ?>
<?php echo $form->field($model, 'dbname')->hint('手动创建好的数据库名'); ?>
<?php echo $form->field($model, 'username'); ?>
<?php echo $form->field($model, 'password'); ?>
<?php echo $form->field($model, 'tablePrefix'); ?>
<div class="form-group">
	<label class="control-label"> &nbsp;&nbsp;</label>
    <?php echo Html::submitButton('确定', ['class' => 'super normal button', 'name' => 'dbsetting-button']); ?>
</div>
<?php ActiveForm::end(); ?>
</div>
</div>
</div>