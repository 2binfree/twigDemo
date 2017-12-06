<?php

namespace AppBundle\Twig;

class TwigExtension extends \Twig_Extension
{
    public function getFilters()
    {
        return array(
            new \Twig_SimpleFilter('allInOne', [$this, 'allInOneFilter'], [
                'needs_environment' => true,
            ]),
        );
    }

    public function allInOneFilter(\Twig_Environment $env, $value, $filterName, $arg)
    {
        $twigFilter = $env->getFilter($filterName);

        if (!$twigFilter) {
            return $value;
        }
        $args = [];
        if ($twigFilter->needsEnvironment()) {
            $args[] = $env;
        }
        $args[] = $value;
        if (!is_null($arg)) {
            $args = array_merge($args, $arg);
        }
        return call_user_func_array($twigFilter->getCallable(), $args);
    }
}