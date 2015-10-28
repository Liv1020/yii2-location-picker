<?php
/**
 * User: Liv <523260513@qq.com>
 * Date: 15/10/26
 * Time: 下午9:32
 */

namespace pavle\location\picker;


use yii\web\AssetBundle;

class LocationPickerAsset extends AssetBundle
{
    public $sourcePath = '@bower/jquery-locationpicker-plugin/dist';

    public $js = [
        'http://maps.google.com/maps/api/js?sensor=false&libraries=places',
        'locationpicker.jquery.js',
    ];

    public $depends = [
        'yii\web\JqueryAsset'
    ];
}