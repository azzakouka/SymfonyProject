<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class EtapeController extends AbstractController
{
    /**
     * @Route("/etape", name="etape")
     */
    public function index()
    {
        return $this->render('etape/index.html.twig', [
            'controller_name' => 'EtapeController',
        ]);
    }
    /**
     * @Route("/updateEtape",name="create")
     * @Route("/new/{id}",name="updateEtape")
     */
    public function updateEtape(\Symfony\Component\HttpFoundation\Request $request, Etape $etape = null)
    {
        $manager = $this->getDoctrine()->getManager();
        if( !$etape) {
            $etape = new Etape();
        }
        $form = $this->createForm(DestType::class, $etape);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $manager->persist($etape);
            $manager->flush();
            return $this->redirectToRoute('list_dest');
        }
        return $this->render('app/updateEtape.html.twig', ['t' => false, 'formDest'=> $form->createView(), 'test' => $etape->getId() !== null]);
    }
    /**
     * @Route("/deleteEtape/{id}",name="deleteEtape")
     */
    public function DeleteEtape(\Symfony\Component\HttpFoundation\Request $request, Etape $etape)
    {
        $manager = $this->getDoctrine()->getManager();
        $form = $this->createForm(EtapeType::class, $etape);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $manager->remove($etape);
            $manager->flush();
            return $this->redirectToRoute('list_dest');
        }
        return $this->render('app/deleteEtape.html.twig', ['formDest'=> $form->createView()]);

    }
}
