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
        if (0 === strpos($pathinfo, '/reservation') && preg_match('#^/reservation/(?P<id>[^/]++)$#sD', $pathinfo, $matches)) {
            $ret = $this->mergeDefaults(array_replace($matches, array('_route' => 'reservation')), array (  '_controller' => 'App\\Controller\\ApiController::addReservAction',));
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

        // saveContrat
        if (0 === strpos($pathinfo, '/saveContrat') && preg_match('#^/saveContrat/(?P<id>[^/]++)$#sD', $pathinfo, $matches)) {
            $ret = $this->mergeDefaults(array_replace($matches, array('_route' => 'saveContrat')), array (  '_controller' => 'App\\Controller\\ApiController::saveContrat',));
            if (!in_array($requestMethod, array('POST'))) {
                $allow = array_merge($allow, array('POST'));
                goto not_saveContrat;
            }

            return $ret;
        }
        not_saveContrat:

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

        // connexion
        if (0 === strpos($pathinfo, '/connexion') && preg_match('#^/connexion/(?P<id>[^/]++)$#sD', $pathinfo, $matches)) {
            $ret = $this->mergeDefaults(array_replace($matches, array('_route' => 'connexion')), array (  '_controller' => 'App\\Controller\\ApiController::ConnexionAction',));
            if (!in_array($requestMethod, array('POST'))) {
                $allow = array_merge($allow, array('POST'));
                goto not_connexion;
            }

            return $ret;
        }
        not_connexion:

        if (0 === strpos($pathinfo, '/Reservation')) {
            // Reservation
            if ('/Reservation' === $pathinfo) {
                $ret = array (  '_controller' => 'App\\Controller\\ApiController::getReservation',  '_route' => 'Reservation',);
                if (!in_array($canonicalMethod, array('GET'))) {
                    $allow = array_merge($allow, array('GET'));
                    goto not_Reservation;
                }

                return $ret;
            }
            not_Reservation:

            // ReservationId
            if (0 === strpos($pathinfo, '/ReservationId') && preg_match('#^/ReservationId/(?P<id>[^/]++)$#sD', $pathinfo, $matches)) {
                $ret = $this->mergeDefaults(array_replace($matches, array('_route' => 'ReservationId')), array (  '_controller' => 'App\\Controller\\ApiController::getOneReservation',));
                if (!in_array($canonicalMethod, array('GET'))) {
                    $allow = array_merge($allow, array('GET'));
                    goto not_ReservationId;
                }

                return $ret;
            }
            not_ReservationId:

        }

        if ('/' === $pathinfo) {
            throw new Symfony\Component\Routing\Exception\NoConfigurationException();
        }

        throw 0 < count($allow) ? new MethodNotAllowedException(array_unique($allow)) : new ResourceNotFoundException();
    }
}
