<?php

namespace yii\mdi\assets;

use yii\web\AssetBundle;

class MaterialDesignIconsAsset extends AssetBundle
{
    public $sourcePath = __DIR__ . '/dist';

    public $css = [
        'css/materialdesignicons.min.css',
    ];
}