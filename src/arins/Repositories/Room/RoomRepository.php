<?php

namespace Arins\Repositories\Room;

use Arins\Repositories\BaseRepository;
use Arins\Repositories\Room\RoomRepositoryInterface;

class RoomRepository extends BaseRepository implements RoomRepositoryInterface
{
    public function __construct($parData)
    {
        parent::__construct($parData);

        $this->inputField = [
            //code array here...
            'code' => null,
            'name' => null,
            'displayname' => null,
            'description' => null,
            'numsort' => null,
            'status' => null
        ];

        $this->validateField = [
            //code array here...
            'code' => 'required',
            'name' => 'required',
            'displayname' => 'required',
            'description' => 'required',
        ];

    }

}