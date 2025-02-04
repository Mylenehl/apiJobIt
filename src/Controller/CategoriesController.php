<?php

namespace App\Controller;

use App\Entity\Categories;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CategoriesController extends AbstractController
{
    /**
     * @Route("/categories", name="categories")
     */
    public function index(EntityManagerInterface $em): Response
    {
        $repo = $em->getRepository(Categories::class);
        $catego = $repo->findAll();

        return $this->render('categories/index.html.twig', ['categories' => $catego]);
    }
}