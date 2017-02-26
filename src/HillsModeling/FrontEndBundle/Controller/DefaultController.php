<?php

namespace HillsModeling\FrontEndBundle\Controller;

use FOS\UserBundle\Model\UserInterface;
use HillsModeling\FrontEndBundle\Entity\Admin;
use HillsModeling\FrontEndBundle\Entity\Attributs;
use HillsModeling\FrontEndBundle\Entity\Membre;
use HillsModeling\FrontEndBundle\Entity\Projet;
use HillsModeling\FrontEndBundle\Entity\Shemas;
use HillsModeling\FrontEndBundle\Form\AdminType;
use HillsModeling\FrontEndBundle\Form\MembreType;
use HillsModeling\FrontEndBundle\Form\ProfessionnelType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Acl\Exception\Exception;
use Symfony\Component\Security\Core\SecurityContext;

class DefaultController extends Controller
{

    public function sendMailConfirmationAction($email_des,$token,$name)
    {

        $message = \Swift_Message::newInstance()
            ->setSubject('HillsModeling : Veuillez confirmer votre adresse électronique')
            ->setFrom('site@gmail.com')
            ->setTo($email_des)
            ->setBody(
                $this->renderView(
                    '@HillsModelingFrontEnd/Emails/registration.html.twig',
                    array('name' => $name,
                        'token' => $token)
                ),
                'text/html'
            );
        $this->get('mailer')->send($message);



    }

    public function MailConfirmationAction($token)
    {

      $user = $this->get('fos_user.user_manager')->findUserByConfirmationToken($token); //Verification d'email si exist

        if($user)
        {

            $user->setEnabled(true);
            $user->setConfirmationToken(null);
            $userManager = $this->container->get('fos_user.user_manager');
            $userManager->updateUser($user, true);
            $route = 'HillsModeling_front_end_homepage';
            $this->addFlash(
                'message',
                'votre compte à éte bien céer!'
            );
            $url = $this->container->get('router')->generate($route);
            $response = new RedirectResponse($url);
            $this->authenticateUser($user, $response);
            return $response;
        }else
        {
            $erreur="Le code d'activation n'est pas reconnu";
            return $this->render('@HillsModelingFrontEnd/Default/login.html.twig', [
                'erreur' => $erreur
            ]);
        }





    }

    public function AdminAction(Request $request)
    {

        if($this->container->get('security.context')->isGranted('IS_AUTHENTICATED_FULLY') ){
            return $this->redirect($this->generateUrl('HillsModeling_front_end_Membre'));
        }
        $utilisateur = "Admin" ;
        // login *******************************************************
        /* @var $request \Symfony\Component\HttpFoundation\Request */
        $session = $request->getSession();
        /* @var $session \Symfony\Component\HttpFoundation\Session\Session */
        // get the error if any (works with forward and redirect -- see below)
        if ($request->attributes->has(SecurityContext::AUTHENTICATION_ERROR)) {
            $error = $request->attributes->get(SecurityContext::AUTHENTICATION_ERROR);
        } elseif (null !== $session && $session->has(SecurityContext::AUTHENTICATION_ERROR)) {
            $error = $session->get(SecurityContext::AUTHENTICATION_ERROR);
            $session->remove(SecurityContext::AUTHENTICATION_ERROR);
        } else {
            $error = '';
        }
        if ($error) {
            // TODO: this is a potential security risk (see http://trac.symfony-project.org/ticket/9523)
            $error = $error->getMessage();
        }
        // last username entered by the user
        $lastUsername = (null === $session) ? '' : $session->get(SecurityContext::LAST_USERNAME);

        $csrfToken = $this->container->get('form.csrf_provider')->generateCsrfToken('authenticate');

        // inscription *******************************************************************************

        $em = $this->getDoctrine()->getEntityManager();
        $Admin = new Admin();
        $form = $this->createForm(new AdminType(), $Admin);
        $form->handleRequest($request);
        $user = $this->get('fos_user.user_manager')->findUserByEmail($Admin->getEmail()); //Verification d'email si exist
        if (null==$user) {
            if ($form->isValid()) {
                $Admin->addRole('ROLE_Admin');
                $Admin->setEnabled(true);
                $em->persist($Admin);
                $em->flush();
                $msg_email="Un email d'activation vous a été envoyé";
                return $this->render('@HillsModelingFrontEnd/Default/login.html.twig', [
                    'erreur' => "sdfghjklmlkjhgf"
                ]);
            }

        }else
                    {
            $js = '<script  type="text/javascript">'.
                'function tab(){'.
                '$(\'#inscrire-nav\').addClass(\'active\').siblings().removeClass(\'active\');'.
                '$(\'#inscrire\').addClass(\'active\').siblings().removeClass(\'active\');'.
                '}'.
                'window.onload = tab;'.
                '</script>';

            $msg_erreur="Cette adresse email est déjà utilisée !";
            return $this->render('@HillsModelingFrontEnd/Default/login_register.html.twig', [
                'form' => $form->createView(),
                'last_username' => $lastUsername,
                'error' => $error,
                'csrf_token' => $csrfToken,
                'utilisateur' => $utilisateur,
                'js'=>$js,
                'msg_erreur'=>$msg_erreur,
            ]);


        }
        $string = (string) $form->getErrors(true, false);
        if($string)
        { $js = '<script  type="text/javascript">'.
            'function tab(){'.
            '$(\'#inscrire-nav\').addClass(\'active\').siblings().removeClass(\'active\');'.
            '$(\'#inscrire\').addClass(\'active\').siblings().removeClass(\'active\');'.
            '}'.
            'window.onload = tab;'.
            '</script>';

            return $this->render('@HillsModelingFrontEnd/Default/login_register.html.twig', [
                'form' => $form->createView(),
                'last_username' => $lastUsername,
                'error' => $error,
                'csrf_token' => $csrfToken,
                'utilisateur' => $utilisateur,
                'js'=>$js,
            ]);
        }
        return $this->render('@HillsModelingFrontEnd/Default/login_register.html.twig', [
            'form' => $form->createView(),
            'last_username' => $lastUsername,
            'error' => $error,
            'csrf_token' => $csrfToken,
            'utilisateur' => $utilisateur,
        ]);

    }

