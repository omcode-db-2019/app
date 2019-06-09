<?php


namespace app\commands;


use app\exceptions\InvalidAccessTokenException;
use app\exceptions\QuotaExceededException;
use app\exceptions\UnknownStationException;
use app\models\Measurement;
use app\models\Station;
use app\services\Waqi;
use GuzzleHttp\Exception\GuzzleException;
use Yii;
use yii\console\Controller;

class ConsoleController extends Controller
{
    function actionIndex()
    {
        $service = new Waqi();
        $stations = Station::findAll(['service_id' => 1]);

        foreach ($stations as $station) {
            try {
                $service->getObservationByStation($station);
            } catch (GuzzleException $e) {
                Yii::error($e->getMessage());
            } catch (QuotaExceededException $e) {
                Yii::error($e->getMessage());
            } catch (UnknownStationException $e) {
                Yii::error($e->getMessage());
            } catch (InvalidAccessTokenException $e) {
                Yii::error($e->getMessage());
            }
            $isExist = Measurement::findAll(
                [
                    'date' => $service->getMeasurementTime()->format('Y-m-d H:i:s'),
                    'station_id' => $service->getStationId()
                ]);
            if ($isExist === []) {
                Measurement::create($service);
            }
        }
    }
}