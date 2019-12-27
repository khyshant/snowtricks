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
use Symfony\Component\HttpFoundation\Request;
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
     * @Route("/trick/{slug}", name="trick.show", requirements={"slug": "[a-z0-9\-]*"})
     * @return Response
     */
    public function show(Trick $trick, string $slug): Response
    {

        // redirection vers le tricks en cas de modification du slug dans la barre d'url
        if($trick->getSlug() !== $slug) {
            return $this->redirectToRoute('trick.show',[
                'slug'=> $trick->getSlug()
                ],301);
        }
        return $this->render('pages/trick/show.html.twig', [
                'trick' => $trick,
                'current_menu'=>'home',
            ]
        );
    }
    /**
     * @Route("/trick/create", name="trick_create")
     * @param Request $request
     * @return Response
     */
    public function create(Request $request): Response
    {
        $trick = new Trick();

        $form = $this->createForm(TrickType::class, $trick, [
            "validation_groups" => ["Default", "add"]
        ])->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->persist($trick);
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute("trick_create");
        }

        return $this->render("admin/trick/create.html.twig", [
            "form" => $form->createView()
        ]);
    }
    /**
     * @Route("/{id}/update", name="trick_update")
     * @param Request $request
     * @return Response
     */
    public function update(Request $request, Trick $trick): Response
    {
        $form = $this->createForm(TrickType::class, $trick)->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            $id = $trick->getId();
            return $this->redirectToRoute("trick_update",array('id' => $id));
        }

        return $this->render("admin/trick/update.html.twig", [
            "form" => $form->createView()
        ]);
    }
}