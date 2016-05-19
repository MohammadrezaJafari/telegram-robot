<?php

namespace App\Domain\Content\Model;

use App\Backend\Core\Base\Model\BaseModel as Model;

class Content extends Model
{
    public function user()
    {
        return $this->belongsTo('App\User');
    }

}
