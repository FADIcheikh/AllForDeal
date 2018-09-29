<?php

namespace Client\ClientBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Ob\HighchartsBundle\Highcharts\Highchart;

use Zend\Json\Expr;


class grapheController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('ClientBundle:Default:index.html.twig', array('name' => $name));
    }
    
    public function chartAction()
{
        
        
       $username= $this->get('security.context')->getToken()->getUser()->getUsername();
        

$ob = new Highchart();
$ob->chart->renderTo('piechart');
$ob->title->text('Gender Proprtion');
$ob->plotOptions->pie(array(
 'allowPointSelect' => true,
 'cursor' => 'pointer',
 'dataLabels' => array('enabled' => false),
 'showInLegend' => true
));

$em=  $this->getDoctrine()->getEntityManager();
$query=$em->createQuery('SELECT AVG(c.sexe) as Sexe FROM ClientBundle:Client c ');
$resultat=$query->getResult();


$data = array();
foreach ($resultat as $values) {
    $a = array('Female', floatval($values['Sexe']));
    $b =array('Male', floatval(1-$values['Sexe']));
    array_push($data, $a,$b);
  
    
}


$ob->series(array(array('type' => 'pie','name' => 'Pourcentage', 'data' => $data)));
return $this->render('ClientBundle:graphe:pie_sexe.html.twig', array(
 'chart' => $ob,'username'=>$username
 ));
}


//compte activé:ok /désactivé:ok /en cours d'activation :in progress 
public function chartactiveaccountAction()
{
        
        
       $username= $this->get('security.context')->getToken()->getUser()->getUsername();
        

$ob = new Highchart();
$ob->chart->renderTo('piechart');
$ob->title->text('Enabled Accounts Proportion');
$ob->plotOptions->pie(array(
 'allowPointSelect' => true,
 'cursor' => 'pointer',
 'dataLabels' => array('enabled' => false),
 'showInLegend' => true
));

$em=  $this->getDoctrine()->getEntityManager();
$query=$em->createQuery('SELECT AVG(c.enabled) as Enabled FROM ClientBundle:Client c ');
$resultat=$query->getResult();

//$query2=$em->createQuery('SELECT AVG(COUNT(c.enabled)) as Enabled1 FROM ClientBundle:Client c WHERE c.confirmation_token = 0 ');
//$resulta2t=$query2->getResult();

$data = array();
foreach ($resultat as $values) {
    
    $a = array('Enabled Accounts', floatval($values['Enabled']));
    $b =array('Disabled Accounts', floatval(1-$values['Enabled']));
//    $c=array('Activcation infinished', floatval($values['Enabled1']));
    array_push($data, $a,$b);
  
 
}


$ob->series(array(array('type' => 'pie','name' => 'Pourcentage', 'data' => $data)));
return $this->render('ClientBundle:graphe:pie_disable.html.twig', array(
 'chart' => $ob,'username'=>$username
 ));
}

public function chartlockaccountAction()
{
        
        
       $username= $this->get('security.context')->getToken()->getUser()->getUsername();
        

$ob = new Highchart();
$ob->chart->renderTo('piechart');
$ob->title->text('Locked Accounts Proportion');
$ob->plotOptions->pie(array(
 'allowPointSelect' => true,
 'cursor' => 'pointer',
 'dataLabels' => array('enabled' => false),
 'showInLegend' => true
));

$em=  $this->getDoctrine()->getEntityManager();
$query=$em->createQuery('SELECT AVG(c.locked) as Locked FROM ClientBundle:Client c ');
$resultat=$query->getResult();


$data = array();
foreach ($resultat as $values) {
    $a = array('Locked Accounts', floatval($values['Locked']));
    $b =array('Unlocked Accounts', floatval(1-$values['Locked']));
    array_push($data, $a,$b);
  
    
}


$ob->series(array(array('type' => 'pie','name' => 'Pourcentage', 'data' => $data)));
return $this->render('ClientBundle:graphe:pie_lock.html.twig', array(
 'chart' => $ob,'username'=>$username
 ));
}




//inscrits/gouv :: en cours 

