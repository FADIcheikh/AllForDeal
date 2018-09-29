<?php

namespace Client\ClientBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('ClientBundle:Default:index.html.twig');
    }
         public function completeprofileAction()
    {
          
          $em=$this->getDoctrine()->getManager();
         $req=$this->get('request');
         $client= $this->get('security.context')->getToken()->getUser();
         $id = $this->container->get('security.context')->getToken()->getUser()->getId();
         
         
         if ($req->getMethod()=='POST') {
             
             $adresse=$req->get('adresse');
             $firstname=$req->get('firstname');
             $lastname=$req->get('lastname');
             $sexe=$req->get('sexe');
             $telephone=$req->get('telephone');
             $datenaissance=$req->get('datenaissance');
             
        $query=$this->getDoctrine()->getManager()->createQuery('UPDATE ClientBundle:Client c SET  c.adresse = :nvadresse , c.firstname = :nvfirstname ,'
                . 'c.lastname = :nvlastname , c.sexe = :nvsexe , c.telephone = :nvtelephone , c.datenaissance = :nvdatenaissance where c.id=:idClient  ');
    $query->setParameter('nvadresse',$adresse);
    $query->setParameter('nvfirstname',$firstname);
    $query->setParameter('nvlastname',$lastname);
    $query->setParameter('nvsexe',$sexe);
    $query->setParameter('nvtelephone',$telephone);
    $query->setParameter('nvdatenaissance',$datenaissance);
    $query->setParameter('idClient',$id);
    
    $query->execute();
    return $this->redirect($this->generateUrl("fos_user_profile_show"));
    
         }
    return $this->render('ClientBundle:Default:completeprofile.html.twig',array('client'=>$client));

    }
    
            public function personalprofileAction()
    {
          
          $em=$this->getDoctrine()->getManager();
         $req=$this->get('request');
         $client= $this->get('security.context')->getToken()->getUser();
         $id = $this->container->get('security.context')->getToken()->getUser()->getId();
         
         
         if ($req->getMethod()=='POST') {
             
             $adresse=$req->get('adresse');
             $firstname=$req->get('firstname');
             $lastname=$req->get('lastname');
             $telephone=$req->get('telephone');
             $datenaissance=$req->get('datenaissance');
             
        $query=$this->getDoctrine()->getManager()->createQuery('UPDATE ClientBundle:Client c SET  c.adresse = :nvadresse , c.firstname = :nvfirstname ,'
                . 'c.lastname = :nvlastname  , c.telephone = :nvtelephone , c.datenaissance = :nvdatenaissance where c.id=:idClient  ');
    $query->setParameter('nvadresse',$adresse);
    $query->setParameter('nvfirstname',$firstname);
    $query->setParameter('nvlastname',$lastname);
    $query->setParameter('nvtelephone',$telephone);
    $query->setParameter('nvdatenaissance',$datenaissance);
    $query->setParameter('idClient',$id);
    
    $query->execute();
    
    return $this->redirect($this->generateUrl("fos_user_profile_show"));
    
         }
    return $this->render('ClientBundle:Default:personalprofile.html.twig');

    }
    
    //pour afficher ou pas complete profile !! en cours 
    
                public function showcompleteAction()
    {
          $var=0;
          $em=$this->getDoctrine()->getManager();
         $req=$this->get('request');
         $client= $this->get('security.context')->getToken()->getUser();
         $id = $this->container->get('security.context')->getToken()->getUser()->getId();
         $firstname = $this->container->get('security.context')->getToken()->getUser()->getFirstname();
         $lastname = $this->container->get('security.context')->getToken()->getUser()->getLastname();
         
         if ($firstname !="" && $lastname!="") {
         $var=0;
          return $this->redirect($this->generateUrl("client_complete_profile_page",array('var'=>$var)));
         }
        else {
             $var=1;
             }
             
  
    
         
    return $this->render('FOSUserBundle:Profile:show_content.html.twig');

    }

}
