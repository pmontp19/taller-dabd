<?php
/**
 * Created by PhpStorm.
 * User: PMONTP19
 * Date: 10/06/2018
 * Time: 11:02
 */
  namespace App\Controller;

  use App\Entity\Article;

  use App\Entity\Comanda;
  use App\Entity\Customer;
  use Doctrine\DBAL\Types\DateType;
  use Doctrine\ORM\Query\ResultSetMapping;
  use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
  use Symfony\Component\HttpFoundation\Response;
  use Symfony\Component\HttpFoundation\Request;
  use Symfony\Component\Routing\Annotation\Route;
  use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
  use Symfony\Bundle\FrameworkBundle\Controller\Controller;
  use Symfony\Component\Form\Extension\Core\Type\TextType;
  use Symfony\Component\Form\Extension\Core\Type\TextareaType;
  use Symfony\Component\Form\Extension\Core\Type\SubmitType;


  class ComandaController extends Controller {
      /**
       * @Route("/", name="comanda_list")
       * @Method({"GET"})
       */
      public function index() {
          $comandas = $this->getDoctrine()->getRepository(Comanda::class)->findAll();
          return $this->render('comanda/index.html.twig', array('comandas' => $comandas));
      }

      /**
       * @Route("/comanda/customer/{id}", name="comanda_customer")
       * @Method({"GET"})
       * @param $id
       * @return Response
       */
      public function listBy($id) {
          $customer = $this->getDoctrine()->getRepository(Customer::class)->find($id);
          $comandas = $this->getDoctrine()->getRepository(Comanda::class)->findBy(array('customer' => $customer));
          return $this->render('comanda/index.html.twig', array('comandas' => $comandas));

      }

      /**
       * @Route("/comanda/new", name="new_comanda")
       * Method({"GET", "POST"})
       * @param Request $request
       * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
       */
      public function new(Request $request) {
          $comanda = new Comanda();

          $form = $this->createFormBuilder($comanda)
              ->add('customer')
              ->add('product')
              ->add('comments')
              ->add('part')
              ->add('service')
              ->add('technician')
              ->add('workshop')
              ->add('save', SubmitType::class, array(
                  'label' => 'Crear',
                  'attr' => array('class' => 'btn btn-primary mt-3')
              ))
              ->getForm();

          $form->handleRequest($request);

          if($form->isSubmitted() && $form->isValid()) {
              $comanda = $form->getData();

              $entityManager = $this->getDoctrine()->getManager();
              $entityManager->persist($comanda);
              $entityManager->flush();

              return $this->redirectToRoute('comanda_list');
          }

          return $this->render('comanda/new.html.twig', array(
              'form' => $form->createView()
          ));
      }

      /**
       * @Route("/comanda/edit/{id}", name="edit_comanda")
       * Method({"GET", "POST"})
       * @param Request $request
       * @param $id
       * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
       */
      public function edit(Request $request, $id)
      {
          $comanda = new Comanda();
          $comanda = $this->getDoctrine()->getRepository(Comanda::class)->find($id);

          $form = $this->createFormBuilder($comanda)
              ->add('customer')
              ->add('product')
              ->add('comments')
              ->add('part')
              ->add('service')
              ->add('technician')
              ->add('workshop')
              ->add('save', SubmitType::class, array(
                  'label' => 'Update',
                  'attr' => array('class' => 'btn btn-primary mt-3')
              ))
              ->getForm();

          $form->handleRequest($request);

          if ($form->isSubmitted() && $form->isValid()) {

              $entityManager = $this->getDoctrine()->getManager();
              $entityManager->flush();

              return $this->redirectToRoute('comanda_list');
          }

          return $this->render('comanda/edit.html.twig', array(
              'form' => $form->createView()
          ));
      }

      /**
       * @Route("/comanda/{id}", name="comanda_show")
       */
      public function show($id) {
          $comanda = $this->getDoctrine()->getRepository(Comanda::class)->find($id);

          return $this->render('comanda/show.html.twig', array('comanda' => $comanda));
      }

      /**
       * @Route("/comanda/delete/{id}")
       * @Method({"DELETE"})
       */
      public function delete(Request $request, $id) {
          $comanda = $this->getDoctrine()->getRepository(Comanda::class)->find($id);

          $entityManager = $this->getDoctrine()->getManager();
          $entityManager->remove($comanda);
          $entityManager->flush();

          $response = new Response();
          $response->send();
      }

      /**
       * @Route("/comanda/done/{id}", name="get_things_done")
       * @param $id
       * @return Response
       */
      public function done($id) {
          $comanda = $this->getDoctrine()->getRepository(Comanda::class)->find($id);
          $comanda->setStatus(true);
          $this->getDoctrine()->getManager()->flush();
          return $this->redirectToRoute('comanda_show',array('id' => $id));
      }

  }