    public function MembreAction(Request $request)
    {

        if($this->container->get('security.context')->isGranted('IS_AUTHENTICATED_FULLY') ){
            return $this->redirect($this->generateUrl('HillsModeling_front_end_Membre'));
        }
        // login *******************************************************
        $utilisateur = "Membre" ;
        /* @var $request \Symfony\Component\HttpFoundation\Request */
        $session = $request->getSession();
        /* @var $session \Symfony\Component\HttpFoundation\Session\Session */

        // get the error if any (works with forward and redirect -- see below)
        if ($request->attributes->has(SecurityContext::AUTHENTICATION_ERROR)) {
            $error = $request->attributes->get(SecurityContext::AUTHENTICATION_ERROR);
        } elseif (null !== $session && $session->has(SecurityContext::AUTHENTICATION_ERROR)) {
            $error = $session->get(SecurityContext::AUTHENTICATION_ERROR);
            $session->remove(SecurityContext::AUTHENTICATION_ERROR);
        } else {
            $error = '';
        }

        if ($error) {
            $error = $error->getMessage();
        }
        // last username entered by the user
        $lastUsername = (null === $session) ? '' : $session->get(SecurityContext::LAST_USERNAME);

        $csrfToken = $this->container->get('form.csrf_provider')->generateCsrfToken('authenticate');

        // inscription *******************************************************************************

        $em = $this->getDoctrine()->getEntityManager();
        $Membre = new Membre();
        $form = $this->createForm(new MembreType(), $Membre);
        $form->handleRequest($request);
        $user = $this->get('fos_user.user_manager')->findUserByEmail($Membre->getEmail()); //Verification d'email si exist
        if (null==$user) {
            if ($form->isValid()) {
                $Membre->addRole('ROLE_Membre');
                $Membre->setEnabled(false);
                $cle = md5(microtime(TRUE)*100000);
                $Membre->setConfirmationToken($cle);
                $em->persist($Membre);
                $em->flush();

                $this->sendMailConfirmationAction($Membre->getEmail(),$cle,$Membre->getPrenom());

                $msg_email="Un email d'activation vous a été envoyé. Consultez votre boîte mail pour activer votre espace ";
                return $this->render('@HillsModelingFrontEnd/Default/login.html.twig', [
                    'msg_email' => $msg_email
                ]);

            }
        }else
        {
             $js = '<script  type="text/javascript">'.
                'function tab(){'.
                '$(\'#inscrire-nav\').addClass(\'active\').siblings().removeClass(\'active\');'.
                '$(\'#inscrire\').addClass(\'active\').siblings().removeClass(\'active\');'.
                '}'.
                'window.onload = tab;'.
                '</script>';

                $msg_erreur="Cette adresse email est déjà utilisée !";
                return $this->render('@HillsModelingFrontEnd/Default/login_register.html.twig', [
                    'form' => $form->createView(),
                    'last_username' => $lastUsername,
                    'error' => $error,
                    'csrf_token' => $csrfToken,
                    'utilisateur' => $utilisateur,
                    'js'=>$js,
                    'msg_erreur'=>$msg_erreur,
                ]);


        }
        $string = (string) $form->getErrors(true, false);
        if($string)
        { $js = '<script  type="text/javascript">'.
            'function tab(){'.
            '$(\'#inscrire-nav\').addClass(\'active\').siblings().removeClass(\'active\');'.
            '$(\'#inscrire\').addClass(\'active\').siblings().removeClass(\'active\');'.
            '}'.
            'window.onload = tab;'.
            '</script>';

            return $this->render('@HillsModelingFrontEnd/Default/login_register.html.twig', [
                'form' => $form->createView(),
                'last_username' => $lastUsername,
                'error' => $error,
                'csrf_token' => $csrfToken,
                'utilisateur' => $utilisateur,
                'js'=>$js,
            ]);
        }
        return $this->render('@HillsModelingFrontEnd/Default/login_register.html.twig', [
            'form' => $form->createView(),
            'last_username' => $lastUsername,
            'error' => $error,
            'csrf_token' => $csrfToken,
            'utilisateur' => $utilisateur,
        ]);
    }

