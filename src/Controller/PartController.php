<?php
/**
 * Created by PhpStorm.
 * User: PMONTP19
 * Date: 14/06/2018
 * Time: 11:28
 */

namespace App\Controller;
use App\Entity\Part;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;


class PartController extends Controller
{
    /**
     * @Route("/parts", name="parts_list")
     * @Method({"GET"})
     */
    public function index() {
        $parts = $this->getDoctrine()->getRepository(Part::class)->findAll();
        return $this->render('part/index.html.twig', array('parts'=> $parts));
    }
}