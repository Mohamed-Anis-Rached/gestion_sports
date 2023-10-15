<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Singup;
use Symfony\Component\HttpFoundation\File\Exception\FileException;



class SingupController extends AbstractController
{
    #[Route('/singup', name: 'app_singup')]
    public function index(Request $request, EntityManagerInterface $em): Response
    {
        /*$firstname= $request-> get('first-name');
        $lastname= $request-> get('last-name');
        $email= $request-> get('email');
        $pwd= $request-> get('password');

        $brochureFile= $request-> get('photo');
        $singup = new Singup();

        if ($brochureFile) {
            $originalFilename = pathinfo($brochureFile->getClientOriginalName(), PATHINFO_FILENAME);
            $safeFilename = $slugger->slug($originalFilename);
            $newFilename = $safeFilename.'-'.uniqid().'.'.$brochureFile->guessExtension();

            try {
                $brochureFile->move(
                    $this->getParameter('photo_directory'),
                    $newFilename
                );
            } catch (FileException $e) {

            }

            $singup ->setPhoto($newFilename);
        }

        $singup-> setFirstname($firstname);
        $singup-> setLastname($lastname);
        $singup-> setEmail($email);
        $singup-> setPassword($pwd);
       
        $em-> persist($singup);
        $em-> flush();
        
        if($request -> getMethod()==='POST'){
            if($request -> get('first-name'==='')){
                $this ->addFlash('error','votre page est ca');
            }
            else{
                $contact = 
                ['firstname'=>$request ->get('first-name'),
                'email' =>$request ->get('email')
            ];
            $this->addFlash('sucess','votre message a été envoyer avec sucess');
        }
        }
*/

        $firstname = $request->get('first-name');
        $lastname = $request->get('last-name');
        $email = $request->get('email');
        $pwd = $request->get('password');

        $photoFile = $request->files->get('photo');

        $singup = new Singup();
        $singup->setFirstname($firstname);
        $singup->setLastname($lastname);
        $singup->setEmail($email);
        $singup->setPassword($pwd);

        if ($photoFile instanceof UploadedFile) {
            $newFilename = uniqid().'.'.$photoFile->guessExtension();

            try {
                $photoFile->move(
                    $this->getParameter('photo_directory'),
                    $newFilename
                );
            } catch (FileException $e) {

            }

            $singup->setPhoto($newFilename);
        }
        
        if($request->getMethod() === "POST"){
            $em->persist($singup);
            $em->flush();
        }



        return $this->render('singup/index.html.twig', [
            'controller_name' => 'SingupController',
        ]);
    }
}
