<?php

use Symfony\Component\Routing\Exception\MethodNotAllowedException;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Symfony\Component\Routing\RequestContext;

/**
 * This class has been auto-generated
 * by the Symfony Routing Component.
 */
class srcDevDebugProjectContainerUrlMatcher extends Symfony\Bundle\FrameworkBundle\Routing\RedirectableUrlMatcher
{
    public function __construct(RequestContext $context)
    {
        $this->context = $context;
    }

    public function match($pathinfo)
    {
        $allow = $allowSchemes = array();
        if ($ret = $this->doMatch($pathinfo, $allow, $allowSchemes)) {
            return $ret;
        }
        if ($allow) {
            throw new MethodNotAllowedException(array_keys($allow));
        }
        if (!in_array($this->context->getMethod(), array('HEAD', 'GET'), true)) {
            // no-op
        } elseif ($allowSchemes) {
            redirect_scheme:
            $scheme = $this->context->getScheme();
            $this->context->setScheme(key($allowSchemes));
            try {
                if ($ret = $this->doMatch($pathinfo)) {
                    return $this->redirect($pathinfo, $ret['_route'], $this->context->getScheme()) + $ret;
                }
            } finally {
                $this->context->setScheme($scheme);
            }
        } elseif ('/' !== $pathinfo) {
            $pathinfo = '/' !== $pathinfo[-1] ? $pathinfo.'/' : substr($pathinfo, 0, -1);
            if ($ret = $this->doMatch($pathinfo, $allow, $allowSchemes)) {
                return $this->redirect($pathinfo, $ret['_route']) + $ret;
            }
            if ($allowSchemes) {
                goto redirect_scheme;
            }
        }

        throw new ResourceNotFoundException();
    }