    public function professionelAction(Request $request)
    {
        if( $this->container->get('security.context')->isGranted('IS_AUTHENTICATED_FULLY') ){
            return $this->redirect($this->generateUrl('HillsModeling_front_end_homepage'));
        }

        // login *******************************************************

        /* @var $request \Symfony\Component\HttpFoundation\Request */
        $session = $request->getSession();
        /* @var $session \Symfony\Component\HttpFoundation\Session\Session */

        // get the error if any (works with forward and redirect -- see below)
        if ($request->attributes->has(SecurityContext::AUTHENTICATION_ERROR)) {
            $error = $request->attributes->get(SecurityContext::AUTHENTICATION_ERROR);
        } elseif (null !== $session && $session->has(SecurityContext::AUTHENTICATION_ERROR)) {
            $error = $session->get(SecurityContext::AUTHENTICATION_ERROR);
            $session->remove(SecurityContext::AUTHENTICATION_ERROR);
        } else {
            $error = '';
        }

        if ($error) {
            // TODO: this is a potential security risk (see http://trac.symfony-project.org/ticket/9523)
            $error = $error->getMessage();
        }
        // last username entered by the user
        $lastUsername = (null === $session) ? '' : $session->get(SecurityContext::LAST_USERNAME);

        $csrfToken = $this->container->get('form.csrf_provider')->generateCsrfToken('authenticate');

        // inscription *******************************************************************************
        $em = $this->getDoctrine()->getEntityManager();
        $professionnel = new Professionnel();
        $form = $this->createForm(new ProfessionnelType(), $professionnel);
        $form->handleRequest($request);
        if ($form->isValid()) {
            $professionnel->addRole('ROLE_PROFESSIONNEL');
            $professionnel->setEnabled(true);
            $em->persist($professionnel);
            $em->flush();
            $route = 'HillsModeling_front_end_test';
            $this->addFlash(
                'userep',
                'votre compte à éte bien céer!'
            );
            $url = $this->container->get('router')->generate($route);
            $response = new RedirectResponse($url);
            $this->authenticateUser($professionnel, $response);
            return $response;
        }

        $utilisateur = "professionnel" ;
        return $this->render('@HillsModelingFrontEnd/Default/login_register.html.twig', [
            'form' => $form->createView(),
            'last_username' => $lastUsername,
            'error' => $error,
            'csrf_token' => $csrfToken,
            'utilisateur' => $utilisateur,
        ]);

    }


