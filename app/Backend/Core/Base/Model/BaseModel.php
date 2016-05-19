<?php
namespace App\Backend\Core\Base\Model;

use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model{
    public function getTableColumns() {

        return $this->getConnection()->getSchemaBuilder()->getColumnListing($this->getTable());
    }

}