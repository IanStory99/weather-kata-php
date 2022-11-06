<?php

namespace WeatherKata;

interface Prediction
{
  public function process_results(array $weather_prediction, \Datetime $datetime);

  public function execute(string &$city_id, \Datetime $datetime);
}