<?php

use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\Exception\RouteNotFoundException;
use Psr\Log\LoggerInterface;

/**
 * This class has been auto-generated
 * by the Symfony Routing Component.
 */
class srcDevDebugProjectContainerUrlGenerator extends Symfony\Component\Routing\Generator\UrlGenerator
{
    private static $declaredRoutes;
    private $defaultLocale;

    public function __construct(RequestContext $context, LoggerInterface $logger = null, string $defaultLocale = null)
    {
        $this->context = $context;
        $this->logger = $logger;
        $this->defaultLocale = $defaultLocale;
        if (null === self::$declaredRoutes) {
            self::$declaredRoutes = array(
        'artiste' => array(array(), array('_controller' => 'App\\Controller\\ArtisteController::index'), array(), array(array('text', '/artiste')), array(), array()),
        'ajouter_artiste' => array(array(), array('_controller' => 'App\\Controller\\ArtisteController::addAction'), array(), array(array('text', '/artiste/add')), array(), array()),
        'supprimer_artiste' => array(array('id'), array('_controller' => 'App\\Controller\\ArtisteController::removeAction'), array(), array(array('variable', '/', '[^/]++', 'id'), array('text', '/artiste/remove')), array(), array()),
        'modifier_artiste' => array(array('id'), array('_controller' => 'App\\Controller\\ArtisteController::updateAction'), array(), array(array('variable', '/', '[^/]++', 'id'), array('text', '/artiste/update')), array(), array()),
        'api_artiste' => array(array(), array('_controller' => 'App\\Controller\\ArtisteControllerAPI::index'), array(), array(array('text', '/api/artiste')), array(), array()),
        'api_ajouter_artiste' => array(array(), array('_controller' => 'App\\Controller\\ArtisteControllerAPI::addAction'), array(), array(array('text', '/api/artiste/add')), array(), array()),
        'api_supprimer_artiste' => array(array('id'), array('_controller' => 'App\\Controller\\ArtisteControllerAPI::removeAction'), array(), array(array('variable', '/', '[^/]++', 'id'), array('text', '/api/artiste/remove')), array(), array()),
        'api_modifier_artiste' => array(array('id'), array('_controller' => 'App\\Controller\\ArtisteControllerAPI::updateAction'), array(), array(array('variable', '/', '[^/]++', 'id'), array('text', '/api/artiste/update')), array(), array()),
        'morceau' => array(array(), array('_controller' => 'App\\Controller\\MorceauController::index'), array(), array(array('text', '/morceau')), array(), array()),
        'ajouter_morceau' => array(array(), array('_controller' => 'App\\Controller\\MorceauController::addAction'), array(), array(array('text', '/morceau/add')), array(), array()),
        'supprimer_morceau' => array(array('id'), array('_controller' => 'App\\Controller\\MorceauController::removeAction'), array(), array(array('variable', '/', '[^/]++', 'id'), array('text', '/morceau/remove')), array(), array()),
        'modifier_morceau' => array(array('id'), array('_controller' => 'App\\Controller\\MorceauController::updateAction'), array(), array(array('variable', '/', '[^/]++', 'id'), array('text', '/morceau/update')), array(), array()),
        'api_morceau' => array(array(), array('_controller' => 'App\\Controller\\MorceauControllerAPI::index'), array(), array(array('text', '/api/morceau')), array(), array()),
        'api_ajouter_morceau' => array(array(), array('_controller' => 'App\\Controller\\MorceauControllerAPI::addAction'), array(), array(array('text', '/api/morceau/add')), array(), array()),
        'api_supprimer_morceau' => array(array('id'), array('_controller' => 'App\\Controller\\MorceauControllerAPI::removeAction'), array(), array(array('variable', '/', '[^/]++', 'id'), array('text', '/api/morceau/remove')), array(), array()),
        'api_modifier_morceau' => array(array('id'), array('_controller' => 'App\\Controller\\MorceauControllerAPI::updateAction'), array(), array(array('variable', '/', '[^/]++', 'id'), array('text', '/api/morceau/update')), array(), array()),
        '_twig_error_test' => array(array('code', '_format'), array('_controller' => 'twig.controller.preview_error::previewErrorPageAction', '_format' => 'html'), array('code' => '\\d+'), array(array('variable', '.', '[^/]++', '_format'), array('variable', '/', '\\d+', 'code'), array('text', '/_error')), array(), array()),
        '_wdt' => array(array('token'), array('_controller' => 'web_profiler.controller.profiler::toolbarAction'), array(), array(array('variable', '/', '[^/]++', 'token'), array('text', '/_wdt')), array(), array()),
        '_profiler_home' => array(array(), array('_controller' => 'web_profiler.controller.profiler::homeAction'), array(), array(array('text', '/_profiler/')), array(), array()),
        '_profiler_search' => array(array(), array('_controller' => 'web_profiler.controller.profiler::searchAction'), array(), array(array('text', '/_profiler/search')), array(), array()),
        '_profiler_search_bar' => array(array(), array('_controller' => 'web_profiler.controller.profiler::searchBarAction'), array(), array(array('text', '/_profiler/search_bar')), array(), array()),
        '_profiler_phpinfo' => array(array(), array('_controller' => 'web_profiler.controller.profiler::phpinfoAction'), array(), array(array('text', '/_profiler/phpinfo')), array(), array()),
        '_profiler_search_results' => array(array('token'), array('_controller' => 'web_profiler.controller.profiler::searchResultsAction'), array(), array(array('text', '/search/results'), array('variable', '/', '[^/]++', 'token'), array('text', '/_profiler')), array(), array()),
        '_profiler_open_file' => array(array(), array('_controller' => 'web_profiler.controller.profiler::openAction'), array(), array(array('text', '/_profiler/open')), array(), array()),
        '_profiler' => array(array('token'), array('_controller' => 'web_profiler.controller.profiler::panelAction'), array(), array(array('variable', '/', '[^/]++', 'token'), array('text', '/_profiler')), array(), array()),
        '_profiler_router' => array(array('token'), array('_controller' => 'web_profiler.controller.router::panelAction'), array(), array(array('text', '/router'), array('variable', '/', '[^/]++', 'token'), array('text', '/_profiler')), array(), array()),
        '_profiler_exception' => array(array('token'), array('_controller' => 'web_profiler.controller.exception::showAction'), array(), array(array('text', '/exception'), array('variable', '/', '[^/]++', 'token'), array('text', '/_profiler')), array(), array()),
        '_profiler_exception_css' => array(array('token'), array('_controller' => 'web_profiler.controller.exception::cssAction'), array(), array(array('text', '/exception.css'), array('variable', '/', '[^/]++', 'token'), array('text', '/_profiler')), array(), array()),
    );
        }
    }

    public function generate($name, $parameters = array(), $referenceType = self::ABSOLUTE_PATH)
    {
        $locale = $parameters['_locale']
            ?? $this->context->getParameter('_locale')
            ?: $this->defaultLocale;

        if (null !== $locale && (self::$declaredRoutes[$name.'.'.$locale][1]['_canonical_route'] ?? null) === $name) {
            unset($parameters['_locale']);
            $name .= '.'.$locale;
        } elseif (!isset(self::$declaredRoutes[$name])) {
            throw new RouteNotFoundException(sprintf('Unable to generate a URL for the named route "%s" as such route does not exist.', $name));
        }

        list($variables, $defaults, $requirements, $tokens, $hostTokens, $requiredSchemes) = self::$declaredRoutes[$name];

        return $this->doGenerate($variables, $defaults, $requirements, $tokens, $parameters, $name, $referenceType, $hostTokens, $requiredSchemes);
    }
}
