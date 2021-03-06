<?php

namespace Okulbilisim\CmsBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Okulbilisim\CmsBundle\Entity\Post;
use Okulbilisim\CmsBundle\Form\PostType;

/**
 * Post controller.
 *
 */
class PostController extends Controller
{
    /**
     * Lists all Post entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('OkulbilisimCmsBundle:Post')->findAll();

        return $this->render('OkulbilisimCmsBundle:Post:index.html.twig', array(
            'entities' => $entities,
        ));
    }

    /**
     * Creates a new Post entity.
     *
     */
    public function createAction(Request $request, $post_type='default', $object=null, $objectId=null)
    {
        $entity = new Post();
        $form = $this->createCreateForm($entity,$post_type, $object, $objectId);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity->setUniqueKey($entity->getObject().$entity->getObjectId());
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('okulbilisim_cms_admin', ['posttype'=>$entity->getPostType(),'object'=>$entity->getObject(),'id'=>$entity->getObjectId()]));
        }

        return $this->render('OkulbilisimCmsBundle:Post:new.html.twig', array(
            'entity' => $entity,
            'form' => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Post entity.
     *
     * @param Post $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Post $entity,  $post_type='default',$object=null, $objectId=null)
    {
        $form = $this->createForm(new PostType($this->container), $entity, array(
            'action' => $this->generateUrl('post_create',['post_type'=>$post_type,'object'=>$object,'objectId'=>$objectId]),
            'method' => 'POST',
            'object' => $object,
            'objectId' => $objectId,
            'post_type'=>$post_type
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Post entity.
     *
     */
    public function newAction( $post_type='default', $object=null,$objectId=null)
    {
        $entity = new Post();
        $form = $this->createCreateForm($entity, $post_type, $object, $objectId);

        return $this->render('OkulbilisimCmsBundle:Post:new.html.twig', array(
            'entity' => $entity,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Post entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('OkulbilisimCmsBundle:Post')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Post entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('OkulbilisimCmsBundle:Post:show.html.twig', array(
            'entity' => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Post entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('OkulbilisimCmsBundle:Post')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Post entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('OkulbilisimCmsBundle:Post:edit.html.twig', array(
            'entity' => $entity,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Creates a form to edit a Post entity.
     *
     * @param Post $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(Post $entity)
    {
        $form = $this->createForm(new PostType($this->container), $entity, array(
            'action' => $this->generateUrl('post_update', array('id' => $entity->getId())),
            'method' => 'PUT'
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }

    /**
     * Edits an existing Post entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('OkulbilisimCmsBundle:Post')->findOneBy(['id'=>$id]);
        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Post entity.');
        }

        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);
        if ($editForm->isValid()) {
            $entity->setUniqueKey($entity->getObject().$entity->getObjectId());
            $em->flush();
            return $this->redirect($this->generateUrl('okulbilisim_cms_admin', ['posttype'=>$entity->getPostType(),'object'=>$entity->getObject(),'id'=>$entity->getObjectId()]));
        }

        return $this->render('OkulbilisimCmsBundle:Post:edit.html.twig', array(
            'entity' => $entity,
            'edit_form' => $editForm->createView(),
        ));
    }

    /**
     * Deletes a Post entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);
        $post = [];
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('OkulbilisimCmsBundle:Post')->find($id);
        $post = [
            'posttype'=>$entity->getPostType(),
            'object'=>$entity->getObject(),
            'id'=>$entity->getObjectId()
        ];
        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Post entity.');
        }

        $em->remove($entity);
        $em->flush();
        return $this->redirect(
            $this->generateUrl('okulbilisim_cms_admin', $post)
        );
    }

    /**
     * Creates a form to delete a Post entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('post_delete', array('id' => $id)))
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm();
    }
}
