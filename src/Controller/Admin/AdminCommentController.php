<?php
/**
 * Created by PhpStorm.
 * User: khysh
 * Date: 09/12/2019
 * Time: 00:16
 */

namespace App\Controller\Admin;

Use App\Entity\Comment;
use App\Form\CommentType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class AdminCommentController
 * @package App\Controller\Admin
 * @Route("/admin/comment")
 */
class AdminCommentController extends AbstractController
{
    /**
     * @Route("/create", name="comment_create")
     * @param Request $request
     * @return Response
     */
    public function create(Request $request): Response
    {
        $comment = new Comment();

        $form = $this->createForm(CommentTpe::class, $comment)->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->persist($comment);
            $this->getDoctrine()->getManager()->flush();
            return $this->redirectToRoute("comment_create");
        }

        return $this->render("admin/comment/create.html.twig", [
            "form" => $form->createView()
        ]);
    }

    /**
     * @Route("/{id}/update", name="comment_update")
     * @param Request $request
     * @return Response
     */
    public function update(Request $request, Comment $comment): Response
    {
        $form = $this->createForm(CommentTpe::class, $comment)->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute("index");
        }

        return $this->render("admin/comment/update.html.twig", [
            "form" => $form->createView()
        ]);
    }
}