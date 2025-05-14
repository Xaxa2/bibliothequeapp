<?php

namespace App\Controller;

use App\Form\LoginFormType;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

use function PHPUnit\Framework\throwException;

final class SecurityController extends AbstractController
{
    #[Route('/logout', name: 'app_logout')]
    public function index(): Response
    {
       throw new Exception('Vous êtes déconnecté');
    }
    

    #[Route('/login', name: 'app_login')]
    public function login(AuthenticationUtils $authenticationUtils): Response
    {

        $form = $this->createForm(LoginFormType::class);

        return $this->render('security/login.html.twig', [
            'username' => $authenticationUtils->getLastUsername(),
            'form' => $form,
        ]);
    }
}
