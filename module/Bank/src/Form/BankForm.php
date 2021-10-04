<?php
namespace Bank\Form;

use Laminas\Form\Form;

class BankForm extends Form
{
    public function __construct($name = null)
    {
        // We will ignore the name provided to the constructor
        parent::__construct('banks');
        
        $this->add([
            'name' => 'id',
            'type' => 'hidden',
        ]);

        $this->add([
            'name' => 'nombre',
            'type' => 'text',
            'options' => [
                'label' => 'Nombre',
            ],
        ]);
        $this->add([
            'name' => 'codigo',
            'type' => 'text',
            'options' => [
                'label' => 'Codigo',
            ],
        ]);
        $this->add([
            'name' => 'codsc',
            'type' => 'text',
            'options' => [
                'label' => 'Codsc',
            ],
        ]);
        $this->add([
            'name' => 'siglas',
            'type' => 'text',
            'options' => [
                'label' => 'Siglas',
            ],
        ]);
        $this->add([
            'name' => 'estado',
            'type' => 'text',
            'options' => [
                'label' => 'Estado',
            ],
        ]);
        $this->add([
            'name' => 'submit',
            'type' => 'submit',
            'attributes' => [
                'value' => 'Submit',
                'id'    => 'submitbutton',
            ],
        ]);
    }
}
