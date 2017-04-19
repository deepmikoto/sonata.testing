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

class BreadcrumbBlock extends AbstractAdminBlockService
{
    public function configureSettings(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'template'             => 'AppBundle:blocks:breadcrumb_block.html.twig',
            'separator'            => null,
            'current_class'        => null,
            'last_separator'       => null,
            'force_view_home_page' => false,
        ]);
    }

    public function execute(BlockContextInterface $blockContext, Response $response = null)
    {
        $settings = $blockContext->getSettings();

        return $this->renderResponse($blockContext->getTemplate(),[
            'block' => $blockContext->getBlock(),
            'settings' => $settings
        ], $response);
    }

    /**
     * {@inheritdoc}
     */
    public function buildEditForm(FormMapper $formMapper, BlockInterface $block)
    {
        $formMapper->add('settings', 'sonata_type_immutable_array', [
            'keys' => [
                ['current_class', 'text', [
                    'required' => false,
                    'label'    => 'Current class'
                ]],
                ['separator', 'text', [
                    'required' => false,
                    'label'    => 'Separator'
                ]],
                ['last_separator', 'text', [
                    'required' => false,
                    'label'    => 'Last separator'
                ]],
                ['force_view_home_page', 'checkbox', [
                    'required' => false,
                    'label'    => 'Force homepage display'
                ]],
            ],
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockMetadata($code = null)
    {
        return new Metadata($this->getName(), (!is_null($code) ? $code : $this->getName()), false, 'SonataBlockBundle', [
            'class' => 'fa fa-angle-double-right',
        ]);
    }
}