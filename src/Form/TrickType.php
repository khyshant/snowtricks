<?php
/**
 * Created by PhpStorm.
 * User: khysh
 * Date: 09/12/2019
 * Time: 00:51
 */

namespace App\Form;

use App\Entity\Trick;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 *
 * Class TrickType
 * @package App\Form
 */
class TrickType extends AbstractType
{
    /**
     * @inheritDoc
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add("title", TextType::class)
            ->add("description", TextareaType::class)
            ->add("images", CollectionType::class, [
                "entry_type" => ImageType::class,
                "allow_add" => true,
                "allow_delete" => true,
                "by_reference" => false
            ])
        ;
    }

    /**
     * @inheritDoc
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefault("data_class", Trick::class);
    }
}