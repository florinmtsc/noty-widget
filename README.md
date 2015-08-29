# noty-widget
<h2><a href="http://ned.im/noty/">Noty</a> (jQuery notification plugin) widget for Yii 2 framework</h2>

<em>The credits for this great jquery plugin goes to https://github.com/needim/noty. <b>This is just an Yii2 widget developed based on this plugin</b>
<br/>
<em>It has integrated the <b><a href="https://daneden.github.io/animate.css/">animate.css</a></b> for great transition effects</em>

<h1>Install</h1>

<h4>Using <em>Composer</em></h4>

Type <code><b>composer require florinmtsc/noty-widget</b></code> in your yii 2 application root and the plugin will be added to your composer.json file.

<h3>Manual install</h3>
<ul>
  <li><b>Git bash</b><br/>
  <p>Type <code><b>git clone https://github.com/florinmtsc/noty-widget.git</b></code> where you want to store the widget folder and then adjust the namespaces accordingly in <em><b>AlertAsset.php</b> and <b>AlertWidget.php</b></em></p>
  </li>
  <li><b>Download zip archive</b></li>
  <p>Extract the archive content where you want to store the widget and adjust the namespaces accordingly.</p>
</ul>

<h1>Usage</h1>
<b><code>echo yii\notywidget\AlertWidget::widget(['options' => $options]);</code></b>
<p>Where <em><b>$options</b></em> is an array with all the options available on the plugin page. Please visit the plugin <a href="http://ned.im/noty/#/about">official page</a> for documentation on the options available.</p>
<b>In order to display the notification, you have to make sure you have <em>text</em> and <em>type</em> key values set in $options array.</b>
The <em>text</em> option stores the notification message and the <em>type</em> stores the type of the notification: <em>Alert</em>, <em>Success</em>, <em>Error</em>, <em>Warning</em>, <em>Information</em>, <em>Confirm</em>

<b>Using Callback functions</b>
<p>Noty plugin gives the option to call custom functions when events occur. To attach the callback functions just put <em>callback</em></p> 
Example:<br/>
<code>echo yii\notywidget\AlertWidget::widget(['options' => [</code><br/>
            &nbsp;&nbsp;&nbsp;&nbsp;<code>'text' => 'Error',</code><br/>
            &nbsp;&nbsp;&nbsp;&nbsp;<code>'type' => 'error',</code><br/>
            &nbsp;&nbsp;&nbsp;&nbsp;<code>'callback' => [<br/><br/></code><br/>
            &nbsp;&nbsp;&nbsp;&nbsp;<code>'onShow' => 'function() {console.log("a");}', // javascript function </code><br/>
            &nbsp;&nbsp;&nbsp;&nbsp;<code>]</code><br/>
<code>]]);</code></code><br/>
