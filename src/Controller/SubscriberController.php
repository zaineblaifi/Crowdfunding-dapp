<?php

namespace App\Controller;

use App\Entity\Subscribers;
use App\Form\SubscriberType;
use App\Repository\SubscribersRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
//use Symfony\Component\BrowserKit\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
#[Route('/subscriber')]
class SubscriberController extends AbstractController
{
    
    

    #[Route('/', name: 'app_subscriber_index', methods: ['GET'])]
    public function index(SubscribersRepository $subscriberRepository): Response
    {
        return $this->render('subscriber/index.html.twig', [
            'subscribers' => $subscriberRepository->findAll(),
        ]);
    }
    #[Route('/show', name: 'app_show_index')]
    public function show(Request $request, EntityManagerInterface $entityManager): Response
    {
        $subscriber= new Subscribers();
        $form= $this->createForm(SubscriberType::class, $subscriber);
        $form->handleRequest($request);
        $agreeTerms= $form->get('agreeTerms')->getData();
        if($form->isSubmitted() && $form->isValid() && $agreeTerms){
            
            $entityManager->persist($subscriber);
            $entityManager->flush();
            return new Response('Subscriber number'.$subscriber->getId().' created..');
            
        }
        return $this->render('subscriber/index.html.twig', [
            'subscriber_form' => $form->createView(),
        ]);
    }
}
