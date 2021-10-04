<?php
namespace Bank\Model;

use Bank\Model\Bank;
use Laminas\Db\TableGateway\TableGatewayInterface;
use RuntimeException;
use Laminas\View\Model\JsonModel;
class BankTable
{
    private $tableGateway;

    public function __construct(TableGatewayInterface $tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }

    public function fetchAll()
    {
        return $this->tableGateway->select();
    }

    public function getBank($id)
    {
        return $this->tableGateway->select(['id' => $id]);
    }

   
    public function saveBank($bank)
    {
        $this->tableGateway->insert($bank);
    }
    public function updateBank($bank){
        $id = $bank['id'];
        $this->tableGateway->update($bank,['id'=>$id]);
    }
    public function deleteBank($id)
    {
        $this->tableGateway->delete(['id' => (int) $id]);
    }
}
