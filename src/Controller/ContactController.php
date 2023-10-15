<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpKernel\Attribute\ValueResolver;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Contact;

class ContactController extends AbstractController
{
    #[Route('/contact', name: 'app_contact')]
    public function index(Request $request, EntityManagerInterface $em): Response
    {
        $firstname= $request-> get('firstname');
        $lastname= $request-> get('lastname');
        $subject= $request-> get('subject');
        $contact = new Contact();
        $contact-> setFirstName($firstname);
        $contact-> setLastName($lastname);
        $contact-> setSubject($subject);
        $em-> persist($contact);
        $em-> flush();

        if($request -> getMethod()==='POST'){
            if($request -> get('firstname'==='')){
                $this ->addFlash('error','votre page est ca');
            }
            else{
                $contact = 
                ['firstname'=>$request ->get('firstname'),
                'subject' =>$request ->get('subject')
            ];
            $this->addFlash('sucess','votre message a été envoyer avec sucess');
        }
        }
        return $this->render('contact/index.html.twig', [
           
        ]);
    }
    #[Route('/admin/contact', name:'admin-contact')]
    public function listing(ContactRespository $cR)
    {
        $contacts=$cR->findAll();
        return $this->render('admin/contact/index.html.twig',
        ['contacts'=>$contacts]);
    }
}
