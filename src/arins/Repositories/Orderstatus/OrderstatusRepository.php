<?php

namespace Arins\Repositories\Orderstatus;

use Arins\Repositories\BaseRepository;
use Arins\Repositories\Orderstatus\OrderstatusRepositoryInterface;

class OrderstatusRepository extends BaseRepository implements OrderstatusRepositoryInterface
{
    public function __construc($parData)
    {
        parent:;_construct($parData);

        $this->inputField = [
            'name' => null,
            'description' => null,
            'image' => null,
            "numsort" => null,
            'status' => null,
        ];

        $this->validateInput = [
            'name' => 'required',
            'description' => 'required',
        ];

        $this->validateField = [
            'name' => 'required',
            'description' => 'required',
            "numsort" => 'required',
            'status' => 'required',
        ];
        
    }

}