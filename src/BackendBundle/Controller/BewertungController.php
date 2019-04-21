<?php

namespace BackendBundle\Controller;

use BackendBundle\Entity\Bewertung;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Bewertung controller.
 *
 * @Route("bewertung")
 */
class BewertungController extends Controller
{
    /**
     * Lists all bewertung entities.
     *
     * @Route("/", name="bewertung_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $bewertungs = $em->getRepository('BackendBundle:Bewertung')->findAll();

        return $this->render('bewertung/index.html.twig', array(
            'bewertungs' => $bewertungs,
        ));
    }

    /**
     * Creates a new bewertung entity.
     *
     * @Route("/new", name="bewertung_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $bewertung = new Bewertung();
        $form = $this->createForm('BackendBundle\Form\BewertungType', $bewertung);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($bewertung);
            $em->flush();

            return $this->redirectToRoute('bewertung_show', array('id' => $bewertung->getId()));
        }

        return $this->render('bewertung/new.html.twig', array(
            'bewertung' => $bewertung,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a bewertung entity.
     *
     * @Route("/{id}", name="bewertung_show")
     * @Method("GET")
     */
    public function showAction(Bewertung $bewertung)
    {
        $deleteForm = $this->createDeleteForm($bewertung);

        return $this->render('bewertung/show.html.twig', array(
            'bewertung' => $bewertung,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing bewertung entity.
     *
     * @Route("/{id}/edit", name="bewertung_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Bewertung $bewertung)
    {
        $deleteForm = $this->createDeleteForm($bewertung);
        $editForm = $this->createForm('BackendBundle\Form\BewertungType', $bewertung);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('bewertung_edit', array('id' => $bewertung->getId()));
        }

        return $this->render('bewertung/edit.html.twig', array(
            'bewertung' => $bewertung,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a bewertung entity.
     *
     * @Route("/{id}", name="bewertung_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Bewertung $bewertung)
    {
        $form = $this->createDeleteForm($bewertung);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($bewertung);
            $em->flush();
        }

        return $this->redirectToRoute('bewertung_index');
    }

    /**
     * Creates a form to delete a bewertung entity.
     *
     * @param Bewertung $bewertung The bewertung entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Bewertung $bewertung)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('bewertung_delete', array('id' => $bewertung->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
