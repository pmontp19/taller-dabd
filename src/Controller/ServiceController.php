<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use App\Entity\Service;

class ServiceController extends Controller
{
    /**
     * @Route("/service", name="service")
     */
    public function index()
    {
        // you can fetch the EntityManager via $this->getDoctrine()
        // or you can add an argument to your action: index(EntityManagerInterface $entityManager)
        $entityManager = $this->getDoctrine()->getManager();

        $service = new Service();
        $service->setName('Tube chgt');
        $service->setPrice(100);
        $service->setCode(1);
        $service->setLength(10);

        // tell Doctrine you want to (eventually) save the Product (no queries yet)
        $entityManager->persist($service);

        // actually executes the queries (i.e. the INSERT query)
        $entityManager->flush();

        return new Response('Saved new product with id '.$service->getCode());
    }

    /**
     * @Route("/service/{code}", name="service_show")
     * @param $code
     * @return Response
     */
    public function show($code)
    {
        $service = $this->getDoctrine()
            ->getRepository(Service::class)
            ->find($code);
        if (!$service) {
            throw $this->createNotFoundException(
                'No service found for id '.$code
            );
        }
        return new Response('Check out this great service: '.$service->getName());
    }
}
