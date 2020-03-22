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
use App\Handler\CommentHandler;
use App\Handler\TrickHandler;
use App\Repository\CommentRepository;
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

    public function __construct(TrickRepository $trickRepository, CommentRepository $commentRepository)
    {
        $this->trickRepository = $trickRepository;
        $this->commentRepository = $commentRepository;

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
    public function show(Trick $trick, Request $request,CommentHandler $handler): Response
    {

        $user = $this->getUser();
        $comment = new comment;
        $comment->setTrick($trick);
        $comment->setAuthor($user);
        $displayedComments = $this->commentRepository->getAllComments(1);

        if($handler->handle($request, $comment)) {
            $slug = $trick->getSlug();

            return $this->redirectToRoute("trick.show",array('slug' => $slug));
        }
        return $this->render('pages/trick/show.html.twig',[
                'trick' => $trick,
                'displayedComments' => $displayedComments,
                'current_menu'=>'home',
                "form" => $handler->createView()
            ]
        );
    }

    /**
     * @Route("/morecomments", name="morecomments")
     *
     * @param $page
     * @return Response
     */
    public function moreComments(Request $request): Response
    {
        $page = $request->query->getInt("page");
        $displayedcomments = $this->commentRepository->getAllComments($page);
        $limit = 5;

        return $this->render('parts/forcomments.html.twig', [
                'displayedcomments' => $displayedcomments,
            ]
        );
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
     * @param TrickHandler $handler
     * @return Response
     */
    public function create(Request $request,TrickHandler $handler): Response
    {
        if($handler->handle($request, new Trick(), ["validation_groups" => ["Default", "add"]        ]
        )) {
            return $this->redirectToRoute("trick_create");
        }
        return $this->render("admin/trick/create.html.twig", [
            "form" => $handler->createView()
        ]);
    }

    /**
     * @Route("/{id}/update", name="trick_update")
     * @param Request $request
     * @param Trick $trick
     * @param TrickHandler $handler
     * @return Response
     */
    public function update(Request $request, Trick $trick,TrickHandler $handler): Response
    {
        if($handler->handle($request, $trick)) {
            return $this->redirectToRoute("trick_update",array('id' => $trick->getId()));
        }
        return $this->render("admin/trick/update.html.twig", [
            "form" => $handler->createView()
        ]);
    }
}