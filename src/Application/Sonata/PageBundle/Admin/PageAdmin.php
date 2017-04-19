<?php
/**
 * Created by PhpStorm.
 * User: alexandru.vasileniuc
 * Date: 18.04.2017
 * Time: 17:47
 */

namespace Application\Sonata\PageBundle\Admin;

use Sonata\PageBundle\Admin\PageAdmin as BaseAdmin;
use Sonata\AdminBundle\Form\FormMapper;


class PageAdmin extends BaseAdmin
{
    /**
     * {@inheritdoc}
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        // define group zoning
        $formMapper
            ->with('form_page.group_main_label', array('class' => 'col-md-6'))->end()
            ->with('form_page.group_seo_label', array('class' => 'col-md-6'))->end()
            ->with('form_page.group_advanced_label', array('class' => 'col-md-6'))->end()
        ;

        if (!$this->getSubject() || (!$this->getSubject()->isInternal() && !$this->getSubject()->isError())) {
            $formMapper
                ->with('form_page.group_main_label')
                ->add('url', 'text', array('attr' => array('readonly' => 'readonly')))
                ->end()
            ;
        }

        if ($this->hasSubject() && !$this->getSubject()->getId()) {
            $formMapper
                ->with('form_page.group_main_label')
                ->add('site', null, array('required' => true, 'read_only' => true))
                ->end()
            ;
        }

        $formMapper
            ->with('form_page.group_main_label')
            ->add('name')
            ->add('enabled', null, array('required' => false))
            ->add('showInMenus', null, array(
                'required' => false,
                'label' => 'Show in menus'
            ))
            ->add('position')
            ->end()
        ;

        if ($this->hasSubject() && !$this->getSubject()->isInternal()) {
            $formMapper
                ->with('form_page.group_main_label')
                ->add('type', 'sonata_page_type_choice', array('required' => false))
                ->end()
            ;
        }

        $formMapper
            ->with('form_page.group_main_label')
            ->add('templateCode', 'sonata_page_template', array('required' => true))
            ->end()
        ;

        if (!$this->getSubject() || ($this->getSubject() && $this->getSubject()->getParent()) || ($this->getSubject() && !$this->getSubject()->getId())) {
            $formMapper
                ->with('form_page.group_main_label')
                ->add('parent', 'sonata_page_selector', array(
                    'page' => $this->getSubject() ?: null,
                    'site' => $this->getSubject() ? $this->getSubject()->getSite() : null,
                    'model_manager' => $this->getModelManager(),
                    'class' => $this->getClass(),
                    'required' => false,
                    'filter_choice' => array('hierarchy' => 'root'),
                ), array(
                    'admin_code' => $this->getCode(),
                    'link_parameters' => array(
                        'siteId' => $this->getSubject() ? $this->getSubject()->getSite()->getId() : null,
                    ),
                ))
                ->end()
            ;
        }

        if (!$this->getSubject() || !$this->getSubject()->isDynamic()) {
            $formMapper
                ->with('form_page.group_main_label')
                ->add('pageAlias', null, array('required' => false))
                ->add('target', 'sonata_page_selector', array(
                    'page' => $this->getSubject() ?: null,
                    'site' => $this->getSubject() ? $this->getSubject()->getSite() : null,
                    'model_manager' => $this->getModelManager(),
                    'class' => $this->getClass(),
                    'filter_choice' => array('request_method' => 'all'),
                    'required' => false,
                ), array(
                    'admin_code' => $this->getCode(),
                    'link_parameters' => array(
                        'siteId' => $this->getSubject() ? $this->getSubject()->getSite()->getId() : null,
                    ),
                ))
                ->end()
            ;
        }

        if (!$this->getSubject() || !$this->getSubject()->isHybrid()) {
            $formMapper
                ->with('form_page.group_seo_label')
                ->add('slug', 'text', array('required' => false))
                ->add('customUrl', 'text', array('required' => false))
                ->end()
            ;
        }

        $formMapper
            ->with('form_page.group_seo_label', array('collapsed' => true))
            ->add('title', null, array('required' => false))
            ->add('metaKeyword', 'textarea', array('required' => false))
            ->add('metaDescription', 'textarea', array('required' => false))
            ->end()
        ;

        if ($this->hasSubject() && !$this->getSubject()->isCms()) {
            $formMapper
                ->with('form_page.group_advanced_label', array('collapsed' => true))
                ->add('decorate', null, array('required' => false))
                ->end()
            ;
        }

        $formMapper
            ->with('form_page.group_advanced_label', array('collapsed' => true))
            ->add('javascript', null, array('required' => false))
            ->add('stylesheet', null, array('required' => false))
            ->add('rawHeaders', null, array('required' => false))
            ->end()
        ;

        $formMapper->setHelps(array(
            'name' => 'help_page_name',
        ));
    }
}