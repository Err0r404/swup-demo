<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Address;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{
    /**
     * @Route("/contact", name="contact")
     */
    public function contact(Request $request, MailerInterface $mailer): Response
    {
        $contact = (new Contact())
            ->setName('John Doe')
            ->setEmail('john.doe@anonymous.com')
            ->setMessage('Lorem ipsum');
        
        $form = $this->createForm(ContactType::class, $contact, ['attr' => ['data-swup-form' => true]]);
        $form->handleRequest($request);
        
        $emailSent = null;
        if ($form->isSubmitted() && $form->isValid()) {
    
            $email = (new TemplatedEmail())
                ->from(new Address($contact->getEmail(), $contact->getName()))
                ->to(new Address('contact@swup-demo.com', 'Contact'))
                ->subject('Contact')
                ->htmlTemplate('_emails/contact.html.twig')
                ->context([
                    'contact' => $contact,
                ])
            ;
    
            try {
                $mailer->send($email);
                $emailSent = true;
            }
            catch (TransportExceptionInterface $e) {
                $emailSent = false;
            }
        }
        
        return $this->render(
            'contact/index.html.twig',
            [
                'form' => $form->createView(),
                'emailSent' => $emailSent,
            ]
        );
    }
}
