<?php
/**
 * Created by PhpStorm.
 * User: khysh
 * Date: 09/09/2019
 * Time: 00:09
 */

namespace App\Controller;

use App\Entity\Trick;
use App\Entity\User;
use App\Form\UserType;
use App\Repository\TrickRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
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
    public function index($page = 1): Response
    {
        //initialisation du repository demandé
        $tricks = $this->trickrepository->getAllTricks($page);
        $totalPostsReturned = $tricks->getIterator()->count();
        $totalPosts = $tricks->count();
        $iterator = $tricks->getIterator()  ;
        $limit = 5;
        $maxPages = ceil($tricks->count() / $limit);
        $thisPage = $page;
        // Pass through the 3 above variables to calculate pages in twig

        return $this->render('pages/home.html.twig', [
                'tricks' => $tricks,
                'current_menu'=>'home',
                'totat_posts'=>'$totalPosts',
                'iterator'=>'$iterator',
                'totalpostsreturned'=>'$totalPostsReturned',
                'max_page'=>'$maxPages',
                'current_page'=>'$thisPage',
            ]
        );
    }

    /**
     * @Route("/login", name="login")
     */
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        // retrouver une erreur d'authentification s'il y en a une
        $error = $authenticationUtils->getLastAuthenticationError();
        // retrouver le dernier identifiant de connexion utilisé
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('pages/login/form.html.twig', [
                'last_username' => $lastUsername,
                'error' => $error,
            ]
        );
    }

    /**
     * @Route("/logout", name="logout")
     */
    public function logout(): void
    {
        throw new \Exception('This should never be reached!');
    }

    /**
     * @Route("/create-account", name="createUser")
     * @param Request $request
     * @return Response
     */
    public function createUser(Request $request): Response
    {$user = new User();
        $form = $this->createForm(UserType::class,$user)->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->persist($user);
            $this->getDoctrine()->getManager()->flush();
            dump($user);
            //$this->sendMail($user);
            return $this->redirectToRoute("home");
        }
        return $this->render('pages/login/create_form.html.twig', [
            "form" => $form->createView()
        ]);
    }
}