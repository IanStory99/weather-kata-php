<?php

namespace WeatherKata;

use WeatherKata\Http\Client;

class City
{
  private string $name;

  public function __construct(string $city_name)
  {
    $this->name = $city_name;
  }

  public function getID(): string
  {
    // Create a Guzzle Http Client
    $client = new Client();

    $woeid = $client->get("https://www.metaweather.com/api/location/search/?query=$this->name");

    return $woeid;
  }
}