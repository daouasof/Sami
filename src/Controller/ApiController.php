<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ApiController extends AbstractController
{
    #[Route(
        path: '/calculate',
        name: 'calculate_emissions',
        methods: ['POST'],
        format: 'json',
    )]
    public function calculate(Request $request): Response
    {
        $body = \json_decode($request->getContent(), true);

        $total = 0;
        foreach ($body['travels'] as $travel) {
            if ($travel['mode'] === 'plane') {
                if ($travel['distance'] < 1000) {
                    $total += $travel['people'] * $travel['distance'] * 258;
                    if ($travel['round_trip']) {
                        $total += $travel['people'] * $travel['distance'] * 258;
                    }
                } else if ($travel['distance'] < 3500) {
                    $total += $travel['people'] * $travel['distance'] * 187;
                    if ($travel['round_trip']) {
                        $total += $travel['people'] * $travel['distance'] * 187;
                    }
                } else {
                    $total += $travel['people'] * $travel['distance'] * 152;
                    if ($travel['round_trip']) {
                        $total += $travel['people'] * $travel['distance'] * 152;
                    }
                }
            } else if ($travel['mode'] === 'car') {
                if (!\array_key_exists('type', $travel)) {
                    $total += $travel['people'] * $travel['distance'] * 193;
                    if ($travel['round_trip']) {
                        $total += $travel['people'] * $travel['distance'] * 193;
                    }
                } else {
                    if ($travel['type'] === 'diesel') {
                        // 3.16 kgCO2e/l for diesel
                        $fe = (3.16 * 1000) * ($travel['mileage'] / 100);
                        $total += $travel['people'] * $travel['distance'] * $fe;
                        if ($travel['round_trip']) {
                            $total += $travel['people'] * $travel['distance'] * $fe;
                        }
                    } else if ($travel['type'] === 'gasoline') {
                        // 2.81 kgCO2e/l for gasoline
                        $fe = (2.81 * 1000) * ($travel['mileage'] / 100);
                        $total += $travel['people'] * $travel['distance'] * $fe;
                        if ($travel['round_trip']) {
                            $total += $travel['people'] * $travel['distance'] * $fe;
                        }
                    }
                }
            } else if ($travel['mode'] === 'tgv') {
                $total += $travel['people'] * $travel['distance'] * 1.7;
                if ($travel['round_trip']) {
                    $total += $travel['people'] * $travel['distance'] * 1.7;
                }
            }
        }

        return $this->json([
            'total_emissions' => $total,
        ]);
    }
}
