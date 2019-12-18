<?php
/**
 * Created by PhpStorm.
 * User: khysh
 * Date: 12/09/2019
 * Time: 23:13
 */

namespace App\Controller;

use App\Entity\Trick;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use App\Repository\TrickRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class TrickController extends AbstractController
{
    private $trickRepository;

    public function __construct(TrickRepository $trickRepository)
    {
        $this->trickRepository = $trickRepository;

    }



    /**
     * @Route("/tricks", name="trick.list")
     * @return Response
     */
    public function index(): Response
    {
        return new Response('listing des tricks');
    }

    /**
     * @Route("/tricks/{slug}-{id}", name="trick.show", requirements={"slug": "[a-z0-9\-]*"})
     * @return Response
     */
    public function show(Trick $trick, string $slug): Response
    {

        // redirection vers le tricks en cas de modification du slug dans la barre d'url
        if($trick->getSlug() !== $slug) {
            return $this->redirectToRoute('trick.show',[
                'id'=> $trick->getId(),
                'slug'=> $trick->getSlug()
                ],301);
        }
        return $this->render('pages/trick/show.html.twig', [
                'trick' => $trick,
                'current_menu'=>'home',
            ]
        );
    }
}