    private function doMatch(string $rawPathinfo, array &$allow = array(), array &$allowSchemes = array()): ?array
    {
        $allow = $allowSchemes = array();
        $pathinfo = rawurldecode($rawPathinfo);
        $context = $this->context;
        $requestMethod = $canonicalMethod = $context->getMethod();

        if ('HEAD' === $requestMethod) {
            $canonicalMethod = 'GET';
        }

        switch ($pathinfo) {
            default:
                $routes = array(
                    '/artiste' => array(array('_route' => 'artiste', '_controller' => 'App\\Controller\\ArtisteController::index'), null, null, null),
                    '/artiste/add' => array(array('_route' => 'ajouter_artiste', '_controller' => 'App\\Controller\\ArtisteController::addAction'), null, null, null),
                    '/api/artiste' => array(array('_route' => 'api_artiste', '_controller' => 'App\\Controller\\ArtisteControllerAPI::index'), null, array('GET' => 0), null),
                    '/api/artiste/add' => array(array('_route' => 'api_ajouter_artiste', '_controller' => 'App\\Controller\\ArtisteControllerAPI::addAction'), null, array('POST' => 0), null),
                    '/morceau' => array(array('_route' => 'morceau', '_controller' => 'App\\Controller\\MorceauController::index'), null, null, null),
                    '/morceau/add' => array(array('_route' => 'ajouter_morceau', '_controller' => 'App\\Controller\\MorceauController::addAction'), null, null, null),
                    '/api/morceau' => array(array('_route' => 'api_morceau', '_controller' => 'App\\Controller\\MorceauControllerAPI::index'), null, array('GET' => 0), null),
                    '/api/morceau/add' => array(array('_route' => 'api_ajouter_morceau', '_controller' => 'App\\Controller\\MorceauControllerAPI::addAction'), null, array('POST' => 0), null),
                    '/_profiler/' => array(array('_route' => '_profiler_home', '_controller' => 'web_profiler.controller.profiler::homeAction'), null, null, null),
                    '/_profiler/search' => array(array('_route' => '_profiler_search', '_controller' => 'web_profiler.controller.profiler::searchAction'), null, null, null),
                    '/_profiler/search_bar' => array(array('_route' => '_profiler_search_bar', '_controller' => 'web_profiler.controller.profiler::searchBarAction'), null, null, null),
                    '/_profiler/phpinfo' => array(array('_route' => '_profiler_phpinfo', '_controller' => 'web_profiler.controller.profiler::phpinfoAction'), null, null, null),
                    '/_profiler/open' => array(array('_route' => '_profiler_open_file', '_controller' => 'web_profiler.controller.profiler::openAction'), null, null, null),
                );

                if (!isset($routes[$pathinfo])) {
                    break;
                }
                list($ret, $requiredHost, $requiredMethods, $requiredSchemes) = $routes[$pathinfo];

                $hasRequiredScheme = !$requiredSchemes || isset($requiredSchemes[$context->getScheme()]);
                if ($requiredMethods && !isset($requiredMethods[$canonicalMethod]) && !isset($requiredMethods[$requestMethod])) {
                    if ($hasRequiredScheme) {
                        $allow += $requiredMethods;
                    }
                    break;
                }
                if (!$hasRequiredScheme) {
                    $allowSchemes += $requiredSchemes;
                    break;
                }

                return $ret;
        }

        $matchedPathinfo = $pathinfo;
        $regexList = array(
            0 => '{^(?'
                    .'|/a(?'
                        .'|rtiste/(?'
                            .'|remove/([^/]++)(*:37)'
                            .'|update/([^/]++)(*:59)'
                        .')'
                        .'|pi/(?'
                            .'|artiste/(?'
                                .'|remove/([^/]++)(*:99)'
                                .'|update/([^/]++)(*:121)'
                            .')'
                            .'|morceau/(?'
                                .'|remove/([^/]++)(*:156)'
                                .'|update/([^/]++)(*:179)'
                            .')'
                        .')'
                    .')'
                    .'|/morceau/(?'
                        .'|remove/([^/]++)(*:217)'
                        .'|update/([^/]++)(*:240)'
                    .')'
                    .'|/_(?'
                        .'|error/(\\d+)(?:\\.([^/]++))?(*:280)'
                        .'|wdt/([^/]++)(*:300)'
                        .'|profiler/([^/]++)(?'
                            .'|/(?'
                                .'|search/results(*:346)'
                                .'|router(*:360)'
                                .'|exception(?'
                                    .'|(*:380)'
                                    .'|\\.css(*:393)'
                                .')'
                            .')'
                            .'|(*:403)'
                        .')'
                    .')'
                .')$}sD',
        );

        foreach ($regexList as $offset => $regex) {
            while (preg_match($regex, $matchedPathinfo, $matches)) {
                switch ($m = (int) $matches['MARK']) {
                    default:
                        $routes = array(
                            37 => array(array('_route' => 'supprimer_artiste', '_controller' => 'App\\Controller\\ArtisteController::removeAction'), array('id'), null, null),
                            59 => array(array('_route' => 'modifier_artiste', '_controller' => 'App\\Controller\\ArtisteController::updateAction'), array('id'), null, null),
                            99 => array(array('_route' => 'api_supprimer_artiste', '_controller' => 'App\\Controller\\ArtisteControllerAPI::removeAction'), array('id'), array('DELETE' => 0), null),
                            121 => array(array('_route' => 'api_modifier_artiste', '_controller' => 'App\\Controller\\ArtisteControllerAPI::updateAction'), array('id'), array('PUT' => 0), null),
                            156 => array(array('_route' => 'api_supprimer_morceau', '_controller' => 'App\\Controller\\MorceauControllerAPI::removeAction'), array('id'), array('DELETE' => 0), null),
                            179 => array(array('_route' => 'api_modifier_morceau', '_controller' => 'App\\Controller\\MorceauControllerAPI::updateAction'), array('id'), array('PUT' => 0), null),
                            217 => array(array('_route' => 'supprimer_morceau', '_controller' => 'App\\Controller\\MorceauController::removeAction'), array('id'), null, null),
                            240 => array(array('_route' => 'modifier_morceau', '_controller' => 'App\\Controller\\MorceauController::updateAction'), array('id'), null, null),
                            280 => array(array('_route' => '_twig_error_test', '_controller' => 'twig.controller.preview_error::previewErrorPageAction', '_format' => 'html'), array('code', '_format'), null, null),
                            300 => array(array('_route' => '_wdt', '_controller' => 'web_profiler.controller.profiler::toolbarAction'), array('token'), null, null),
                            346 => array(array('_route' => '_profiler_search_results', '_controller' => 'web_profiler.controller.profiler::searchResultsAction'), array('token'), null, null),
                            360 => array(array('_route' => '_profiler_router', '_controller' => 'web_profiler.controller.router::panelAction'), array('token'), null, null),
                            380 => array(array('_route' => '_profiler_exception', '_controller' => 'web_profiler.controller.exception::showAction'), array('token'), null, null),
                            393 => array(array('_route' => '_profiler_exception_css', '_controller' => 'web_profiler.controller.exception::cssAction'), array('token'), null, null),
                            403 => array(array('_route' => '_profiler', '_controller' => 'web_profiler.controller.profiler::panelAction'), array('token'), null, null),
                        );

                        list($ret, $vars, $requiredMethods, $requiredSchemes) = $routes[$m];

                        foreach ($vars as $i => $v) {
                            if (isset($matches[1 + $i])) {
                                $ret[$v] = $matches[1 + $i];
                            }
                        }

                        $hasRequiredScheme = !$requiredSchemes || isset($requiredSchemes[$context->getScheme()]);
                        if ($requiredMethods && !isset($requiredMethods[$canonicalMethod]) && !isset($requiredMethods[$requestMethod])) {
                            if ($hasRequiredScheme) {
                                $allow += $requiredMethods;
                            }
                            break;
                        }
                        if (!$hasRequiredScheme) {
                            $allowSchemes += $requiredSchemes;
                            break;
                        }

                        return $ret;
                }

                if (403 === $m) {
                    break;
                }
                $regex = substr_replace($regex, 'F', $m - $offset, 1 + strlen($m));
                $offset += strlen($m);
            }
        }
        if ('/' === $pathinfo && !$allow && !$allowSchemes) {
            throw new Symfony\Component\Routing\Exception\NoConfigurationException();
        }

        return null;
    }
}
