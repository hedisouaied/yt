<?php

/**
 * Created by PhpStorm
 * User: ProgrammerHasan
 * Date: 01-05-2021
 * Time: 9:16 PM
 */

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Response;

class HtmlMinifier
{
    public function handle($request, Closure $next)
    {

        $response = $next($request);

        $contentType = $response->headers->get('Content-Type');
        if (strpos($contentType, 'text/html') !== false) {
            $response->setContent($this->minify2($response->getContent()));
        }

        return $response;
    }



    public function minify2($input)
    {
        $search = [
            '/\>\s+/s',
            '/\s+</s',
            '/\<\!--.*?-->/',
        ];

        $replace = [
            '> ',
            ' <',
            "",
        ];

        return preg_replace($search, $replace, $input);
    }
}
