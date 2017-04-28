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
use Symfony\Component\Validator\Constraints\Count;

class TagsBlock extends AbstractAdminBlockService
{
    use EntityManagerAwareBlockTrait;

    /**
     * {@inheritdoc}
     */
    public function configureSettings(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'template'  => 'AppBundle:blocks:tags_block.html.twig'
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
        if ($block->getId()) {
            $formMapper
                ->add('tagCollection', 'sonata_type_collection', [
                    'by_reference'       => false,
                    'cascade_validation' => true,
                    'label'              => 'form.label.tag_collection',
                    'translation_domain' => 'AppBundle',
                    'constraints'        => [
                        new Count(
                            [
                                'min' => 1,
                                'minMessage' => "app.form.contact_page_subject_min"
                            ]
                        ),
                    ],
                ], [
                        'edit'     => 'inline',
                        'inline'   => 'table',
                        'sortable' => 'position',
                    ]
                )
            ;
        } else {
            $formMapper
                ->end()
                ->with('Please save, then update this block to add tags')
                    ->add('dummy', 'hidden', [
                        'mapped' => false
                    ])
                ->end()
            ;
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockMetadata($code = null)
    {
        return new Metadata($this->getName(), (!is_null($code) ? $code : $this->getName()), false, 'SonataBlockBundle', [
            'class' => ' fa fa-file-text',
        ]);
    }
}