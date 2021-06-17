<?php

namespace app\controllers;

use app\models\vkApi;
use yii\web\Controller;


class SiteController extends Controller
{
    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $vkApi = new vkApi();
        $groupsInfo = $vkApi->getGroupsInfo();

        return $this->render('index', compact('groupsInfo'));
    }
}
