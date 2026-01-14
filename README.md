# MaterialDesign icons bundle for Yii 2.0 Framework #

<p align="center">
    <a href="https://github.com/yiisoft" target="_blank">
        <img src="https://avatars0.githubusercontent.com/u/993323" height="100px">
    </a>
</p>

## Installation #

___

[Changelog](CHANGELOG.md)

The preferred way to install this extension is through [composer ](http://getcomposer.org/download/)

Either run:

`composer require mylistryx/yii2-material-icons`  or add `"mylistryx/yii2-material-icons": "*"` into your `composer.json` file. 

Then register assets in your view file:

`FontAwesomeAsset::register($this)` OR `FontAwesomeCdnAsset::register($this)` to use CDN files.

and use:

`<?= MDI::i('material-ui') ?>`

... and so on. Full list of icons can be found at https://pictogrammers.github.io/@mdi/font/7.4.47/

Some transformation are represented:

`<?= MDI::i('material-ui')->flipV() ?>`

`<?= MDI::i('material-ui')->flipH() ?>`

`<?= MDI::s('material-ui')->spin() ?>`

`<?= MDI::s('material-ui')->color('light')->inverse(true) ?>`

`<?= MDI::s('material-ui')->colorLight()->inverse() ?>`

`<?= MDI::s('material-ui')->rotate(90) ?>`

`<?= MDI::s('material-ui')->rotate90() ?>`

see source files for more.

Note: We do not include the ability to use ...->flip*() and ...->rotate*() at the same time.