<?php

namespace Okulbilisim\CmsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PostTranslation
 */
class PostTranslation
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $locale;

    /**
     * @var string
     */
    private $field;

    /**
     * @var string
     */
    private $content;

    /**
     * @var \Okulbilisim\CmsBundle\Entity\Post
     */
    private $object;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set locale
     *
     * @param string $locale
     * @return PostTranslation
     */
    public function setLocale($locale)
    {
        $this->locale = $locale;

        return $this;
    }

    /**
     * Get locale
     *
     * @return string 
     */
    public function getLocale()
    {
        return $this->locale;
    }

    /**
     * Set field
     *
     * @param string $field
     * @return PostTranslation
     */
    public function setField($field)
    {
        $this->field = $field;

        return $this;
    }

    /**
     * Get field
     *
     * @return string 
     */
    public function getField()
    {
        return $this->field;
    }

    /**
     * Set content
     *
     * @param string $content
     * @return PostTranslation
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content
     *
     * @return string 
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set object
     *
     * @param \Okulbilisim\CmsBundle\Entity\Post $object
     * @return PostTranslation
     */
    public function setObject(\Okulbilisim\CmsBundle\Entity\Post $object = null)
    {
        $this->object = $object;

        return $this;
    }

    /**
     * Get object
     *
     * @return \Okulbilisim\CmsBundle\Entity\Post 
     */
    public function getObject()
    {
        return $this->object;
    }
}
