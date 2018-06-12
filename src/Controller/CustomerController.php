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

    /**
     * @Route("/customer/new", name="new_customer")
     * Method({"GET", "POST"})
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     */
    public function new(Request $request) {
        $customer = new Customer();

        $form = $this->createFormBuilder($customer)
            ->add('name')
            ->add('dni')
            ->add('email')
            ->add('telephone')
            ->add('postal_code')
            ->add('save', SubmitType::class, array(
                'label' => 'Crear',
                'attr' => array('class' => 'btn btn-primary mt-3')
            ))
            ->getForm();

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $customer = $form->getData();

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($customer);
            $entityManager->flush();

            return $this->redirectToRoute('customers_list');
        }

        return $this->render('customer/new.html.twig', array(
            'form' => $form->createView()
        ));
    }

    /**
     * @Route("/customers/edit/{id}", name="edit_customer")
     * Method({"GET", "POST"})
     */
    public function edit(Request $request, $id) {
        $customer = $this->getDoctrine()->getRepository(Customer::class)->find($id);

        $form = $this->createFormBuilder($customer)
            ->add('name')
            ->add('email')
            ->add('telephone')
            ->add('postal_code')
            ->add('comandas')
            ->add('save',SubmitType::class, array(
                'label' => 'Update',
                'attr' => array('class' => 'btn btn-primary mt-3')
            ))
            ->getForm();

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->flush();

            return $this->redirectToRoute('customers_list');
        }
        return $this->render('customer/edit.html.twig', array(
            'form' => $form->createView()
        ));
    }

    /**
     * @Route("/customers/{id}", name="customer_show")
     */
    public function show($id) {
        $customer = $this->getDoctrine()->getRepository(Customer::class)->find($id);
        return $this->render('customer/show.html.twig',array('customer' => $customer));
    }
}