    public function loginAction(Request $request)
    {

        if( $this->container->get('security.context')->isGranted('IS_AUTHENTICATED_FULLY') ){
            return $this->redirect($this->generateUrl('HillsModeling_front_end_homepage'));
        }
        // login *******************************************************

        /* @var $request \Symfony\Component\HttpFoundation\Request */
        $session = $request->getSession();
        /* @var $session \Symfony\Component\HttpFoundation\Session\Session */

        // get the error if any (works with forward and redirect -- see below)
        if ($request->attributes->has(SecurityContext::AUTHENTICATION_ERROR)) {
            $error = $request->attributes->get(SecurityContext::AUTHENTICATION_ERROR);
        } elseif (null !== $session && $session->has(SecurityContext::AUTHENTICATION_ERROR)) {
            $error = $session->get(SecurityContext::AUTHENTICATION_ERROR);
            $session->remove(SecurityContext::AUTHENTICATION_ERROR);
        } else {
            $error = '';
        }

        if ($error) {
            // TODO: this is a potential security risk (see http://trac.symfony-project.org/ticket/9523)
            $error = $error->getMessage();
        }
        // last username entered by the user
        $lastUsername = (null === $session) ? '' : $session->get(SecurityContext::LAST_USERNAME);

        $csrfToken = $this->container->get('form.csrf_provider')->generateCsrfToken('authenticate');

        return $this->render('@HillsModelingFrontEnd/Default/login.html.twig', [
            'last_username' => $lastUsername,
            'error' => $error,
            'csrf_token' => $csrfToken,
        ]);

    }

    public function testAction(Request $request)
    {

        return $this->render('@HillsModelingFrontEnd/Default/accueil.html.twig');
    }


    /**
     * @return Response
     */
    public function projetAction(Request $request)
    {
        if(!$this->container->get('security.context')->isGranted('IS_AUTHENTICATED_FULLY') ){
            return $this->redirect($this->generateUrl('HillsModeling_front_end_Membre'));
        }

        if($this->getRequest()->isMethod('Post')) {
            $id = $request->request->get('NomProjets');

            $em = $this->getDoctrine()->getEntityManager();
            $projet = $em->getRepository('HillsModelingFrontEndBundle:Projet')->find($id);
            $user = $em->getRepository('HillsModelingFrontEndBundle:Membre')->find($this->getUser()->getId());
            $route = 'HillsModeling_Ouvrir_projet';
            $url = $this->container->get('router')->generate($route, array('id' => $projet->getId()));
            $response = new RedirectResponse($url);
            $this->authenticateUser($user, $response);
            return $response;
        }else
            return $this->render('HillsModelingFrontEndBundle:Default:404.html.twig');


    }



    public function OuvrirProjetAction($id)
    {
        if(!$this->container->get('security.context')->isGranted('IS_AUTHENTICATED_FULLY') ){
            return $this->redirect($this->generateUrl('HillsModeling_front_end_Membre'));
        }
        $request= $this->getRequest();
        if($this->getRequest()->isMethod('Post')) {
            $id = $request->request->get('NomProjet');
        }
        $em = $this->getDoctrine()->getEntityManager();
        $user = $em->getRepository('HillsModelingFrontEndBundle:Membre')->find($this->getUser()->getId());
        $projet = $em->getRepository('HillsModelingFrontEndBundle:Projet')->Find($id);
        if($projet) {
            if ($projet->getMembre()==$user) {
                $listAttributs = $em->getRepository('HillsModelingFrontEndBundle:Attributs')->FindAttr($id);
                $shemas = $em->getRepository('HillsModelingFrontEndBundle:Shemas')->FindShema($projet->getId());
                return $this->render('HillsModelingFrontEndBundle:Default:index.html.twig', ['projet' => $projet, 'listAttributs' => $listAttributs,'shemas'=>$shemas]);
            }else
                return $this->render('HillsModelingFrontEndBundle:Default:404.html.twig');

            //le projet c'est pas pour vous
        }
        return $this->render('HillsModelingFrontEndBundle:Default:404.html.twig');

        //le projet n'existe pas

    }

