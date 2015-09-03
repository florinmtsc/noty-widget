<?php
namespace florinmtsc\notywidget;

use Yii;
use yii\base\Widget;;

/**
 * Widget class
 *
 * Class AlertWidget
 * @package florinmtsc\notywidget
 */
class AlertWidget extends Widget
{
    const SUPPORTED_TYPES = [
        'alert',
        'success',
        'error',
        'warning',
        'information',
        'confirm'
    ];

    public $options;

    public function init() {

        parent::init();

        /**
         * plugin supported file types
         */
        if (! isset($this->options['type'])) {
            $this->options['type'] = AlertWidget::SUPPORTED_TYPES;
        };

        /**
         * check for flashes returned by Yii::$app->session
         */
        if (isset($this->options['text']) && is_array($this->options['text'])) {
            if (count($this->options['text']) == 1) {
                $this->options['text'] = reset($this->options['text']);
            } else {
                $this->options['text'] = end($this->options['text']);
            }
        }
    }

    public function run()
    {
        return $this->render('alert', ['options' => $this->options]);
    }
}