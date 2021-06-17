<?php

/** @var yii\web\View $this */
/** @var array $groupsInfo */

use yii\bootstrap\Html;
use yii\helpers\Json;

$this->title = 'Сообщества ВК';
?>

<script type="text/javascript">
    let global = {groupsInfo: '<?= Json::encode($groupsInfo['groupsArray'])?>'};
</script>

<div class="row" id="site-index">
    <div class="col-md-6 col-md-offset-2">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <span>Сообщества Вконтакте</span>
            </div>
            <div class="panel-body">
                <ul class="list-group" data-bind="foreach: {data: groupsList }">
                    <li class="list-group-item">
                        <form class="form-inline">
                            <div class="form-group">
                                <a data-bind="attr: {href: href}">
                                    <img class="img_50" data-bind="attr: {src: photo_50}">
                                </a>
                            </div>
                            <div class="form-group">
                                <a data-bind="attr: { href: href}"><span data-bind="text: name"></a>
                                <p class="labeled" data-bind="text: activity"></p>
                                <p class="labeled"><span data-bind="text: members_count"></span>&nbspподписчика</p>
                            </div>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <span class="glyphicon glyphicon-list"></span>
                Параметры поиска
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <?= Html::label('Страна:', 'countriesSelect'); ?>
                            <?php echo Html::dropDownList('countriesSelect', 0, $groupsInfo['select']['countries'],
                                [
                                    'data-bind' => "value: selectedCountry",
                                    'id' => 'countriesSelect',
                                    'class' => "form-control",
                                ]); ?>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <?= Html::label('Город:', 'citiesSelect'); ?>
                            <?php echo Html::dropDownList('citiesSelect', 0, $groupsInfo['select']['cities'],
                                [
                                    'data-bind' => "value: selectedCity",
                                    'id' => 'citiesSelect',
                                    'class' => "form-control",
                                ]); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
