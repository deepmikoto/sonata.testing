<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Knp\DoctrineBehaviors\Model\Translatable\Translatable;

/**
 * Tag
 *
 * @ORM\Table(name="tag")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\TagRepository")
 */
class Tag
{
    use Translatable;
    
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\TagCollection", mappedBy="tag")
     */
    private $tagCollections;

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->tagCollections = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add tagCollection
     *
     * @param \AppBundle\Entity\TagCollection $tagCollection
     *
     * @return Tag
     */
    public function addTagCollection(\AppBundle\Entity\TagCollection $tagCollection)
    {
        $this->tagCollections[] = $tagCollection;

        return $this;
    }

    /**
     * Remove tagCollection
     *
     * @param \AppBundle\Entity\TagCollection $tagCollection
     */
    public function removeTagCollection(\AppBundle\Entity\TagCollection $tagCollection)
    {
        $this->tagCollections->removeElement($tagCollection);
    }

    /**
     * Get tagCollections
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTagCollections()
    {
        return $this->tagCollections;
    }
}
