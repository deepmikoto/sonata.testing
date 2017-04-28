<?php

namespace AppBundle\Entity;

use Application\Sonata\PageBundle\Entity\Block;
use Doctrine\ORM\Mapping as ORM;

/**
 * TagCollection
 *
 * @ORM\Table(name="tag_collection")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\TagCollectionRepository")
 */
class TagCollection
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var Block
     * 
     * @ORM\ManyToOne(targetEntity="Application\Sonata\PageBundle\Entity\Block", inversedBy="tagCollection")
     * @ORM\JoinColumn(name="block", referencedColumnName="id")
     */
    private $block;

    /**
     * @var Tag
     * 
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Tag", inversedBy="tagCollections")
     * @ORM\JoinColumn(name="tag", referencedColumnName="id")
     */
    private $tag;

    /**
     * @var int
     *
     * @ORM\Column(name="position", type="smallint")
     */
    private $position;


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
     * Set position
     *
     * @param integer $position
     *
     * @return TagCollection
     */
    public function setPosition($position)
    {
        $this->position = $position;

        return $this;
    }

    /**
     * Get position
     *
     * @return int
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * Set block
     *
     * @param \Application\Sonata\PageBundle\Entity\Block $block
     *
     * @return TagCollection
     */
    public function setBlock(Block $block = null)
    {
        $this->block = $block;

        return $this;
    }

    /**
     * Get block
     *
     * @return \Application\Sonata\PageBundle\Entity\Block
     */
    public function getBlock()
    {
        return $this->block;
    }

    /**
     * Set tag
     *
     * @param \AppBundle\Entity\Tag $tag
     *
     * @return TagCollection
     */
    public function setTag(Tag $tag = null)
    {
        $this->tag = $tag;

        return $this;
    }

    /**
     * Get tag
     *
     * @return \AppBundle\Entity\Tag
     */
    public function getTag()
    {
        return $this->tag;
    }
}
