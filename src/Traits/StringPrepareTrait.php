<?php


namespace Jtrw\Process\Traits;


trait StringPrepareTrait
{
    protected function getSnakeCaseFromCamelCase(string $input): string
    {
        $pattern = '!([A-Z][A-Z0-9]*(?=$|[A-Z][a-z0-9])|[A-Za-z][a-z0-9]+)!';
        preg_match_all($pattern, $input, $matches);
        $ret = $matches[0];
        foreach ($ret as &$match) {
            $match = $match === strtoupper($match) ?
                strtolower($match) :
                lcfirst($match);
        }
        return implode('_', $ret);
    } // end getSnakeCaseFromCamelCase
}