<?php

namespace App\Controller;

use App\Entity\Circuit;
use App\Entity\Destination;
use App\Form\DestType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class CrudController extends AbstractController
{
    /**
     * @Route("/crud", name="crud")
     */
    public function index()
    {
        return $this->render('crud/index.html.twig', [
            'controller_name' => 'CrudController',
        ]);
    }
    /**
     * @Route("/circuit", name="circuit")
     */
    public function Voyage()
    {
        $manager= $this->getDoctrine()->getManager();
        $circuit = $manager->getRepository(Circuit::class)->findAll();
        return $this->render('crud/circuit.html.twig',['circuits'=>$circuit]);
    }

    /**
     * @Route("/updateCircuit",name="create")
     * @Route("/new/{id}",name="updateCircuit")
     */
    public function updateCircuit(\Symfony\Component\HttpFoundation\Request $request, Circuit $circuit = null)
    {
        $manager = $this->getDoctrine()->getManager();
        if( !$circuit) {
            $circuit = new Circuit();
        }
        $form = $this->createForm(DestType::class, $circuit);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $manager->persist($circuit);
            $manager->flush();
            return $this->redirectToRoute('list_dest');
        }
        return $this->render('app/update.html.twig', ['t' => false, 'formDest'=> $form->createView(), 'test' => $circuit->getId() !== null]);
    }

    /**
     * @Route("/deleteCircuit/{id}",name="deleteCircuit")
     */
    public function DeleteCircuit(\Symfony\Component\HttpFoundation\Request $request, Circuit $circuit)
    {
        $manager = $this->getDoctrine()->getManager();
        $form = $this->createForm(CircuitType::class, $circuit);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $manager->remove($circuit);
            $manager->flush();
            return $this->redirectToRoute('list_dest');
        }
        return $this->render('app/deleteCircuit.html.twig', ['formCircuit'=> $form->createView()]);

    }
}

