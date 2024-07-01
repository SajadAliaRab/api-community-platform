<?php

namespace Tests\Feature\Model;

use  Illuminate\Database\Eloquent\Model;

trait ModelHelperTesting
{

    public function testInsertData() :void
    {
        $model= $this->model();
        $table = $model->getTable();
        $data= $model :: factory()->create()->toArray();
        $this->assertDatabaseHas($table,$data);

    }
    abstract protected function model():Model;
}
