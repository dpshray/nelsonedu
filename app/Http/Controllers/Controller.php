<?php

namespace App\Http\Controllers;

abstract class Controller
{
    protected $data = [];

    protected function redirectWithSuccess(string $route, string $message, $param = null)
    {
        flash()
            ->option('position', 'bottom-right')
            ->option('timeout', 3000)
            ->success($message);

        if ($param) {
            return redirect()->route($route, $param);
        }

        return redirect()->route($route);
    }

    protected function backWithError(string $message)
    {
        flash()
            ->option('position', 'bottom-right')
            ->option('timeout', 3000)
            ->error($message);

        return back();
    }

    protected function backWithSuccess(string $message)
    {
        flash()
            ->option('position', 'bottom-right')
            ->option('timeout', 3000)
            ->success($message);

        return back();
    }
}
