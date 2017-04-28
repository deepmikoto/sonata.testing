<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class AppController extends Controller
{
    /**
     * @param $locale
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     *
     * @Route(name="app_select_language", path="/app/select-language/{locale}")
     */
    public function selectLanguageAction($locale, Request $request)
    {
        $supportedLocales = $this->getParameter('locales');
        if (in_array($locale, $supportedLocales)) {
            $this->get('session')->set('_locale', $locale);

            return $this->redirect($request->headers->get('referer'));
        }

        throw $this->createNotFoundException("Unsupported locale: \"{$locale}\"");
    }
}
