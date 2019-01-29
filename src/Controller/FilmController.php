<?php

namespace App\Controller;

use App\Entity\Film;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Component\Pager\PaginatorInterface;

class FilmController extends AbstractController
{
    /**
     * @Route("/film", name="film")
     */
    public function index(Request $request,PaginatorInterface $paginator): Response
    {
        $em=$this->getDoctrine()->getManager()->getRepository(Film::class);
        $films=$em->findAll();

        $results=$paginator->paginate(
            $films,
            $request->query->getInt ('page', 1),
            $this->getParameter('limitPaginator')
        );

        return $this->render('film/index.html.twig', [
            'films' => $results,
        ]);
    }
}