    public function CreerProjetAction(Request $request)
    {
        if(!$this->container->get('security.context')->isGranted('IS_AUTHENTICATED_FULLY') ){
            return $this->redirect($this->generateUrl('HillsModeling_front_end_Membre'));
        }

        $em = $this->getDoctrine()->getEntityManager();

        if($this->getRequest()->isMethod('Post')) {
            $projet = new Projet();
            $projet->setDateCreation(new \DateTime('now'));
            $projet->setNom($request->request->get('NomProjet'));
            $user = $em->getRepository('HillsModelingFrontEndBundle:Membre')->find($this->getUser()->getId());
            $projet->setMembre($user);
            $em->persist($projet);
            $em->flush();

            $route = 'HillsModeling_Ouvrir_projet';
            $url = $this->container->get('router')->generate($route, array('id' => $projet->getId()));
            $response = new RedirectResponse($url);
            $this->authenticateUser($user, $response);
            return $response;

        }else
            return 0 ;


    }


    public function CreerAttributsAction(Request $request,$id)
    {
        if(!$this->container->get('security.context')->isGranted('IS_AUTHENTICATED_FULLY') ){
            return $this->redirect($this->generateUrl('HillsModeling_front_end_Membre'));
        }
        $em = $this->getDoctrine()->getEntityManager();

        if($this->getRequest()->isMethod('post')) {
            $attributs = new Attributs();
            $attributs->setNom($request->request->get('nom'));
            $attributs->setType($request->request->get('type'));
            $attributs->setValeur($request->request->get('valeur'));
            $attributs->setEtat($request->request->get('etat'));
            $projet = $em->getRepository('HillsModelingFrontEndBundle:Projet')->find($id);
            $attributs->setProjet($projet);
            $em->persist($attributs);
            $em->flush();
            $listAttributs = $em->getRepository('HillsModelingFrontEndBundle:Attributs')->FindAttr($projet->getId());
            $shemas = $em->getRepository('HillsModelingFrontEndBundle:Shemas')->FindShema($projet->getId());

            return $this->render('HillsModelingFrontEndBundle:Default:index.html.twig', ['projet' => $projet ,'listAttributs' =>$listAttributs ,'shemas'=>$shemas]);
        }else
            $projet = $em->getRepository('HillsModelingFrontEndBundle:Projet')->find($id);
            $user = $em->getRepository('HillsModelingFrontEndBundle:Membre')->find($this->getUser()->getId());
            $route = 'HillsModeling_Ouvrir_projet';
            $url = $this->container->get('router')->generate($route, array('id' => $projet->getId()));
            $response = new RedirectResponse($url);
            $this->authenticateUser($user, $response);
            return $response;
    }

    public function SaveTransitionsAction(Request $request, $id)
    {
        if(!$this->container->get('security.context')->isGranted('IS_AUTHENTICATED_FULLY') ){
            return $this->redirect($this->generateUrl('HillsModeling_front_end_Membre'));
        }
        $em = $this->getDoctrine()->getEntityManager();

        /** @var Projet $projet */
        $projet = $em->getRepository('HillsModelingFrontEndBundle:Projet')->find($id);

        $reduxState = $request->request->get('redux_state');

        $projet->setTransitions($reduxState);
        $em->persist($projet);
        $em->flush();

        return new JsonResponse();
    }

    public function ModifierAttributsAction(Request $request)
    {
        if(!$this->container->get('security.context')->isGranted('IS_AUTHENTICATED_FULLY') ){
            return $this->redirect($this->generateUrl('HillsModeling_front_end_Membre'));
        }
        return $this->render('HillsModelingFrontEndBundle:Default:index.html.twig');

    }
    public function CreershemasAction(Request $request,$id)
    {
        if(!$this->container->get('security.context')->isGranted('IS_AUTHENTICATED_FULLY') ){
            return $this->redirect($this->generateUrl('HillsModeling_front_end_Membre'));
        }
        $em = $this->getDoctrine()->getEntityManager();

        if($this->getRequest()->isMethod('post')) {
            $shema = new Shemas();
            $shema->setNom($request->request->get('nom'));
            $shema->setValeurE($request->request->get('entrer'));
            $shema->setValeurS($request->request->get('sortie'));
            $shema->setCode($request->request->get('code'));
            $projet = $em->getRepository('HillsModelingFrontEndBundle:Projet')->find($id);
            $shema->setProjet($projet);
            $em->persist($shema);
            $em->flush();
            $listAttributs = $em->getRepository('HillsModelingFrontEndBundle:Attributs')->FindAttr($projet->getId());
            $shemas = $em->getRepository('HillsModelingFrontEndBundle:Shemas')->FindShema($projet->getId());

            return $this->render('HillsModelingFrontEndBundle:Default:index.html.twig', ['projet' => $projet ,'listAttributs' =>$listAttributs,'shemas'=>$shemas ]);
        }else
            $projet = $em->getRepository('HillsModelingFrontEndBundle:Projet')->find($id);
        $user = $em->getRepository('HillsModelingFrontEndBundle:Membre')->find($this->getUser()->getId());
        $route = 'HillsModeling_Ouvrir_projet';
        $url = $this->container->get('router')->generate($route, array('id' => $projet->getId()));
        $response = new RedirectResponse($url);
        $this->authenticateUser($user, $response);
        return $response;

    }
    public function ModifiershemasAction(Request $request)
    {
        if(!$this->container->get('security.context')->isGranted('IS_AUTHENTICATED_FULLY') ){
            return $this->redirect($this->generateUrl('HillsModeling_front_end_Membre'));
        }
        return $this->render('HillsModelingFrontEndBundle:Default:index.html.twig');

    }


