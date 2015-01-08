<?php

namespace Okulbilisim\CmsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AdminController extends Controller
{
    public function indexAction($posttype='default',$object=null,$id=null)
    {
        $params = ['post_type'=>$posttype];
        $object && $params['object'] = $object;
        $id && $params['objectId'] = $id;

        /** @var \Doctrine\ORM\EntityManager $em */
        $em = $this->getDoctrine()->getManager();
        $data = [];
        $data['post_types']=$this->container->getParameter('post_types');
        $data['selected_posttype']=$posttype;
        $data['entities'] = $em->getRepository('OkulbilisimCmsBundle:Post')->findBy($params);
        $data['object'] = $object;
        $data['objectId'] = $id;
        return $this->render('OkulbilisimCmsBundle:Admin:index.html.twig', $data);
    }
}
