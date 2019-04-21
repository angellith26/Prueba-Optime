<?php  
namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use App\Entity\Categoria;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class ProductoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('codigo', TextType::class)
        ->add('nombre', TextType::class)
        ->add('descripcion', TextType::class)
        ->add('marca', TextType::class)
        ->add('precio', MoneyType::class)
        ->add('categoria', EntityType::class, [
            // looks for choices from this entity
            'class' => 'AppBundle:Categoria',

            // uses the User.username property as the visible option string
            'choice_label' => 'nombre',

            // used to render a select box, check boxes or radios
            // 'multiple' => true,
            // 'expanded' => true,
        ])
        ->add('save', SubmitType::class, ['label' => 'Crear']);
        
    }
}

?>