<?php

namespace florinmtsc\notywidget\AlertAsset;

use \yii\web\AssetBundle;

/**
 * Widget AssetBundle
 *
 * Class AlertAsset
 * @package florinmtsc\notywidget\AlertAsset
 */
class AlertAsset extends AssetBundle
{
    public $sourcePath = "@vendor/needim/noty";

    public $js = [
        'js/noty/jquery.noty.js',
        'js/noty/packaged/jquery.noty.packaged.min.js',
        'js/noty/promise.js',
        'js/noty/layouts/topRight.js',
        'js/noty/layouts/center.js',
        'js/noty/themes/bootstrap.js',
        'js/noty/themes/default.js',
        'js/noty/themes/relax.js',
    ];

    public $depends = [
        'yii\web\JqueryAsset',
    ];

    public static function register($view, $options = []) {
        parent::register($view);

        $callback = null;

        if (isset($options['callback'])) {
            $callback = $options['callback'];
        }

        $settings = $options + self::_getDefaultOptions();
        unset($options);

        if ($settings['text'] == '' && is_array($settings['type'])) {
            foreach($settings['type'] as $type) {
                $new_settings = $settings;
                $new_settings['type'] = $type;
                $new_settings['text'] = \Yii::$app->session->getFlash($type);
                if (isset($new_settings['text']) && is_array($new_settings['text'])) {
                    foreach($new_settings['text'] as $text) {
                        $multipleFlashesSettings = $new_settings;
                        $multipleFlashesSettings['text'] = $text;
                        $view->registerJs(self::_run($multipleFlashesSettings, $callback));
                    }
                } elseif (isset($new_settings['text'])) {
                    $view->registerJs(self::_run($new_settings, $callback));
                }

            }
        } else {
            $view->registerJs(self::_run($settings, $callback));
        }

    }

    private static function _getDefaultOptions() {
        return [
            'layout' => 'topRight',
            'theme' => 'relax', // or 'relax'
            'type' => 'alert',
            'text' => '', // can be html or string
            'dismissQueue' => true, // If you want to use queue feature set this true
            'template' => '<div class="noty_message"><span class="noty_text"></span><div class="noty_close"></div></div>',
            'animation' => [
                'open' => ['height' => 'toggle'], // jQuery animate function property object
                'close' => ['height' => 'toggle'], // jQuery animate function property object
                'easing' => 'swing', // easing
                'speed' => 500 // opening & closing animation speed
            ],
            'timeout' => false, // delay for closing event. Set false for sticky notifications
            'force' => false, // adds notification to the beginning of queue when set to true
            'modal' => false,
            'maxVisible'=> 5, // you can set max visible notification for dismissQueue true option,
            'killer' => false, // for close all notifications before show
            'closeWith' => ['click'], // ['click', 'button', 'hover', 'backdrop'] // backdrop click will close all notifications
            'callback' => [
                'onShow' => '',
                'afterShow' => '',
                'onClose' => '',
                'afterClose' => '',
                'onCloseClick' => '',
            ],
            'buttons'=> false // an array of buttons
        ];
    }

    private static function _run(array $options, array $callback = null) {
        $options = \yii\helpers\Json::encode($options);

        $js = "
        var notificationWidgetOptions = $options;
        for (var i = 0 ; i < notificationWidgetOptions.callback.length-1; i++) {notificationWidgetOptions.callback[i] = function() {}};
        ";

        if (isset($callback)) {
            foreach($callback as $event => $fnc) {
                $js .= "notificationWidgetOptions.callback.$event = $fnc;";
            }
        }
        $js .= 'var notificationWidget = noty(notificationWidgetOptions);';

        return $js;
    }
}