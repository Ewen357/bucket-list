<?php

namespace App\Controller;

use App\Repository\WishRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
#[Route('/wish', name: 'wish_')]
class WishController extends AbstractController
{
    #[Route('/list', name: 'list', methods: "GET")]
    public function list(WishRepository $wishRepository): Response
    {
       $wish = $wishRepository ->findBY(['isPublished'=>'true'],['dateCreated'=>'DESC']);

       dump($wish);

        return $this->render('wish/list.html.twig',['wish'=>$wish]);
    }
    #[Route('/{id}', name: 'show', requirements: ['id '=> '\d+'])]
    public function show(int $id,WishRepository $wishRepository): Response
    {
        $wish = $wishRepository->find($id);
        if (!$wish){
            throw $this ->createNotFoundException('wish not found');
        }

        return $this->render('wish/show.html.twig',['wish'=>$wish]);
    }

}