<?php

namespace App\Controller;

use App\Controller;
use App\Repository\UserRepository;
use CMEN\GoogleChartsBundle\GoogleCharts\Charts\AreaChart;
use CMEN\GoogleChartsBundle\GoogleCharts\Charts\ColumnChart;
use CMEN\GoogleChartsBundle\GoogleCharts\Charts\PieChart;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AnalyticsController extends Controller
{
    /**
     * @Route("/analytics", name="analytics")
     */
    public function index(UserRepository $userRepository): Response
    {
        $area = $this->getAccuracyPerAgeGroup($userRepository);
        $col = $this->getAccuracyPerAgeGroupAndProfessionalExperience($userRepository);
        $areaExp = $this->getAccuracyPerExperience($userRepository);

        return $this->render('analytics/index.html.twig', [
            'controller_name' => 'AnalyticsController',
            'area' => $area,
            'areaExp' => $areaExp,
            'col' => $col,
            'categories' => $this->getCategories()
        ]);
    }

    private function getAccuracyPerAgeGroup(UserRepository $userRepository): AreaChart
    {
        $area = new AreaChart();

        $userCount = count($userRepository->findAll()) ?? 0;

        $area->getData()->setArrayToDataTable(
            [
                ['Age group', 'Accuracy'],
                ['10', 12],
                ['20', 0],
                ['30', 45],
                ['40', 50],
                ['50', 40],
                ['60', 0],
                ['70', 0],
                ['80', 5]
            ]
        );
        $area->getOptions()->setTitle("Accuracy per age group, data size = " . $userCount);
        $area->getOptions()->getHAxis()->setTitle('Ages');
        $area->getOptions()->getHAxis()->getTitleTextStyle()->setColor('#333');
        $area->getOptions()->getVAxis()->setMinValue(0);
        return $area;
    }

    private function getAccuracyPerAgeGroupAndProfessionalExperience(UserRepository $userRepository): ColumnChart
    {
        $chart = new \CMEN\GoogleChartsBundle\GoogleCharts\Charts\Material\ColumnChart();

        $userCount = count($userRepository->findAll());

        $chart->getData()->setArrayToDataTable([
                                                   ['Age', 'Professional accuracy', 'Non-professional accuracy'],
                                                   ['10', 10, 7],
                                                   ['20', 15, 10],
                                                   ['30', 20, 17],
                                                   ['40', 25, 21],
                                                   ['50', 40, 31],
                                                   ['60', 15, 10],
                                                   ['70', 10, 1],
                                                   ['80', 2, 0]
                                               ]);

        $chart->getOptions()->getChart()
            ->setTitle('Accuracy per age and experience, data size = ' . $userCount)
            ->setSubtitle('Age, Professional accuracy, Non-professional accuracy');
        $chart->getOptions()
            ->setBars('vertical')
            ->setHeight(400)
            ->setWidth(900)
            ->setColors(['#1b9e77', '#d95f02'])
            ->getVAxis()
            ->setFormat('decimal');

        return $chart;
    }

    private function getAccuracyPerExperience(UserRepository $userRepository): AreaChart
    {
        $area = new AreaChart();

        $userCount = count($userRepository->findAll()) ?? 0;

        $area->getData()->setArrayToDataTable(
            [
                ['Experience in years', 'Accuracy'],
                ['1', 10],
                ['2', 26],
                ['3', 30],
                ['4', 40],
                ['5', 50],
                ['6', 60],
                ['7', 51],
                ['8+', 61]
            ]
        );
        $area->getOptions()->setTitle("Accuracy per experience in years, data size = " . $userCount);
        $area->getOptions()->getHAxis()->setTitle('Ages');
        $area->getOptions()->getHAxis()->getTitleTextStyle()->setColor('#030033');
        $area->getOptions()->getVAxis()->setMinValue(0);
        return $area;
    }
}
