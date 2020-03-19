<?php

use kartik\editable\Editable;
use kartik\popover\PopoverX;
use kartik\depdrop\DepDrop;
use yii\helpers\Url;
use yii\helpers\Html;
use app\models\Match;

// Extension of advanced Editable for usage with complex widgets like DepDrop using 
// dependent data
$editable = Editable::begin([
            'model' => $model,
            'attribute' => 'home_team',
            'asPopover' => true,
            'size' => PopoverX::SIZE_MEDIUM,
            'inputType' => Editable::INPUT_DEPDROP,
            'options' => [
                'type' => DepDrop::TYPE_SELECT2,
                'select2Options' => ['pluginOptions' => ['allowClear' => true]],
                'options' => ['id' => 'subcat-id-p', 'placeholder' => 'Select subcat...'],
                'pluginOptions' => [
                    'depends' => ['cat-id-p'],
                    'url' => Url::to(['/match/index'])
                ]
            ]
        ]);
$form = $editable->getForm();
// use a hidden input to understand if form is submitted via POST
$editable->beforeInput = Html::hiddenInput('kv-editable-depdrop', 1) .
        $form->field($model, 'cat')->dropDownList(['' => 'Select cat...'] + Match::$catList, ['id' => 'cat-id-p'])->label(false) . "\n";
$editable->afterInput = $form->field($model, 'prod')->widget(DepDrop::classname(), [
            'type' => DepDrop::TYPE_SELECT2,
            'select2Options' => ['pluginOptions' => ['allowClear' => true]],
            'options' => ['id' => 'prod-id-p', 'placeholder' => 'Select prod...'],
            'pluginOptions' => [
                'depends' => ['cat-id-p', 'subcat-id-p'],
                'url' => Url::to(['/site/prod'])
            ]
        ])->label(false) . "\n";
Editable::end();