    public function indexAction(Request $request)
    {
        if(!$this->container->get('security.context')->isGranted('IS_AUTHENTICATED_FULLY') ){
            return $this->redirect($this->generateUrl('HillsModeling_front_end_Membre'));
        }
        $em = $this->getDoctrine()->getEntityManager();
        $user = $em->getRepository('HillsModelingFrontEndBundle:Membre')->find($this->getUser()->getId());
        $projets= $user->getProjet();
        return $this->render('HillsModelingFrontEndBundle:Default:accueil.html.twig',['projets'=>$projets]);

    }


    public function faqMembre_HillsModelingAction()
    {
        if( !$this->container->get('security.context')->isGranted('ROLE_Membre') ){
            return $this->redirect($this->generateUrl('HillsModeling_front_end_homepage'));
        }



        return $this->render('HillsModelingFrontEndBundle:Default:faqMembre.html.twig');

    }

    public function ExportxmlAction($id){


        $xml = '<?xml version="1.0" charset="UTF-8"?> 
                <projet>
                <attributs>';

        $em = $this->getDoctrine()->getEntityManager();
        $projet = $em->getRepository('HillsModelingFrontEndBundle:Projet')->find($id);
        $attributs = $em->getRepository('HillsModelingFrontEndBundle:Attributs')->FindAttr($id);

        foreach($attributs as $att){
            $xml .= '
            <attribut>
            <nom>'.$att->getnom().'</nom>
            <type>'.$att->gettype().'</type>
            <valeur>'.$att->getvaleur().'</valeur>
            <etat>'.$att->getetat().'</etat>
            </attribut>';
        }
        $xml .= '</attributs>
                 <shemas>';
        $shemas = $em->getRepository('HillsModelingFrontEndBundle:Shemas')->FindShema($id);

        foreach($shemas as $sh){
            $chaine = str_replace("\n","",$sh->getcode());
            $chaine = str_replace("\r","",$chaine);
            $chaine = str_replace("\t","",$chaine);
            $xml .= '
            <shema>
            <nom>'.$sh->getnom().'</nom>
            <ValeurEntrer>'.$sh->getvaleurE().'</ValeurEntrer>
            <ValeurSortie>'.$sh->getvaleurS().'</ValeurSortie>
            <code>'.$chaine.'
            </code></shema>';
        }
        $xml .= '</shemas>';
         $xml .= '<transitions>'. $projet->getTransitions().'</transitions>
                  </projet>';

      $fileName = $projet->getnom().'.xml';

        $response = new Response();
        $response->setContent($xml);
        $response->headers->set('Content-Type', 'application/force-download');
        $response->headers->set('Content-disposition', 'filename='. $fileName);

        return $response;

    }


    /**
     * Authenticate a user with Symfony Security
     *
     * @param \FOS\UserBundle\Model\UserInterface $user
     * @param \Symfony\Component\HttpFoundation\Response $response
     */
    protected function authenticateUser(UserInterface $user, Response $response)
    {
        try {
            $this->container->get('fos_user.security.login_manager')->loginUser(
                $this->container->getParameter('fos_user.firewall_name'),
                $user,
                $response);
        } catch (AccountStatusException $ex) {
        }
    }
}
