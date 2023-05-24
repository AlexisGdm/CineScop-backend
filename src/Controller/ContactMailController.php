<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class ContactMailController extends AbstractController{
    #[Route('/api/v1/users/mail/templates', name: 'app_contact_mail')]
    public function index(): Response{
        return $this->render('contact_mail/index.html.twig', [
            'controller_name' => 'ContactMailController',
        ]);
    }

    #[Route('/api/v1/users/mail', name: 'contact_mail', methods: ['POST'])]
    public function ContactMail(Request $request, MailerInterface $mailer, ValidatorInterface $validator ): Response{
        // Get POST data
        $username = $request->request->get('username');
        $email = $request->request->get('email');
        $subject = $request->request->get('subject');
        $message = $request->request->get('message');

        // Data validation
        $validator->validate([
            $username => 'max:255',
            $email => 'required|max:255',
            $subject => 'required|max:255',
            $message => 'required|max:255',
        ]);

        // Ckeck null data
        if (!$email || !$subject || !$message) {
            return new JsonResponse(['error' => 'Toutes les données sont requises.'], 400);
        }
        
        // Send email
        $email = (new Email())
        ->from('equipe-cinescope@outlook.fr')
        ->to('equipe-cinescope@outlook.fr')
        ->subject($subject)
        ->html("<p><strong>Pseudo:</strong> $username</p><p><strong>Email:</strong> $email</p><p><strong>Message:</strong> $message</p>");
        $mailer->send($email);

        return new Response(json_encode(['message' => 'Message sent']), 201);

    }

}
