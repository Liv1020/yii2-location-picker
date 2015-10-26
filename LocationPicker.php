<?php

namespace pavle\location\picker;
use yii\helpers\Html;
use yii\helpers\Json;
use yii\widgets\InputWidget;

/**
 * This is just an example.
 */
class LocationPicker extends InputWidget
{
    public $pluginOptions = [];

    /**
     * @inheritDoc
     */
    public function init()
    {
        parent::init();

        $this->options['id'] = $this->id;

        if(!isset($this->options['style'])){
            $this->options['style'] = 'width: 500px; height: 400px;';
        }

    }

    public function run()
    {
        $this->registerPlugin();

        return Html::tag('div', '', $this->options);
    }

    public function registerPlugin(){
        LocationPickerAsset::register($this->view);

        $pluginOptions = Json::encode($this->pluginOptions);
        $js = <<<JS
    $("#{$this->id}").locationpicker($pluginOptions);
JS;
    }
}
