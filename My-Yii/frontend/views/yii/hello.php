<?php 
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>

<?php 
    if(Yii::$app->session->hasFlash('success',null)){
    // echo Yii::$app->session->getFlash('success',null);
} ?>
<!-- to start the form -->
<?php $form = ActiveForm::begin();?>

<!-- text fields -->
<?= $form->field($model,'name')?>
<?= $form->field($model,'email')?>

<!-- button -->
<?= Html::submitButton('Submit',['class'=>'btn btn-success']); ?>
<!-- to end the form -->
<?php ActiveForm::end(); ?>