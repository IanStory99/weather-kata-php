<?php

namespace WeatherKata;

use WeatherKata\City;

class Forecast
{
    const MAX_PREDICTABLE_DATETIME = "+6 days 00:00:00";

    private function isValidPredictionDate(\Datetime $prediction_date): bool
    {
        return ($prediction_date < new \DateTime(self::MAX_PREDICTABLE_DATETIME));
    }

    public function predict(string &$city_name, \DateTime $prediction_date = new \DateTime(), bool $is_wind_prediction = false): string
    {
        if (!$this->isValidPredictionDate($prediction_date)) {
            return "";
        }

        $city = new City($city_name);
        $cityId = $city->getID();

        if ($is_wind_prediction) {
            $wind_prediction = new WindPrediction();
            return $wind_prediction->execute($cityId, $prediction_date);
        }

        $weather_prediction = new WeatherPrediction();
        return $weather_prediction->execute($cityId, $prediction_date);
    }
}