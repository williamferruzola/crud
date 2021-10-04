<?php
namespace Bank\Controller;

use Bank\Form\BankForm;
use Bank\Model\Bank;
use Bank\Model\BankTable;
use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\View\Model\ViewModel;
use Laminas\View\Model\JsonModel;
//use Laminas\Http\Request;
use Laminas\Http\PhpEnvironment\Request;
class BankController extends AbstractActionController
{
    private $table;
    public function __construct(BankTable $table)
    {
        $this->table = $table;
    }
    public function tablaAction(){
         $data = $this->table->fetchAll(); 
         $request = $this->getRequest(); 
         $query = $request->getQuery();  
     
             $jsonData = array(); 
             $idx = 0; 
             foreach($data as $sampledata) { 
                 $temp = array( 
                    'id' => $sampledata->id,
                     'nombre' => $sampledata->nombre, 
                     'codigo' => $sampledata->codigo, 
                     'siglas' => $sampledata->siglas, 
                     'codsc' => $sampledata->codsc, 
                     'estado' => $sampledata->estado, 
                 );  
                 $jsonData[$idx++] = $temp; 
             } 
             $view = new JsonModel($jsonData); 
             $view->setTerminal(true); 
          
         return $view;
    }
    public function indexAction()
    {
        return new ViewModel();
    }
    public function updateAction()
    {
        $data = [
            'id' => $this->getRequest()->getPost('id'),
            'nombre' => $this->getRequest()->getPost('nombre'),
            'codigo' => $this->getRequest()->getPost('codigo'),
            'siglas' => $this->getRequest()->getPost('siglas'),
            'codsc' => $this->getRequest()->getPost('codsc'),
            'estado' => $this->getRequest()->getPost('estado')
        ];
       
        $this->table->updateBank($data);
       
    }
    public function addAction()
    {
        $data = [
            'nombre' => $this->getRequest()->getPost('nombre'),
            'codigo' => $this->getRequest()->getPost('codigo'),
            'siglas' => $this->getRequest()->getPost('siglas'),
            'codsc' => $this->getRequest()->getPost('codsc'),
            'estado' => $this->getRequest()->getPost('estado')
        ];
        $this->table->saveBank($data);
    }
    public function editAction()
    {
        $id = $this->getRequest()->getPost('id');
        $select = $this->table->getBank($id);
        return new JsonModel($select);
    }
    public function deleteAction()
    {
        $id['id'] = $this->getRequest()->getPost('id');
        $this->table->deleteBank($id['id']);
    }
}
