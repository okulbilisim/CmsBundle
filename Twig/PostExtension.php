<?php
/** 
 * Date: 24.12.14
 * Time: 11:52
 */
namespace Okulbilisim\CmsBundle\Twig;

use Doctrine\ORM\EntityManager;
use Okulbilisim\CmsBundle\Entity\Post;
use Symfony\Component\DependencyInjection\ContainerInterface;

class PostExtension  extends \Twig_Extension{

    /** @var  ContainerInterface */
    private $container;
    /** @var  EntityManager */
    private $em;
    public function __construct($container,$em)
    {
        $this->container = $container;
        $this->em = $em;
    }

    public function getFilters(){
        return [
            new \Twig_SimpleFilter('post_status',[$this,'status'])
        ];
    }

    public function getFunctions()
    {
        return [
            new \Twig_SimpleFunction('getPostObject',[$this,'post_object']),
        ];
    }
    public function status($key)
    {
        $statuses = [
            0=>'Disable',
            1=>'Enable',
            2=>'Canceled'
        ];
        if(isset($statuses[$key]))
            return $statuses[$key];
        return $key;
    }

    public function post_object(Post $post)
    {
        $postRepo = $this->em->getRepository('OkulbilisimCmsBundle:Post');
        $class = $post->getObject();
    }

    public function getName()
    {
        return 'post_extension';
    }
}