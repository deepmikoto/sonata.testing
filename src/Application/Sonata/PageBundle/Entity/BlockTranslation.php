<?php
/**
 * Created by PhpStorm.
 * User: alexandru.vasileniuc
 * Date: 20.04.2017
 * Time: 09:22
 */

namespace Application\Sonata\PageBundle\Entity;


use Knp\DoctrineBehaviors\Model\Translatable\Translation;

/**
 * Class BlockTranslation
 * @package Application\Sonata\PageBundle\Entity
 */
class BlockTranslation
{
    use Translation;
    
    /**
     * @var array
     */
    protected $translatableFields;
    
    public function __construct()
    {
        $this->setTranslatableFields([]);
    }

    /**
     * @return array
     */
    public function getTranslatableFields()
    {
        return $this->translatableFields;
    }

    /**
     * @param array $translatableFields
     */
    public function setTranslatableFields($translatableFields)
    {
        $this->translatableFields = $translatableFields;
    }


}