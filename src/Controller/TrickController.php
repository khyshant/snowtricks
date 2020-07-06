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
use App\Handler\CommentHandler;
use App\Handler\TrickHandler;
use App\Repository\CommentRepository;
use App\Security\voter\TrickVoter;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use App\Repository\TrickRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class TrickController extends AbstractController
{

    /**
     * @var string
     */
    private $uploadDirAbsolutePath;
    /**
     * @var TrickRepository
     */
    private $trickRepository;
    /**
     * @var CommentRepository
     */
    private $commentRepository;

    /**
     * TrickController constructor.
     * @param TrickRepository $trickRepository
     * @param CommentRepository $commentRepository
     * @param string $uploadDirAbsolutePath
     */
    public function __construct(TrickRepository $trickRepository, CommentRepository $commentRepository,string $uploadDirAbsolutePath)
    {
        $this->trickRepository = $trickRepository;
        $this->commentRepository = $commentRepository;
        $this->uploadDirAbsolutePath = $uploadDirAbsolutePath;
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
     * @param Trick $trick
     * @param Request $request
     * @param CommentHandler $handler
     * @return Response
     */
    public function show(Trick $trick, Request $request,CommentHandler $handler): Response
    {
        $user = $this->getUser();
        $comment = new Comment();
        $comment->setTrick($trick);
        $comment->setAuthor($user);
        $displayedComments = $this->commentRepository->getCommentsByTrick($trick,1);

        if($handler->handle($request, $comment)) {
            $slug = $trick->getSlug();

            return $this->redirectToRoute("trick.show",array('slug' => $slug));
        }
        return $this->render('pages/trick/show.html.twig',[
                'trick' => $trick,
                'displayedComments' => $displayedComments,
                'uploadDirAbsolutePath' => $this->uploadDirAbsolutePath,
                'current_menu'=>'home',
                "form" => $handler->createView()
            ]
        );
    }

    /**
     * @Route("/morecomments", name="morecomments")
     *
     * @param Request $request
     * @return Response
     */
    public function moreComments(Request $request): Response
    {
        $page = $request->query->getInt("page");
        $trick_id = $request->query->getInt("trick");
        $trick = $this->trickRepository->find($trick_id);
        $displayedComments = $this->commentRepository->getCommentsByTrick($trick,$page);

        return $this->render('parts/forcomments.html.twig', [
                'displayedcomments' => $displayedComments,
            ]
        );
    }

    /**
     * @Route("/delete/{slug}", name="trick.delete", requirements={"slug": "[a-z0-9\-]*"})
     * @param Trick $trick
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
        $this->denyAccessUnlessGranted(TrickVoter::EDIT, $trick);
        if($handler->handle($request, $trick)) {
            return $this->redirectToRoute("trick_update",array('id' => $trick->getId()));
        }
        return $this->render("admin/trick/update.html.twig", [
            "form" => $handler->createView()
        ]);
    }
}