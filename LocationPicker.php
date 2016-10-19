<?php

namespace pavle\location\picker;

use yii\base\ErrorException;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Json;
use yii\web\JsExpression;
use yii\widgets\InputWidget;

/**
 * This is just an example.
 */
class LocationPicker extends InputWidget
{
    /**
     * @var array
     */
    public $pluginOptions = [];

    /**
     * @var string
     */
    public $pattern = '%latitude%,%longitude%';

    /**
     * @var string
     */
    public $key;

    /**
     * @inheritDoc
     */
    public function init()
    {
        parent::init();

        if (!$this->key) {
            throw new ErrorException('Set key: https://developers.google.com/maps/documentation/javascript/get-api-key?hl=zh-cn');
        }

        $this->options['id'] = $this->id;

        if(!isset($this->options['style'])){
            $this->options['style'] = 'width: 500px; height: 400px;';
        }

        if($this->hasModel()){
            $this->name = Html::getInputName($this->model, $this->attribute);
            $this->value = ArrayHelper::getValue($this->model, $this->attribute);
        }

        if(!ArrayHelper::getValue($this->pluginOptions, 'onchanged')){

            $this->pluginOptions['onchanged'] = new JsExpression("function(currentLocation, radius, isMarkerDropped) {
                var pattern = '{$this->pattern}';

                pattern = pattern.replace(/%latitude%/g, currentLocation.latitude);
                pattern = pattern.replace(/%longitude%/g, currentLocation.longitude);

                $('input[name=\"{$this->name}\"]').val(pattern);
            }");
        }
    }

    /**
     * @inheritdoc
     */
    public function run()
    {
        $this->registerPlugin();

        $input = Html::hiddenInput($this->name, $this->value);
        return $input . Html::tag('div', '', $this->options);
    }

    /**
     * 注册插件
     */
    public function registerPlugin(){
        $view = $this->view;

        $view->registerJsFile("http://maps.google.com/maps/api/js?key={$this->key}&libraries=places");

        LocationPickerAsset::register($view);

        $pluginOptions = Json::encode($this->pluginOptions);
        $js = <<<JS
    $("#{$this->id}").locationpicker($pluginOptions);
JS;
        $this->view->registerJs($js);
    }
}
