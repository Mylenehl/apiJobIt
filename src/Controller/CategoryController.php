<?php

namespace App\Controller;
use App\Entity\Jobs;
use App\Entity\Categories;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CategoryController extends AbstractController
{
    /**
     * @Route("/category", name="category")
     */

    public function jobdecateg (EntityManagerInterface $em): Response
    {
        $repo2 = $em->getRepository(Categories::class);
        $jobdecat = $repo2->jointure($_GET['id']);

        return $this->render('category/index.html.twig',['jobdecat'=>$jobdecat]);
    }
}