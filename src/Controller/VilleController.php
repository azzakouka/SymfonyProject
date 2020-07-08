<?php

namespace App\Controller;

use App\Entity\Destination;
use App\Entity\Ville;
use App\Form\DestType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class VilleController extends AbstractController
{
    /**
     * @Route("/ville", name="ville")
     */
    public function index()
    {
        return $this->render('ville/index.html.twig', [
            'controller_name' => 'VilleController',
        ]);
    }
    /**
     * @Route("/createVle",name="CreateVille")
     * @Route("/update/{id}", name="updateVille")
     */

    public function updatevle(\Symfony\Component\HttpFoundation\Request $request, Ville $ville = null)
    {
        $manager = $this->getDoctrine()->getManager();
        if( !$ville) {
            $ville = new Ville();
        }
        $form = $this->createForm(VilleType::class, $ville);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $manager->persist($ville);
            $manager->flush();
            return $this->redirectToRoute('list_dest');
        }
        return $this->render('app/update.html.twig', ['t' => false, 'formDest'=> $form->createView(), 'test' => $ville->getId() !== null]);
    }

    /**
     * @Route("/delete/{id}",name="deleteVille")
     */
    public function DeleteVle(\Symfony\Component\HttpFoundation\Request $request, Ville $ville)
    {
        $manager = $this->getDoctrine()->getManager();
        $form = $this->createForm(VilleType::class, $ville);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $manager->remove($ville);
            $manager->flush();
            return $this->redirectToRoute('list_dest');
        }
        return $this->render('app/deleteVille.html.twig', ['formVille'=> $form->createView()]);

    }
}
