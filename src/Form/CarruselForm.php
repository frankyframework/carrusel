<?php
namespace Carrusel\Form;

class CarruselForm extends \Franky\Form\Form
{
    public function __construct($name)
    {
        

        parent::__construct();
       $this->setAtributos(array(
            'name' => $name,
            'action' => "/admin/carrusel/submit.php",
            'method' => 'post'
        ));

        $this->add(array(
            'name' => 'id',
            'type'  => 'hidden',
          
            )
        );

       
        $this->add(array(
                'name' => 'nombre',
                'label' => _carrusel('Nombre'),
                'type'  => 'text',
                'required'  => true,
                'atributos' => array(
                    'class'       => 'required',
                    'maxlength' => 200
                 ),
                'label_atributos' => array(
                    'class'       => 'desc_form_obligatorio'
                 )
            )
        );

        $this->add(array(
                'name' => 'code',
                'label' => _carrusel('Codigo único'),
                'type'  => 'text',
                'required'  => true,
                'atributos' => array(
                    'class'       => 'required',
                    'maxlength' => 255
                ),
                'label_atributos' => array(
                    'class'       => 'desc_form_obligatorio'
                )
            )
        );



        $this->add(array(
            'name' => 'auto',
            'type'  => 'checkbox',
            'options' =>  array("1" => _carrusel("Inicio automatico")),
            )
        );
      
        $this->add(array(
            'name' => 'infinito',
            'type'  => 'checkbox',
            'options' =>  array("1" => _carrusel("Loop infinito")),
            )
        );

        $this->add(array(
            'name' => 'dots',
            'type'  => 'checkbox',
            'options' =>  array("1" => _carrusel("Paginado")),
            )
        );

       
        $this->add(array(
            'name' => '_width[]',
          //  'label' => '',
            'type'  => 'text',
            'required'  => true,
            'atributos' => array(
                'class'       => 'required',
                'maxlength' => 255
            ),
            'label_atributos' => array(
                'class'       => 'desc_form_obligatorio'
            )
            )
        );
       

        $this->add(array(
            'name' => 'visible',
            'label' => _carrusel('Items visibles'),
            'type'  => 'text',
            'required'  => true,
            'atributos' => array(
                'class'       => 'required',
                'maxlength' => 255
            ),
            'label_atributos' => array(
                'class'       => 'desc_form_obligatorio'
            )
            )
        );

               
        $this->add(array(
            'name' => 'scroll',
            'label' => _carrusel('Scroll'),
            'type'  => 'text',
            'required'  => true,
            'atributos' => array(
                'class'       => 'required',
                'maxlength' => 255
            ),
            'label_atributos' => array(
                'class'       => 'desc_form_obligatorio'
            )
            )
        );


        $this->add(array(
            'name' => '_visible[]',
          //  'label' => '',
            'type'  => 'text',
            'required'  => true,
            'atributos' => array(
                'class'       => 'required',
                'maxlength' => 255
            ),
            'label_atributos' => array(
                'class'       => 'desc_form_obligatorio'
            )
            )
        );

               
        $this->add(array(
            'name' => '_scroll[]',
          //  'label' => '',
            'type'  => 'text',
            'required'  => true,
            'atributos' => array(
                'class'       => 'required',
                'maxlength' => 255
            ),
            'label_atributos' => array(
                'class'       => 'desc_form_obligatorio'
            )
            )
        );


         $this->add(array(
                'name' => 'guardar',
                'type'  => 'button',
                'atributos' => array(
                    'class'       => 'btn btn-primary btn-big float_right ',
                    'value' => _carrusel("Guardar")
                 )
                
            )
        );

    }
 
}
?>