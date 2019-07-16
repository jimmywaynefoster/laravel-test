<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\URL;
use Laravel\Lumen\Routing\Controller as BaseController;

class Controller extends BaseController
{
    public function formatResponse( $meta , $data, $paginate , string $message, int $code)
    {
        $output = [
            'meta' => $meta,
            'links' => $paginate,
            'data' => $data,
        ];
        if (!isset($output['paginate'])) {
            unset($output['paginate']);
        }
        if (!isset($output['response'])) {
            unset($output['response']);
        }
        return response()->json($output, 200);
    }

    public function meta($raw)
    {
        $object = new \stdClass;
        $object->to = $raw->lastItem();
        $object->total = $raw->total();
        return $object;
    }

    public function formatPaging($raw)
    {
        $object = new \stdClass;
        $object->first = URL::current()."?page=".$raw->firstItem();
        $object->last = URL::current()."?page=".$raw->lastPage();
        $object->next = $raw->nextPageUrl();
        $object->prev = $raw->previousPageUrl();
        return $object;
    }
}
