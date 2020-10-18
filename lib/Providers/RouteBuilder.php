<?php


namespace Sarps\Providers;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\Matcher\UrlMatcher;


class RouteBuilder
{
    /**
     * @var RouteCollection
     */
    private $routes;
    /**
     * @var RequestContext
     */
    private $context;

    public function __construct()
    {
        $this->routes = new RouteCollection();
        $this->context = new RequestContext();
    }

    public function add($name, $path) {
        $this->routes->add($name, new Route($path));
        return $this;
    }

    public function match() {
        $request = Request::createFromGlobals();
        $this->context->fromRequest($request);
        $matcher = new UrlMatcher($this->routes, $this->context);
        return $matcher->match($request->getPathInfo());
    }
}