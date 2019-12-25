<?php
/**
 * Created by PhpStorm.
 * User: khysh
 * Date: 09/09/2019
 * Time: 00:09
 */

namespace App\Controller;

use App\Entity\Trick;
use App\Repository\TrickRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;


/**
 * @property TrickRepository trickrepository
 */
class HomeController extends AbstractController
{

    public function __construct(TrickRepository $trickRepository)
    {
        $this->trickrepository = $trickRepository;
    }

    /**
     * @Route("/", name="home")
     * @return Response
     */
    public function index(): Response
    {
        //initialisation du repository demandé
        $tricks = $this->trickrepository->findAll();

        return $this->render('pages/home.html.twig', [
                'tricks' => $tricks,
                'current_menu'=>'home',
            ]
        );
    }
}