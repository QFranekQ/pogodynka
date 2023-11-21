<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

use App\Entity\Forecast;
use App\Service\WeatherUtil;
use Symfony\Component\HttpKernel\Attribute\MapQueryParameter;

class WeatherApiController extends AbstractController
{
    #[Route('/api/v1/weather', name: 'app_weather_api')]
    public function index(
        WeatherUtil $util,
        #[MapQueryParameter('country')] string $country,
        #[MapQueryParameter('city')] string $city,
        #[MapQueryParameter('format')] string $format = 'Json',
        #[MapQueryParameter('twig')] bool $twig = false,

    ): Response
    {
        $measurements = $util->getWeatherForCountryAndCity($country, $city);

        if ($format === 'csv') {
            if ($twig) {
                return $this->render('weather_api/index.csv.twig', [
                    'city' => $city,
                    'country' => $country,
                    'measurements' => $measurements,
                ]);
            } else {
            $csv = "city,country,date,celsius,cloudy,humidity,ChanceOfPrecipitation,fahrehneit\n";
            $csv .= implode(
                "\n",
                array_map(fn(Forecast $m) => sprintf(
                    '%s,%s,%s,%s,%s,%s,%s,%s',
                    $city,
                    $country,
                    $m->getDate()->format('Y-m-d'),
                    $m->getTemperature(),
                    $m->getCloudy(),
                    $m->getHumidity(),
                    $m->getChanceOfPrecipitation(),
                    $m->getFahrehneit(),

                ), $measurements)
            );
            $csv = strtr($csv, ["\n" => PHP_EOL]);
            return new Response($csv, 200, [
                    'Content-Type' => 'text/plain',
            ]);
            }
        }
        if ($twig) {
            return $this->render('weather_api/index.json.twig', [
                'city' => $city,
                'country' => $country,
                'measurements' => $measurements,
            ]);
        } else {
            return $this->json([
                'city' => $city,
                'country' => $country,
                'measurements' => array_map(fn(Forecast $m) => [
                    'date' => $m->getDate()->format('Y-m-d'),
                    'celsius' => $m->getTemperature(),
                    'cloudy' => $m->getCloudy(),
                    'humidity' => $m->getHumidity(),
                    'ChanceOfPrecipitation' => $m->getChanceOfPrecipitation(),
                    'Fahrehneit' => $m->getFahrehneit(),

                ], $measurements),
            ]);
        }
    }
}
