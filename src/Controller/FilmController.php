<?php

namespace App\Controller;

use App\Entity\Film;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Component\Pager\PaginatorInterface;

/**
 * @Route("/films")
 * Class FilmController
 * @package App\Controller
 */
class FilmController extends AbstractController
{
    /**
     * @Route("", name="film")
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

    /**
     * @Route("/{id}", name="show_film")
     * @param Film $film
     * @return Response
     */
    public function show(Film $film): Response
    {
        return $this->render ('showfilm.html.twig', [
            'film'=>$film
        ]);
    }
}
