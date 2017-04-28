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
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\NotNull;
use Symfony\Component\Validator\Constraints\Url;

class BigPictureTitleBlock extends AbstractAdminBlockService
{
    use EntityManagerAwareBlockTrait;

    /**
     * {@inheritdoc}
     */
    public function configureSettings(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'image'     => null,
            'template'  => 'AppBundle:blocks:big_picture_title_block.html.twig'
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
        $formMapper->add('settings', 'sonata_type_immutable_array', array(
            'keys' => array(
                ['image', 'text', [
                    'required' => false,
                    'constraints' => [
                        new NotNull(),
                        new NotBlank(),
                        new Url()
                    ]
                ]],
            ),
        ));
        $formMapper->add('translations', 'a2lix_translations',[
            'label' => 'app.form.label.translatable_fields',
            'fields' => [
                'translatableFields' => [
                    'label' => false,
                    'field_type' => 'sonata_type_immutable_array',
                    'keys' => [
                        ['title', 'text', [
                            'required' => false,
                            'constraints' => [
                                new NotNull(),
                                new NotBlank(),
                                new Length([
                                    'max' => 30
                                ])
                            ]
                        ]],
                        ['subtitle', 'text', ['required' => false]]
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