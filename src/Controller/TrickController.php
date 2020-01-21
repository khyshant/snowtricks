<?php
/**
 * Created by PhpStorm.
 * User: khysh
 * Date: 12/09/2019
 * Time: 23:13
 */

namespace App\Controller;

use App\Entity\Comment;
use App\Entity\Trick;
use App\Form\CommentType;
use App\Form\TrickType;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use App\Repository\TrickRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class TrickController extends AbstractController
{
    private $trickRepository;

    public function __construct(TrickRepository $trickRepository)
    {
        $this->trickRepository = $trickRepository;

    }

    /**
     * @Route("/trick", name="trick.list")
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
    public function show(Trick $trick, Request $request): Response
    {
        $comment = new Comment();
        $form = $this->createForm(CommentType::class, $comment)->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            $slug = $trick->getSlug();
            return $this->redirectToRoute("trick.show",array('slug' => $slug));
        }

        return $this->render('pages/trick/show.html.twig', [
            'trick' => $trick,
            'current_menu'=>'home',
            "form" => $form->createView()
        ]);
    }

    /**
     * @Route("/delete/{slug}", name="trick.delete", requirements={"slug": "[a-z0-9\-]*"})
     * @return Response
     */
    public function delete( Trick $trick): Response
    {
        $this->getDoctrine()->getManager()->remove($trick);
        $this->getDoctrine()->getManager()->flush();
        return $this->redirectToRoute('home');
    }

    /**
     * @Route("/create", name="trick_create")
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