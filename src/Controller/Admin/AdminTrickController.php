<?php
/**
 * Created by PhpStorm.
 * User: khysh
 * Date: 09/12/2019
 * Time: 00:16
 */

namespace App\Controller\Admin;

Use App\Entity\Trick;
use App\Form\TrickType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class AdminTrickController
 * @package App\Controller\Admin
 * @Route("/admin/trick")
 */
class AdminTrickController extends AbstractController
{
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

            return $this->redirectToRoute("index");
        }

        return $this->render("admin/trick/update.html.twig", [
            "form" => $form->createView()
        ]);
    }
}