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

class RSSReaderBlock extends AbstractAdminBlockService
{
    public function configureSettings(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'url'       => false,
            'title'     => 'Insert the rss title',
            'template'  => 'AppBundle:blocks:rss_reader.html.twig'
        ]);
    }

    public function validateBlock(ErrorElement $errorElement, BlockInterface $block)
    {
        $errorElement
            ->with('settings.url')
                ->assertNotNull([])
                ->assertNotBlank()
            ->end()
            ->with('settings.title')
                ->assertNotNull(array())
                ->assertNotBlank()
                ->assertMaxLength(array('limit' => 50))
            ->end()
        ;
    }

    public function execute(BlockContextInterface $blockContext, Response $response = null)
    {
        $settings = $blockContext->getSettings();
        $feeds = false;

        if ($settings['url']) {
            $options = [
                'http' => [
                    'user_agent' => 'Sonata/RSS Reader',
                    'timeout' => 2
                ]
            ];

            $content = @file_get_contents($settings['url'], false, stream_context_create($options));

            if ($content) {
                try {
                    $feeds = new \SimpleXMLElement($content);
                    $feeds = $feeds->channel->item;
                } catch (\Exception $e) {
                    
                }
            }
        }

        return $this->renderResponse($blockContext->getTemplate(),[
            'feeds' => $feeds,
            'block' => $blockContext->getBlock(),
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
                array('url', 'url', array('required' => false)),
                array('title', 'text', array('required' => false)),
            ),
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockMetadata($code = null)
    {
        return new Metadata($this->getName(), (!is_null($code) ? $code : $this->getName()), false, 'SonataBlockBundle', [
            'class' => 'fa fa-rss-square',
        ]);
    }
}