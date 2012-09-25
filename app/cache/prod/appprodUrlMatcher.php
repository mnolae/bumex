<?php

use Symfony\Component\Routing\Exception\MethodNotAllowedException;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Symfony\Component\Routing\RequestContext;

/**
 * appprodUrlMatcher
 *
 * This class has been auto-generated
 * by the Symfony Routing Component.
 */
class appprodUrlMatcher extends Symfony\Bundle\FrameworkBundle\Routing\RedirectableUrlMatcher
{
    /**
     * Constructor.
     */
    public function __construct(RequestContext $context)
    {
        $this->context = $context;
    }

    public function match($pathinfo)
    {
        $allow = array();
        $pathinfo = urldecode($pathinfo);

        // index
        if (rtrim($pathinfo, '/') === '/index') {
            if (substr($pathinfo, -1) !== '/') {
                return $this->redirect($pathinfo.'/', 'index');
            }
            return array (  '_controller' => 'Bumex\\BasicBundle\\Controller\\IndexController::indexAction',  '_route' => 'index',);
        }

        // expedientes
        if (rtrim($pathinfo, '/') === '/expedientes') {
            if (substr($pathinfo, -1) !== '/') {
                return $this->redirect($pathinfo.'/', 'expedientes');
            }
            return array (  '_controller' => 'Bumex\\BasicBundle\\Controller\\IndexController::expedientesAction',  '_route' => 'expedientes',);
        }

        // historial
        if (rtrim($pathinfo, '/') === '/historial') {
            if (substr($pathinfo, -1) !== '/') {
                return $this->redirect($pathinfo.'/', 'historial');
            }
            return array (  '_controller' => 'Bumex\\BasicBundle\\Controller\\IndexController::historialAction',  '_route' => 'historial',);
        }

        throw 0 < count($allow) ? new MethodNotAllowedException(array_unique($allow)) : new ResourceNotFoundException();
    }
}