<?php

namespace frontend\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\helpers\Url;

class FixtureController extends \yii\web\Controller {

    public function behaviors() {
        return [
        ];
    }

    public function actionIndex() {
        Yii::getLogger();
        $action = Yii::$app->request->post('action');
        $selection = (array) Yii::$app->request->post('selection'); //typecasting
        if (empty($selection) || empty($action)) {
            return;
        }
        Yii::info(print_r($selection, TRUE));
        foreach ($selection as $id) {
            Yii::info("looping $id");
            $match = \app\models\IncomingMatch::findOne((int) $id); //make a typecasting
            $match->active = 0;
            $match->save();
//move to match table and odds table
            if ($action === "movetoactive") {
                $date = date("Y-m-d H:i:s");

                $sport = new \app\models\Sport();
                $res = $sport->findOne(["sport_name" => $match->sport_name]);
                if (!empty($res->sport_id)) {
                    $sportId = $res->sport_id;
                } else {
                    $sport->sport_name = $match->sport_name;
                    $sport->created_by = "betradar";
                    $sport->created = $date;
                    $sport->modified = $date;
                    $sport->validate();
                    $sport->save();
                    Yii::error(print_r($sport->getErrors(), TRUE));
                    $sportId = $sport->sport_id;
                }
                Yii::info("sport $sportId");
                //competition
                $competition = new \app\models\Competition();
                $res = $competition->findOne(
                        ["competition_name" => $match->competition_name,
                            "category" => $match->competition_category]);
                if (!empty($res->competition_id)) {
                    $compId = $res->competition_id;
                } else {
                    $competition->competition_name = $match->competition_name;
                    $competition->category = $match->competition_category;
                    $competition->sport_id = $sportId;
                    $competition->status = '1';
                    $competition->start_date = $match->start_time;
                    $competition->end_date = $match->end_time;
                    $competition->created_by = "betradar";
                    $competition->created = $date;
                    $competition->modified = $date;
                    $competition->validate();
                    $competition->save();
                    Yii::error(print_r($competition->getErrors(), TRUE));
                    $compId = $competition->competition_id;
                }
                Yii::info("competition $compId");

                $gameId = rand(000, 999);
//add to active matches model
                $activeMatch = new \app\models\Match();
                $activeMatch->home_team = $match->home_team;
                $activeMatch->away_team = $match->away_team;
                $activeMatch->start_time = $match->start_time;
                $activeMatch->game_id = "$gameId";
                $activeMatch->parent_match_id = $match->parent_match_id;
                $activeMatch->competition_id = $compId;
                $activeMatch->status = 1;
                $activeMatch->match_result = "0";
                $activeMatch->bet_closure = $match->start_time;
                $activeMatch->created_by = "betradar";
                $activeMatch->created = $date;
                $activeMatch->validate();
                $activeMatch->save();
                $matchId = $activeMatch->match_id;
                Yii::error(print_r($activeMatch->getErrors(), TRUE));
                Yii::info("match $matchId");

//save odds
                $odds = new \app\models\MatchBet();
                $odds->match_id = $matchId;
                $odds->bet_type_id = 1;
                $odds->home_odd = $match->home_odd;
                $odds->neutral_odd = $match->neutral_odd;
                $odds->away_odd = $match->away_odd;
                $odds->max_bet = "20000";
                $odds->created_by = "betradar";
                $odds->created = $date;
                $odds->validate();
                $odds->save();
                $oddsId = $odds->match_bet_id;
                Yii::error(print_r($odds->getErrors(), TRUE));
                Yii::info("odds $oddsId");
                Yii::info("finsihed loop $id");
            }
//$e->save();
        }
    }

}
