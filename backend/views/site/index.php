<?php

/* @var $this yii\web\View */
use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\Tabs;
$this->title = 'Certificate Of Customary Inbound Vehicle Registion';
?>
<div class="site-index">

    <div class="jumbotron">
        <h1>Wellcome (:</h1>

        <p class="lead">Certificate Of Customary Inbound Vehicle Registion.</p>

        <p><a class="btn btn-lg btn-danger" href="#">Backend</a></p>
    </div>

    <div class="body-content">
        <?php $url = Url::to(['/vehicle/car-master']);
            echo \yii\bootstrap\Html::a('Camaster', $url);
        ?>

    </div>
<?php
$script = <<< JS
    $(function() {
        //save the latest tab (http://stackoverflow.com/a/18845441)
        $('a[data-toggle="tab"]').on('click', function (e) {
            localStorage.setItem('lastTab', $(e.target).attr('href'));
        });

        //go to the latest tab, if it exists:
        var lastTab = localStorage.getItem('lastTab');

        if (lastTab) {
            $('a[href="'+lastTab+'"]').click();
        }
    });
JS;
$this->registerJs($script, yii\web\View::POS_END);
?>
            <?= 
            Tabs::widget([
                'items' => [
                    [
                        'label' => 'Critical',
                        'options' => ['id' => 'tab1'],
                        'content' => 'hello'
                    ],
                    [
                        'label' => 'Warning',
                        'options' => ['id' => 'tab2'],
                        'content' => 'hi'
                    ],
                ],
            ]);
        ?>

