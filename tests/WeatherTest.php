<?php

namespace Tests\WeatherKata;

use WeatherKata\Forecast;
use WeatherKata\City;
use PHPUnit\Framework\TestCase;

class WeatherTest extends TestCase
{
    /** @test */
    public function find_the_weather_of_today()
    {
        $forecast = new Forecast();
        $city     = "Madrid";

        $prediction = $forecast->predict($city);

        $this->assertEquals('sunny', $prediction);
    }

    /** @test */
    public function find_the_weather_of_any_day()
    {
        $forecast = new Forecast();
        $city     = "Madrid";

        $prediction = $forecast->predict($city, new \DateTime('+2 days'));

        $this->assertEquals('sunny', $prediction );
    }

/** @test */
    public function find_the_wind_of_any_day()
    {
        $forecast = new Forecast();
        $city = "Madrid";

        $prediction = $forecast->predict($city, new \DateTime(), true);

        $this->assertEquals(60.0, $prediction);
    }

    /** @test */
    public function change_the_city_to_woeid()
    {
        $cityName = "Madrid";
        $city = new City($cityName);

        $cityId = $city->getID();

        $this->assertEquals("766273", $cityId);
    }

    /** @test */
    public function there_is_no_prediction_for_more_than_5_days()
    {
        $forecast = new Forecast();
        $city = "Madrid";

        $prediction = $forecast->predict($city, new \DateTime('+6 days'));

        $this->assertEquals("", $prediction);
    }
}