<?php

namespace Client\ClientBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\HttpFoundation\Request;

class adminController extends Controller
{
    public function indexAction()
    {
        $username= $this->get('security.context')->getToken()->getUser()->getUsername();
        return $this->render('ClientBundle:admin:index.html.twig',array('username'=>$username));
    }
    
        public function usersAction()
    {
            $username= $this->get('security.context')->getToken()->getUser()->getUsername();
          $em=$this->getDoctrine()->getManager();
         $req=$this->get('request');
         $client=$em->getRepository('ClientBundle:Client')->findAll();
         if ($req->getMethod()=='POST') {
             $username=$req->get('username');//name de l'input à partir du formulaire
             
             $client=$em->getRepository('ClientBundle:Client')->findByusername($username);
             
         }
          
        return $this->render('ClientBundle:admin:users.html.twig',array ('client'=>$client,'username'=>$username));
    }
    
       public function supprimerClientAction($id, Request $request)
    {
           //msg
//           $route = $this->get('router')->generate('admin_users_remove_page',array('id'=>$id),true);
//           $referer = $request->server->get('HTTP_REFERER');
//           if ($route === $referer)
//           {
//       $bag = $this->get('session')->getFlashBag();
//       $bag->set('supp','User Deleted');
//           }
           /////-------////
        $em = $this->getDoctrine()->getManager();
        $client = $em->getRepository("ClientBundle:Client")->find($id);
        $em->remove($client);
        $em->flush();
        return $this->redirect($this->generateUrl("admin_userspage"));
    

    }
    
     public function lockAction($id)
    {
          $username= $this->get('security.context')->getToken()->getUser()->getUsername();
          $em=$this->getDoctrine()->getManager();
         $req=$this->get('request');
         $client=$em->getRepository('ClientBundle:Client')->find($id);
         
         if ($req->getMethod()=='POST') {
             $lock=$req->get('lock');
             $disable=$req->get('disable');
        $query=$this->getDoctrine()->getManager()->createQuery('UPDATE ClientBundle:Client c SET  c.locked = :nvlocked , c.enabled = :nvenabled where c.id=:idClient');
    $query->setParameter('nvlocked',$lock);
    $query->setParameter('nvenabled',$disable);
    $query->setParameter('idClient',$id);
    $query->execute();
    return $this->redirect($this->generateUrl("admin_userspage"));
    
         }
    return $this->render('ClientBundle:admin:lock.html.twig',array('client'=> $client,'username'=>$username));

    }
    
     public function detailClientAction($id) {
         $username= $this->get('security.context')->getToken()->getUser()->getUsername();
 $em=$this->getDoctrine()->getManager();
 $client=$em->getRepository("ClientBundle:Client")->find($id);
 //date naissance
 $dateFrom = new \DateTime($client->getDatenaissance()->format('Y-m-d H:i:s'));
 //date inscription
 $dateFromInscription = new \DateTime($client->getDateinscription()->format('Y-m-d H:i:s'));
//last login
 $dateLastlgoin = new \DateTime($client->getLastlogin()->format('Y-m-d H:i:s'));
//current date
 $dateNow = new \DateTime('now');
 
 $age=$dateNow->diff($dateFrom);
 $dernierecnx=$dateNow->diff($dateLastlgoin);
 $dureeinscription=$dateNow->diff($dateFromInscription);
 
   return $this->render('ClientBundle:admin:detail.html.twig',array('client'=> $client,'age'=>$age->format('%y ans '),'dernierecnx'=>$dernierecnx->format('%y ans %m mois %d jours %H heure %i minutes %s secondes')
           ,'username'=>$username,'dureeinscription'=>$dureeinscription->format('%y ans %m mois %d jour(s)')));
        
    }
    
    
    

}
