<?php
namespace florinmtsc\notywidget;

use Yii;
use yii\base\Widget;;

class AlertWidget extends Widget
{
    public $type;
    public $options;

    protected $supported_types;

    public function init() {

        parent::init();

        $supported_types = [ 'alert', 'success', 'error', 'warning', 'information', 'confirm' ];

        if ( ! in_array( $this->options['type'], $supported_types ) ) {
            $exception = new \yii\base\Exception( Yii::t( 'app', 'Please provide a valid alert type' ), '500' );
            \Yii::$app->errorHandler->handleException( $exception );
        };

        if ( !isset($this->options['text']) )
            $this->options['text'] = '';
        if ( !isset($this->options['type']) )
            $this->options['type'] = '';

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