public function chartHistogrammeAction()
{
    $username= $this->get('security.context')->getToken()->getUser()->getUsername();
    //tunis
    $em=  $this->getDoctrine()->getEntityManager();
$query=$em->createQuery('SELECT COUNT(c.enabled) as Adresse FROM ClientBundle:Client c WHERE c.adresse =:nvadresse');
$query->setParameter('nvadresse',"Tunis");
$resultat=$query->getResult();
//

foreach ($resultat as $values) {
    $a = intval($values['Adresse']);
   }
   
//sousse
    $em=  $this->getDoctrine()->getEntityManager();
$query=$em->createQuery('SELECT COUNT(c.enabled) as Adresse FROM ClientBundle:Client c WHERE c.adresse =:nvadresse');
$query->setParameter('nvadresse',"Sousse");
$resultat1=$query->getResult();
// 
  foreach ($resultat1 as $values) {
    $b = intval($values['Adresse']);
   }
//sfax
   
    $em=  $this->getDoctrine()->getEntityManager();
$query=$em->createQuery('SELECT COUNT(c.enabled) as Adresse FROM ClientBundle:Client c WHERE c.adresse =:nvadresse');
$query->setParameter('nvadresse',"Sfax");
$resultat2=$query->getResult();
// 
  foreach ($resultat2 as $values) {
    $c = intval($values['Adresse']);
   }
   
   //Bizerte
   
    $em=  $this->getDoctrine()->getEntityManager();
$query=$em->createQuery('SELECT COUNT(c.enabled) as Adresse FROM ClientBundle:Client c WHERE c.adresse =:nvadresse');
$query->setParameter('nvadresse',"Bizerte");
$resultat3=$query->getResult();
// 
  foreach ($resultat3 as $values) {
    $d = intval($values['Adresse']);
   }
 //Nabeul
   
    $em=  $this->getDoctrine()->getEntityManager();
$query=$em->createQuery('SELECT COUNT(c.enabled) as Adresse FROM ClientBundle:Client c WHERE c.adresse =:nvadresse');
$query->setParameter('nvadresse',"Nabeul");
$resultat4=$query->getResult();
// 
  foreach ($resultat4 as $values) {
    $e = intval($values['Adresse']);
   }
   //mahdia
   
    $em=  $this->getDoctrine()->getEntityManager();
$query=$em->createQuery('SELECT COUNT(c.enabled) as Adresse FROM ClientBundle:Client c WHERE c.adresse =:nvadresse');
$query->setParameter('nvadresse',"Mahdia");
$resultat5=$query->getResult();
// 
  foreach ($resultat5 as $values) {
    $f = intval($values['Adresse']);
   }
      //tataouine
   
    $em=  $this->getDoctrine()->getEntityManager();
$query=$em->createQuery('SELECT COUNT(c.enabled) as Adresse FROM ClientBundle:Client c WHERE c.adresse =:nvadresse');
$query->setParameter('nvadresse',"Tataouine");
$resultat6=$query->getResult();
// 
  foreach ($resultat6 as $values) {
    $g = intval($values['Adresse']);
   }
   
         //kef
   
    $em=  $this->getDoctrine()->getEntityManager();
$query=$em->createQuery('SELECT COUNT(c.enabled) as Adresse FROM ClientBundle:Client c WHERE c.adresse =:nvadresse');
$query->setParameter('nvadresse',"Kef");
$resultat7=$query->getResult();
// 
  foreach ($resultat7 as $values) {
    $h= intval($values['Adresse']);
   }
   


$series = array(
 array(
 'name' => 'Client Number',
 'type' => 'column',
 'color' => '#4572A7',
 'yAxis' => 1,
 'data' => array($a, $b, $c, $d, $e, $f, $g, $h, 0, 0, 0, 0),
 ),

);
$yData = array(
 array(
 'labels' => array(

 'style' => array('color' => '#AA4643')
 ),

 'opposite' => true,
 ),
 array(
 'labels' => array(
 'formatter' => new Expr('function () { return this.value + " clients" }'),
 'style' => array('color' => '#4572A7')
 ),
 'gridLineWidth' => 0,
 'title' => array(
 'text' => '',
 'style' => array('color' => '#4572A7')
 ),
 ),
);

$categories = array('Tunis', 'Sousse', 'Sfax', 'Bizerte', 'Nabeul', 'Mahdia', 'Tataouine', 'Kef', 'Ben Arous', 'Gabès', 'Gafsa', 'Tozeur');
$ob = new Highchart();
$ob->chart->renderTo('container'); // The #id of the div where to render the chart
$ob->chart->type('column');
$ob->title->text('Clients');
$ob->xAxis->categories($categories);
$ob->yAxis($yData);
$ob->legend->enabled(false);
$formatter = new Expr('function () {
 var unit = {
 "Client Number": "Client(s)",
 "Temperature": "degrees C"
 }[this.series.name];
 return this.x + ": <b>" + this.y + "</b> " + unit;
 }');
$ob->tooltip->formatter($formatter);
$ob->series($series);
return $this->render('ClientBundle:graphe:hist_age.html.twig', array(
 'chart' => $ob,'username'=>$username
 ));
}
//stats produits 


}