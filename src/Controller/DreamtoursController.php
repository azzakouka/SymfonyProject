<?php

namespace App\Controller;

use App\Entity\Destination;
use App\Entity\Etape;
use App\Form\DestType;
use App\Repository\DestinationRepository;
use Cassandra\Set;
use App\Entity\Ville;
use App\Entity\Circuit;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class DreamtoursController extends AbstractController
{
    private $rep_ville;


    /**
     * @Route("/", name="dreamtours")
     */

    public function index()
    {
      /*  $de=$this->getDoctrine()->getManager();
        $cir=$de->getRepository(Circuit::class)->find(4);
        $villee=$de->getRepository(Ville::class)->find(5);

        $des=new Circuit();
        $des->setCodeCircuit(1);
        $des->setDesCircuit('Tunisie_été');
        $des->setDureeCircuit(7);
        $de->persist($des);
        $de->flush();*/
        $de=$this->getDoctrine()->getManager();
        $villee=$de->getRepository(Ville::class)->find_ville_etape();
        return $this->render('dreamtours/index.html.twig', [
            'ville' => $villee,
        ]);
    }
    /**
     * @Route("/destination", name="liste_destination")
     */
    public function list_dest()
    {
        return $this->render('dreamtours/list_dest.html.twig', [
            'controller_name' => 'DreamtoursController',
    ]);
    }
    /**
     * @Route("/destination", name="affich_destination")
     */
    public function affich_dest()
    {
        $de=$this->getDoctrine()->getManager();
        $ville=$de->getRepository(Ville::class)->find_ville_etape();
        return $this->render('dreamtours/affich_dest.html.twig', array('villes'=>$ville));
    }
    /**
     * @Route("/MAJ", name="MAJ_destination")
     */
    public function MAJ_dest()
    {

        $destination=$this->rep_dest->find(1);
        dump($destination);
        return $this->render('dreamtours/MAJ_dest.html.twig', [
            'controller_name' => 'DreamtoursController',
        ]);
    }
    public function affich_select()
    {
        $villes = $this->rep_ville->find_ville_etape();
        return $this->render('dreamtours/affich_select.html.twig', array('villes'=>$villes,));

    }
    public function destination()
    {
        $de=$this->getDoctrine()->getManager();
        $property=$de->getRepository(Etape::class)->findOrdreEtape();
        $prop=$de->getRepository(Etape::class)->findDureeEtape();
        $pr=$de->getRepository(Etape::class)->findDest();
        var_dump($pr);
        $dest=$this->getDoctrine()->getRepository(Ville::class)->findAll();
        return $this->render('app/list_dest.html.twig',array('ordre_etape'=>$property, 'destination'=>$dest, 'duree_etape'=>$prop, 'des'=>$pr));
}
    public function destinationn()
{
    $de=$this->getDoctrine()->getManager();
    $dest=$this->getDoctrine()->getRepository(Destination::class)->findAll();
    return $this->render('app/list_dest.html.twig',array('destination'=>$dest));
}
    /**
     * @Route("/update",name="create")
     * @Route("/new/{id}",name="update")
     */
    public function update(\Symfony\Component\HttpFoundation\Request $request, Destination $destination = null)
    {
        $manager = $this->getDoctrine()->getManager();
        if( !$destination) {
            $destination = new Destination();
        }
        $form = $this->createForm(DestType::class, $destination);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $manager->persist($destination);
            $manager->flush();
            return $this->redirectToRoute('list_dest');
        }
        return $this->render('app/update.html.twig', ['t' => false, 'formDest'=> $form->createView(), 'test' => $destination->getId() !== null]);
    }

    /**
    * @Route("/delete/{id}",name="delete")
     */
    public function Delete(\Symfony\Component\HttpFoundation\Request $request, Destination $destination)
    {
        $manager = $this->getDoctrine()->getManager();
        $form = $this->createForm(DestType::class, $destination);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $manager->remove($destination);
            $manager->flush();
            return $this->redirectToRoute('list_dest');
        }
        return $this->render('app/delete.html.twig', ['formDest'=> $form->createView()]);

    }

    /**
     * @Route("destination/{id}", name="detail")
     */
    public function detail($id)
    {
        $de=$this->getDoctrine()->getManager();
        $detail=$de->getRepository(Destination::class)->find($id);
        return $this->render('app/details.html.twig',array('dest'=>$detail));
    }












}
