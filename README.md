yii2 location picker
====================
yii2 location picker

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist pavle/yii2-location-picker "*"
```

or add

```
"pavle/yii2-location-picker": "*"
```

to the require section of your `composer.json` file.


Usage
-----

Once the extension is installed, simply use it in your code by  :

```php
Location: <input type="text" id="us2-address" style="width: 200px"/>
Radius: <input type="text" id="us2-radius"/>
Lat.: <input type="text" id="us2-lat"/>
Long.: <input type="text" id="us2-lon"/>
<?= $form->field($model, 'coordinates')->widget(LocationPicker::className(), [
    'id' => 'input-coordinates',
    'pattern' => '%longitude%,%latitude%',
    'pluginOptions' => [
        'location' => [
            'latitude' => $model->getLatitude(),
            'longitude' => $model->getLongitude(),
        ],
        'inputBinding' => [
            'latitudeInput' => new JsExpression("$('#us2-lat')"),
            'longitudeInput' => new JsExpression("$('#us2-lon')"),
            'radiusInput' => new JsExpression("$('#us2-radius')"),
            'locationNameInput' => new JsExpression("$('#us2-address')"),
        ],
        'enableAutocomplete' => true,
    ],
]) ?>
```
