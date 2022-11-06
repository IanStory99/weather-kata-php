<?php

namespace WeatherKata;

use WeatherKata\Http\Client;
use WeatherKata\Prediction;

class WindPrediction implements Prediction
{
  public function process_results(array $weather_prediction, \Datetime $datetime): string
  {
    foreach ($weather_prediction as $result) {
      if ($result["applicable_date"] == $datetime->format('Y-m-d')) {
        return $result['wind_speed'];
      }
    }

    return "";
  }

  public function execute(string &$city_id, \Datetime $datetime): string
  {
    $client = new Client();

    $wind_prediction = $client->get("https://www.metaweather.com/api/location/$city_id");

    return $this->process_results($wind_prediction, $datetime);
  }
}