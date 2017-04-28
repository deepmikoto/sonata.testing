<?php
/**
 * Created by PhpStorm.
 * User: alexandru.vasileniuc
 * Date: 13.04.2017
 * Time: 15:38
 */

namespace AppBundle\Blocks;


use Sonata\AdminBundle\Form\FormMapper;
use Sonata\BlockBundle\Block\BlockContextInterface;
use Sonata\BlockBundle\Block\Service\AbstractAdminBlockService;
use Sonata\BlockBundle\Model\BlockInterface;
use Sonata\CoreBundle\Model\Metadata;
use Sonata\CoreBundle\Validator\ErrorElement;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\NotNull;
use Symfony\Component\Validator\Constraints\Url;

class ContentWysiwygBlock extends AbstractAdminBlockService
{
    use EntityManagerAwareBlockTrait;

    /**
     * {@inheritdoc}
     */
    public function configureSettings(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'template'  => 'AppBundle:blocks:content_wysiwyg_block.html.twig'
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function execute(BlockContextInterface $blockContext, Response $response = null)
    {
        $settings = $blockContext->getSettings();
        $block = $this->refreshBlock($blockContext->getBlock());

        return $this->renderResponse($blockContext->getTemplate(),[
            'block' => $block,
            'settings' => $settings
        ], $response);
    }

    /**
     * {@inheritdoc}
     */
    public function buildEditForm(FormMapper $formMapper, BlockInterface $block)
    {
        $formMapper->add('translations', 'a2lix_translations',[
            'label' => 'app.form.label.translatable_fields',
            'fields' => [
                'translatableFields' => [
                    'label' => false,
                    'field_type' => 'sonata_type_immutable_array',
                    'keys' => [
                        ['content', 'sonata_simple_formatter_type', [
                            'format' => 'richhtml'
                        ]]
                    ]
                ]
            ]
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockMetadata($code = null)
    {
        return new Metadata($this->getName(), (!is_null($code) ? $code : $this->getName()), false, 'SonataBlockBundle', [
            'class' => 'fa fa-file-image-o',
        ]);
    }
}