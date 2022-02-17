<?php

namespace Afdn\Permission;

use Illuminate\Routing\ResourceRegistrar;

class AppResourceRegistrar extends ResourceRegistrar
{
    protected function addResourceUpdate($name, $base, $controller, $options)
    {
        $name = $this->getShallowName($name, $options);

        $uri = $this->getResourceUri($name)."-update";

        $action = $this->getResourceAction($name, $controller, 'update', $options);
        
        return $this->router->post($uri, $action);
        // return $this->router->match(['PUT', 'PATCH'], $uri."-edit", $action);
    }

    protected function addResourceDestroy($name, $base, $controller, $options)
    {
        $name = $this->getShallowName($name, $options);

        $uri = $this->getResourceUri($name."-destroy");
        unset($options['missing']);

        $action = $this->getResourceAction($name, $controller, 'destroy', $options);

        return $this->router->post($uri, $action);
    }
}
