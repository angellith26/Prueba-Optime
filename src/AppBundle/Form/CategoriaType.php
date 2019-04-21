<?php  
namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class CategoriaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
         
        ->add('codigo', TextType::class)
        ->add('nombre', TextType::class)
        ->add('descripcion', TextType::class)
        ->add('status')
        ->add('save', SubmitType::class, ['label' => 'Crear']);
        
    }
}

?>