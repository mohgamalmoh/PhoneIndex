<?php


namespace App\Services\Interfaces;


interface BaseServiceInterface
{
    public function getPaginatedList(array $params);
    /*public function getList(array $params);
    public function getOne(int $id);
    public function addOne(array $data);
    public function updateOne(int $id, array $data);
    public function deleteOne(int $id);*/
}