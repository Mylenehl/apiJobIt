<?php

namespace App\Controller;
use App\Entity\Jobs;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    /*public function index(): Response
    {
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }*/

    /**
     * @Route("/", name="home")
     */
    public function index(EntityManagerInterface $em): Response
    {
        $repo = $em->getRepository(Jobs::class);

        $jobs = $repo->findBy([], ['id'=>'DESC'], 10);
        
        return $this->render('home/index.html.twig', ['jobs' => $jobs]);
    }
}
