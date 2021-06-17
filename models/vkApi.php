<?php


namespace app\models;

use Yii;
use yii\base\Model;

/**
 * Class vkApi
 * @package app\models
 */
class vkApi extends Model
{
    const GROUPS = 'piter4you.live, mosc1, donetsk, fish_vrn, club115150347, vkteam, club139424254, donstepacademy, echo_php, bookflow';
    const METHOD = 'groups.getById';
    const GROUP_URL = "https://vk.com/";
    const API_URL = 'https://api.vk.com/method/';
    const FIELDS = array('activity', 'members_count', 'city', 'country');

    /**
     * @return array
     */
    public function getGroupsInfo()
    {
        $request_params = array(
            'user_id' => Yii::$app->params['ApiID'],
            'access_token' => Yii::$app->params['accessToken'],
            'group_ids' => self::GROUPS,
            'fields' => self::FIELDS,
            'v' => '5.52'
        );
        $get_params = http_build_query($request_params);
        $result = json_decode(file_get_contents(self::API_URL . self::METHOD . '?' . $get_params));

        return $this->parseResult($result->response);
    }

    /**
     * @param $result
     * @return array
     */
    protected function parseResult($result)
    {
        $groupsInfo = array();
        $cities = array(0 => 'Все');
        $countries = array(0 => 'Все');
        foreach ($result as $key => $item) {
            $groupsInfo['groupsArray'][$key]['id'] = $item->id;
            $groupsInfo['groupsArray'][$key]['name'] = isset($item->name) ? str_replace('"', '\"', $item->name) : null;
            $groupsInfo['groupsArray'][$key]['screen_name'] = isset($item->screen_name) ? $item->screen_name : null;
            $groupsInfo['groupsArray'][$key]['href'] = isset($item->screen_name) ? self::GROUP_URL . $item->screen_name : "";
            $groupsInfo['groupsArray'][$key]['photo_50'] = isset($item->photo_50) ? $item->photo_50 : null;
            $groupsInfo['groupsArray'][$key]['activity'] = isset($item->activity) ? $item->activity : null;
            $groupsInfo['groupsArray'][$key]['members_count'] = isset($item->members_count) ? $item->members_count : null;
            $groupsInfo['groupsArray'][$key]['city'] = isset($item->city) ? $item->city : null;
            $groupsInfo['groupsArray'][$key]['country'] = isset($item->country) ? $item->country : null;
            if (isset($item->city)) {
                $cities[$item->city->id] = $item->city->title;
            }
            if (isset($item->country)) {
                $countries[$item->country->id] = $item->country->title;
            }
        }
        $groupsInfo['select']['cities'] = array_unique($cities);
        $groupsInfo['select']['countries'] = array_unique($countries);

        return $groupsInfo;
    }
}