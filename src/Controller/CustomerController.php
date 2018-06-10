<?php
/**
 * Created by PhpStorm.
 * User: PMONTP19
 * Date: 10/06/2018
 * Time: 12:33
 */

namespace App\Controller;
use App\Entity\Customer;

use App\Entity\Comanda;
use Doctrine\DBAL\Types\DateType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;


class CustomerController extends Controller
{
    /**
     * @Route("/customers", name="customers_list")
     * @Method({"GET"})
     */

    public function index() {
        $customers = $this->getDoctrine()->getRepository(Customer::class)->findAll();
        return $this->render('customer/index.html.twig', array('customers'=> $customers));
    }

}