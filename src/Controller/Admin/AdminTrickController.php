<?php
/**
 * Created by PhpStorm.
 * User: khysh
 * Date: 09/12/2019
 * Time: 00:16
 */

namespace App\Controller\Admin;


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

        $trick = $this->createForm(PostType::class, $trick, [
            "validation_groups" => ["Default", "add"]
        ])->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->persist($trick);
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute("index");
        }

        return $this->render("admin/create.html.twig", [
            "form" => $form->createView()
        ]);
    }
}