<?php

namespace App\Controller;

use App\Entity\BoardGame;
use App\Entity\User;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    #[Route('/profile/{id}', name: 'app_user_profile')]
    public function show(ManagerRegistry $doctrine, $id): Response
    {
        $userRepository = $doctrine->getRepository(User::class);
        $user = $userRepository->find($id);

        if (!$user) {
            throw $this->createNotFoundException("La page demandée est introuvable.");
        }

        return $this->render('user/profile.html.twig', [
            'user' => $user,
        ]);
    }

    #[Route('/collection/add/{gameId}', name: 'app_user_collection_add_game')]
    public function addToCollection(Request $request, ManagerRegistry $doctrine, $gameId): Response
    {
        /** @var User $user */
        $user = $this->getUser();

        $gameRepository = $doctrine->getRepository(BoardGame::class);
        $game = $gameRepository->find($gameId);

        if (!$user || !$game) {
            throw $this->createNotFoundException("La page demandée est introuvable.");
        } else {
            $user->addBoardGame($game);
            $entityManager = $doctrine->getManager();
            $entityManager->persist($user);
            $entityManager->flush();

            $this->addFlash('success', 'Votre jeu a été enregistré !');

            $referer = $request->headers->get('referer');
            return $this->redirect($referer);
        }

        return $this->render('user/profile.html.twig', [
            'user' => $user,
        ]);
    }
}
