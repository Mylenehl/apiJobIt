<?php

namespace App\Controller;
use App\Entity\Jobs;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class JobsingleController extends AbstractController
{
    /**
     * @Route("/jobsingle", name="jobsingle")
     */
    public function index(): Response
    {
        return $this->render('jobsingle/index.html.twig', [
            'controller_name' => 'JobsingleController',
        ]);
    }
    /**
     * @Route("/jobsingle", name="jobsingle")
     */
    public function jobsingle(EntityManagerInterface $em): Response
    {
        $repo = $em->getRepository(Jobs::class);
        $jobcible = $repo->find($_GET['id']);

        return $this->render('jobsingle\index.html.twig', ['jobcibl' => $jobcible]);//jobcibl renvoi au fichier twig /jobcible est la variable
    }
}