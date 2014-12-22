<?php

namespace Okulbilisim\CmsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('OkulbilisimCmsBundle:Default:index.html.twig', array('name' => $name));
    }
}
