<?php
/**
 * Created by PhpStorm.
 * User: alexandru.vasileniuc
 * Date: 28.04.2017
 * Time: 11:35
 */

namespace AppBundle\EventListeners;


use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;

/**
 * Class LocaleListener
 * @package AppBundle\EventListeners
 */
class LocaleListener
{
    /**
     * @var Session
     */
    private $session;

    /**
     * @var string
     */
    private $locale;

    /**
     * LocaleListener constructor.
     * @param Session $session
     * @param $locale
     */
    public function __construct(Session $session, $locale)
    {
        $this->session = $session;
        $this->locale  = $locale;
    }

    /**
     * @param GetResponseEvent $event
     */
    public function onKernelRequest(GetResponseEvent $event)
    {
        if ($event->isMasterRequest()) {
            $request = $event->getRequest();
            /**
             * default locale
             */
            $locale = $this->locale;
            if ($this->session->has('_locale')) {
                /**
                 * selected locale if it exists
                 */
                $locale = $this->session->get('_locale');
            }
            $request->setLocale($locale);
        }
    }
}