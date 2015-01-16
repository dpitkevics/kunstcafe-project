<?php

namespace KunstCafe\MainBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use KunstCafe\MainBundle\Entity\ArtistImage;
use KunstCafe\MainBundle\Form\ArtistImageType;

/**
 * ArtistImage controller.
 *
 */
class ArtistImageController extends Controller
{

    /**
     * Lists all ArtistImage entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('KunstCafeMainBundle:ArtistImage')->findAll();

        return $this->render('KunstCafeMainBundle:ArtistImage:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new ArtistImage entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new ArtistImage();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $entity->upload();

            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('kunstcafe_main_artist_image_crud_show', array('id' => $entity->getId())));
        }

        return $this->render('KunstCafeMainBundle:ArtistImage:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a ArtistImage entity.
     *
     * @param ArtistImage $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(ArtistImage $entity)
    {
        $form = $this->createForm(new ArtistImageType(), $entity, array(
            'action' => $this->generateUrl('kunstcafe_main_artist_image_crud_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new ArtistImage entity.
     *
     */
    public function newAction()
    {
        $entity = new ArtistImage();
        $form   = $this->createCreateForm($entity);

        return $this->render('KunstCafeMainBundle:ArtistImage:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a ArtistImage entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('KunstCafeMainBundle:ArtistImage')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find ArtistImage entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('KunstCafeMainBundle:ArtistImage:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing ArtistImage entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('KunstCafeMainBundle:ArtistImage')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find ArtistImage entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('KunstCafeMainBundle:ArtistImage:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a ArtistImage entity.
    *
    * @param ArtistImage $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(ArtistImage $entity)
    {
        $form = $this->createForm(new ArtistImageType(), $entity, array(
            'action' => $this->generateUrl('kunstcafe_main_artist_image_crud_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing ArtistImage entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('KunstCafeMainBundle:ArtistImage')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find ArtistImage entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $entity->upload();

            $em->flush();

            return $this->redirect($this->generateUrl('kunstcafe_main_artist_image_crud_edit', array('id' => $id)));
        }

        return $this->render('KunstCafeMainBundle:ArtistImage:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a ArtistImage entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('KunstCafeMainBundle:ArtistImage')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find ArtistImage entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('kunstcafe_main_artist_image_crud'));
    }

    /**
     * Creates a form to delete a ArtistImage entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('kunstcafe_main_artist_image_crud_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
