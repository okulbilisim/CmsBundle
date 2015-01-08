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
            new \Twig_SimpleFilter('post_status',[$this,'status']),
        ];
    }

    public function getFunctions()
    {
        return [
            new \Twig_SimpleFunction('getPostObject',[$this,'post_object']),
            new \Twig_SimpleFunction('cmsobject',[$this,'cmsobject'])
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

    public function cmsobject($object,$id=0)
    {
        switch(gettype($object)){
            case 'string';
                return $this->getobject($this->decode($object),$id);
            case 'object';
                return $this->encode(get_class($object));
        }
    }

    public function getobject($object, $id)
    {
        $repo = $this->em->find($object,$id);
    }
    /**
     * Basic encoding
     * @param $string
     * @return string
     */
    public function encode($string)
    {
        $string = base64_encode($string);
        $len = strlen($string);
        $piece = $len/2;
        $encoded = substr($string,$piece,$len-1).substr($string,0,$piece);
        return $encoded;
    }

    /**
     * Basic encoding
     * @param $string
     * @return string
     */
    public function decode($string)
    {
        $len = strlen($string);
        $piece = $len/2;
        $string = substr($string,$piece,$len-1).substr($string,0,$piece);
        $decoded = base64_decode($string);
        return $decoded;
    }
    public function post_object(Post $post)
    {
        $object = $post->getObject();
        $id = $post->getObjectId();
        return "asd";
    }

    public function getName()
    {
        return 'post_extension';
    }
}