<?php

namespace App\Controller;
use App\Entity\Jobs;
use App\Entity\Categories;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class FormuController extends AbstractController
{
    /**
     * @Route("/formu", name="formu")
     */
    public function index(): Response
    {
        return $this->render('formu/index.html.twig', [
            'controller_name' => 'FormuController',
        ]);
    }
    /**
     * @Route("/formu", name="formu", methods={"GET","POST"})
     */
    public function createformu(Request $request, EntityManagerInterface $em): Response
    {   
        $form = $this->createFormBuilder()
            ->add('category_id', EntityType::class,[
                'class' => Categories::class,
                'label' => 'Catégorie',
                'placeholder' => '-- Choisir une catégorie --',
                'choice_label' => function($cat){
                    return $cat-> getNom();
                } ])
            ->add('contrat', TextType::class, ['label'=> 'Nom du Job : '])
            ->add('entreprise', TextType::class, ['label'=> 'Entreprise : '])
            ->add('logo', TextType::class, ['label'=> 'Logo : '])
            ->add('url', TextType::class, ['label'=> 'URL : '])
            ->add('lieu', TextType::class, ['label'=> 'Ville : '])
            ->add('pays', TextType::class, ['label'=> 'Pays : '])
            ->add('email', TextType::class, ['label'=> 'Email : '])
            ->add('description', TextType::class, ['label'=> 'Description : '])
            ->add('Ajouter', SubmitType::class)
            ->getForm();
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form ->isValid()){
            $data =$form->getData();

            $jobs = new Jobs;
            $jobs->setCategory($data['category_id']);
            $jobs->setContrat($data['contrat']);
            $jobs->setEntreprise($data['entreprise']);
            $jobs->setLogo($data['logo']);
            $jobs->setUrl($data['url']);
            $jobs->setLieu($data['lieu']);
            $jobs->setPays($data['pays']);
            $jobs->setLieu($data['lieu']);
            $jobs->setEmail($data['email']);
            $jobs->setDescription($data['description']);
           

            $em->persist($jobs);
            $em->flush($jobs);

            return $this ->redirectToRoute('home');
        }
        
        return $this->render('formu/index.html.twig', ['formjobs'=>$form->createView()]);
    }
}
