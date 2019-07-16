<?php

use App\Models\Items;

class ProductTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testGetAll()
    {
        $response = $this->get('/get-items',['Authorization'=> 1]);
        $response->assertResponseOk();
        $response->seeJsonStructure([
            'meta'=>[
                'to',
                'total'
            ],
            'links'=>[
                'first',
                'last',
                'next',
                'prev'
            ],
            'data'=>[
                '*'=>[
                    'id',
                    'item_name',
                    'price',
                    'qty'
                ]
            ]

        ]);
    }

    public function testCannotGetAll()
    {
        $response = $this->get('/get-items');
        $response->assertResponseStatus(401);
    }

    public function testStoreItem()
    {
        $response = $this->post( '/item', [
            'name'=>'book again',
            'price'=>1500,
            'qty'=>5
        ], ['Authorization'=> 1]);

        $response->assertResponseStatus(201);
    }

    public function testCannotStoreItem()
    {
        $response = $this->post( '/item', [
            'name'=>'book again',
            'price'=>1500,
            'qty'=>5
        ]);

        $response->assertResponseStatus(401);
    }

    public function testWrongStoreItem()
    {
        $response = $this->post( '/item', [
            'name'=>'book again',
            'price'=>'$1500',
            'qty'=>5
        ], ['Authorization'=> 1]);

        $response->assertResponseStatus(422);
    }

    public function testUpdateItem()
    {
        $response = $this->put( '/item/4', [
            'name'=>'book again',
            'price'=>1500,
            'qty'=>5
        ], ['Authorization'=> 1]);

        $response->assertResponseStatus(201);
    }

    public function testCannotUpdateItem()
    {
        $response = $this->put( '/item/4', [
            'name'=>'book again',
            'price'=>1500,
            'qty'=>5
        ]);

        $response->assertResponseStatus(401);
    }

    public function testCannotDeleteItem()
    {
        $response = $this->delete('item/1');
        $response->assertResponseStatus(401);
    }
}
