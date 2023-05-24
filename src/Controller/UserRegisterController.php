<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;



class UserRegisterController extends AbstractController
{
    #[Route('/user', name: 'app_user')]
    public function index(): Response{
        return $this->render('user/index.html.twig', [
            'controller_name' => 'UserController',
        ]);
    }

    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager){
        $this->entityManager = $entityManager;
    }

    #[Route('/api/v1/users/register', name: 'register', methods: ['POST'])]
    public function register(Request $request, ValidatorInterface $validator, MailerInterface $mailer ): Response{
        // Get POST data
        $username = $request->request->get('username');
        $email = $request->request->get('email');
        $password = $request->request->get('password');
        $acceptTerms = $request->request->get('acceptTerms');

        // Data validation
        $validator->validate([
            $username => 'required|max:255',
            $email => 'required|max:255',
            $password => 'required|max:255',
        ]);

        // ckeck null data
        if (!$username || !$email || !$password) {
            return new JsonResponse(['error' => 'Toutes les données sont requises.'], 400);
        }

        // Check acceptTerms
        if (!$acceptTerms) {
            return new JsonResponse(['errorTerms' => 'Vous devez accepter les conditions générales d\'utilisation.'], 400);
        }

        // Check if email is already used
        $existUserMail = $this->entityManager->getRepository(User::class)->findOneBy(['email' => $email]);
        if ($existUserMail) {
            return new JsonResponse(['errorMail' => 'Email déjà utilisée, utilisez en une autre.'], 400);
        }

        // Check if username is already used
        $existUsername = $this->entityManager->getRepository(User::class)->findOneBy(['username' => $username]);
        if ($existUsername) {
            return new JsonResponse(['errorUsername' => 'Pseudo déjà utilisé, utilisez en un autre.'], 400);
        }

        // Password hash 
        $hashPassword = password_hash($password, PASSWORD_DEFAULT);

        // Create new user
        $user = new User();
        $user->setUsername($username);
        $user->setEmail($email);
        $user->setPassword($hashPassword);
        $user->setCreatedAt(new \DateTimeImmutable());
        $user->setLastActivity(new \DateTimeImmutable());
        $user->setRole('membre');

        $this->entityManager->persist($user);
        $this->entityManager->flush();

        // Send confirmation email to user
        $email = (new TemplatedEmail())
        ->from('equipe-cinescope@outlook.fr')
        ->to($user->getEmail())
        ->subject('Confirmation d\'inscription')
        ->htmlTemplate('emails/confirmation.html.twig')
        ->context([
            'user' => $user,
        ]);
    
        $mailer->send($email);

        return new Response(json_encode(['message' => 'User created']), 201);

    }
}
