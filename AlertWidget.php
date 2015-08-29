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
    public $type;
    public $options;

    protected $supported_types;

    public function init() {

        parent::init();

        /**
         * plugin supported file types
         */
        $supported_types = [ 'alert', 'success', 'error', 'warning', 'information', 'confirm' ];

        if ( ! in_array( $this->options['type'], $supported_types ) ) {
            $exception = new \yii\base\Exception( Yii::t( 'app', 'Please provide a valid alert type' ), '500' );
            \Yii::$app->errorHandler->handleException( $exception );
        };

        /**
         * check for flashes returned by Yii::$app->session
         */
        if (is_array($this->options['text'])) {
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