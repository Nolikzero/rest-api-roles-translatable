<?php

namespace App\Transformers;
use App\Entity\User;
use League\Fractal\TransformerAbstract;

class ExceptionTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @param string $message
     * @return string
     */
    public function transform(string $message)
    {
        return [
            'message' => $message
        ];
    }

}
