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

    public function match($rawPathinfo)
    {
        $allow = array();
        $pathinfo = rawurldecode($rawPathinfo);
        $trimmedPathinfo = rtrim($pathinfo, '/');
        $context = $this->context;
        $request = $this->request ?: $this->createRequest($pathinfo);
        $requestMethod = $canonicalMethod = $context->getMethod();

        if ('HEAD' === $requestMethod) {
            $canonicalMethod = 'GET';
        }

        // api
        if ('/api' === $pathinfo) {
            return array (  '_controller' => 'App\\Controller\\ApiController::index',  '_route' => 'api',);
        }

        if (0 === strpos($pathinfo, '/bien')) {
            // bien
            if ('/bien' === $pathinfo) {
                $ret = array (  '_controller' => 'App\\Controller\\ApiController::getBienAction',  '_route' => 'bien',);
                if (!in_array($canonicalMethod, array('GET'))) {
                    $allow = array_merge($allow, array('GET'));
                    goto not_bien;
                }

                return $ret;
            }
            not_bien:

            // bienid
            if (preg_match('#^/bien/(?P<id>[^/]++)$#sD', $pathinfo, $matches)) {
                $ret = $this->mergeDefaults(array_replace($matches, array('_route' => 'bienid')), array (  '_controller' => 'App\\Controller\\ApiController::getUnBienAction',));
                if (!in_array($canonicalMethod, array('GET'))) {
                    $allow = array_merge($allow, array('GET'));
                    goto not_bienid;
                }

                return $ret;
            }
            not_bienid:

        }

        // reservation
        if ('/reservation' === $pathinfo) {
            $ret = array (  '_controller' => 'App\\Controller\\ApiController::addReservAction',  '_route' => 'reservation',);
            if (!in_array($requestMethod, array('POST'))) {
                $allow = array_merge($allow, array('POST'));
                goto not_reservation;
            }

            return $ret;
        }
        not_reservation:

        // search
        if ('/search' === $pathinfo) {
            $ret = array (  '_controller' => 'App\\Controller\\ApiController::serchAction',  '_route' => 'search',);
            if (!in_array($requestMethod, array('POST'))) {
                $allow = array_merge($allow, array('POST'));
                goto not_search;
            }

            return $ret;
        }
        not_search:

        // localite
        if ('/localite' === $pathinfo) {
            $ret = array (  '_controller' => 'App\\Controller\\ApiController::getLocaliteAction',  '_route' => 'localite',);
            if (!in_array($canonicalMethod, array('GET'))) {
                $allow = array_merge($allow, array('GET'));
                goto not_localite;
            }

            return $ret;
        }
        not_localite:

        // type
        if ('/type' === $pathinfo) {
            $ret = array (  '_controller' => 'App\\Controller\\ApiController::gettypeAction',  '_route' => 'type',);
            if (!in_array($canonicalMethod, array('GET'))) {
                $allow = array_merge($allow, array('GET'));
                goto not_type;
            }

            return $ret;
        }
        not_type:

        if ('/' === $pathinfo) {
            throw new Symfony\Component\Routing\Exception\NoConfigurationException();
        }

        throw 0 < count($allow) ? new MethodNotAllowedException(array_unique($allow)) : new ResourceNotFoundException();
    }
}
