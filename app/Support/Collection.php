<?php

namespace App\Support;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection as BaseCollection;

class Collection extends BaseCollection
{
    // solution to do pagination on $collection: https://gist.github.com/simonhamp/549e8821946e2c40a617c85d2cf5af5e
    public function paginate($perPage, $total = null, $page = null, $pageName = 'page')
    {
        $page = $page ?: LengthAwarePaginator::resolveCurrentPage($pageName);

        return new LengthAwarePaginator(
            $this->forPage($page, $perPage),
            $total ?: $this->count(),
            $perPage,
            $page,
            [
                'path' => LengthAwarePaginator::resolveCurrentPath(),
                'pageName' => $pageName,
            ]
        );
    }
}
