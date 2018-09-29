<?php
// src/AppBundle/Entity/User.php

namespace Client\ClientBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Entity
 * @ORM\Table(name="Client")
 */
class Client extends BaseUser 
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
     /**
     * @var string
     *
     * @ORM\Column(name="adresse", type="string", length=500)
     */
     protected $adresse="";
     
      /**
     * @var string
     *
     * @ORM\Column(name="first_name", type="string", length=30)
     */
     protected $firstname="";
     
                /**
     * @var string
     *
     * @ORM\Column(name="last_name", type="string", length=30)
     */
     protected $lastname="";

           /**
     * @var integer
     *
     * @ORM\Column(name="telephone", type="integer")
     */
     protected $telephone=0;
     
            /**
     * @var integer
     *
     * @ORM\Column(name="sexe", type="integer")
     */
     protected $sexe=0;
     
    
     
            /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_naissance", type="date")
     */
     protected $datenaissance;
     
     
     
            /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_inscription", type="date")
     */
     protected $dateinscription;
     
     
      /**
     * Get dateinscription
     *
     * @return \DateTime 
     */
     function getDateinscription() {
         return $this->dateinscription;
     }
     
      /**
     * Set dateinscription
     *
     * @param \DateTime $dateinscription
     * @return Client
     */
     function setDateinscription(\DateTime $dateinscription) {
         $this->dateinscription = $dateinscription;
     }

               
    
    
  
     

     
  
     
    public function __construct()
    {
        parent::__construct();
        $this->datenaissance = new \DateTime('now');
        $this->dateinscription = new \DateTime('now');
        
        // your own logic
    }
}