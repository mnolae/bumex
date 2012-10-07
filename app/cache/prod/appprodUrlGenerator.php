<?php

use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\Exception\RouteNotFoundException;


/**
 * appprodUrlGenerator
 *
 * This class has been auto-generated
 * by the Symfony Routing Component.
 */
class appprodUrlGenerator extends Symfony\Component\Routing\Generator\UrlGenerator
{
    static private $declaredRouteNames = array(
       'index' => true,
       'expedientes' => true,
       'historial' => true,
    );

    /**
     * Constructor.
     */
    public function __construct(RequestContext $context)
    {
        $this->context = $context;
    }

    public function generate($name, $parameters = array(), $absolute = false)
    {
        if (!isset(self::$declaredRouteNames[$name])) {
            throw new RouteNotFoundException(sprintf('Route "%s" does not exist.', $name));
        }

        $escapedName = str_replace('.', '__', $name);

        list($variables, $defaults, $requirements, $tokens) = $this->{'get'.$escapedName.'RouteInfo'}();

        return $this->doGenerate($variables, $defaults, $requirements, $tokens, $parameters, $name, $absolute);
    }

    private function getindexRouteInfo()
    {
        return array(array (), array (  '_controller' => 'Bumex\\BasicBundle\\Controller\\IndexController::indexAction',), array (), array (  0 =>   array (    0 => 'text',    1 => '/index/',  ),));
    }

    private function getexpedientesRouteInfo()
    {
        return array(array (), array (  '_controller' => 'Bumex\\BasicBundle\\Controller\\IndexController::expedientesAction',), array (), array (  0 =>   array (    0 => 'text',    1 => '/expedientes/',  ),));
    }

    private function gethistorialRouteInfo()
    {
        return array(array (  0 => 'page',), array (  '_controller' => 'Bumex\\BasicBundle\\Controller\\IndexController::historialAction',  'page' => '1',), array (), array (  0 =>   array (    0 => 'variable',    1 => '/',    2 => '[^/]+?',    3 => 'page',  ),  1 =>   array (    0 => 'text',    1 => '/historial',  ),));
    }
}
