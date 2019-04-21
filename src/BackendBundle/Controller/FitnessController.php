<?php

namespace BackendBundle\Controller;

use BackendBundle\Entity\Fitness;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Fitness controller.
 *
 * @Route("fitness")
 */
class FitnessController extends Controller
{
    /**
     * Lists all fitness entities.
     *
     * @Route("/", name="fitness_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $fitnesses = $em->getRepository('BackendBundle:Fitness')->findAll();

        return $this->render('fitness/index.html.twig', array(
            'fitnesses' => $fitnesses,
        ));
    }

    /**
     * Creates a new fitness entity.
     *
     * @Route("/new", name="fitness_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $fitness = new Fitness();
        $form = $this->createForm('BackendBundle\Form\FitnessType', $fitness);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($fitness);
            $em->flush();

            return $this->redirectToRoute('fitness_show', array('id' => $fitness->getId()));
        }

        return $this->render('fitness/new.html.twig', array(
            'fitness' => $fitness,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a fitness entity.
     *
     * @Route("/{id}", name="fitness_show")
     * @Method("GET")
     */
    public function showAction(Fitness $fitness)
    {
        $deleteForm = $this->createDeleteForm($fitness);

        return $this->render('fitness/show.html.twig', array(
            'fitness' => $fitness,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing fitness entity.
     *
     * @Route("/{id}/edit", name="fitness_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Fitness $fitness)
    {
        $deleteForm = $this->createDeleteForm($fitness);
        $editForm = $this->createForm('BackendBundle\Form\FitnessType', $fitness);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('fitness_edit', array('id' => $fitness->getId()));
        }

        return $this->render('fitness/edit.html.twig', array(
            'fitness' => $fitness,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a fitness entity.
     *
     * @Route("/{id}", name="fitness_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Fitness $fitness)
    {
        $form = $this->createDeleteForm($fitness);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($fitness);
            $em->flush();
        }

        return $this->redirectToRoute('fitness_index');
    }

    /**
     * Creates a form to delete a fitness entity.
     *
     * @param Fitness $fitness The fitness entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Fitness $fitness)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('fitness_delete', array('id' => $fitness->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
