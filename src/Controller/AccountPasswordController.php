<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\ChangePasswordType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AccountPasswordController extends AbstractController
{
    private $em;
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->em = $entityManager;
    }
    /**
     * @Route("/compte/mot-de-passe", name="account_password")
     */
    public function index(Request $request,  UserPasswordEncoderInterface $encoder): Response
    {
       $notification = null;
         $user = $this->getUser();
     
        $form = $this->createForm(ChangePasswordType::class, $user);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $old_pwd = $form->get('old_pwd')->getData();
            if($encoder->isPasswordValid($user,$old_pwd))
            {
                $new_pwd = $form->get('new_pwd')->getData();
                $password = $encoder->encodePassword($user,$new_pwd);
                $user->setPassword($password);
                $this->em->persist($user);
                $this->em->flush();
                $notification = " Mot de passe mis à jour avec succès.";
            }
            else{
                $notification = "Votre mot de passe renseigné n'est pas le bon.";
            }
        }

        return $this->render('account/password.html.twig', [
            'form' =>$form->createView(),
            'notification' =>$notification
        ]);
    }
}