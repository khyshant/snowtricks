<?php
/**
 * Created by PhpStorm.
 * User: khysh
 * Date: 09/12/2019
 * Time: 00:51
 */

namespace App\Form;

use App\Entity\Trick;
use App\Entity\Group;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
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
            ->add("metatitle", TextType::class)
            ->add("metadescription", TextareaType::class)
            ->add('group', EntityType::class, [

                'mapped' =>true,
                'class' => Group::class,
                // uses the User.username property as the visible option string
                'choice_label' => 'name',
                'multiple' => false,
                'expanded' => false,])
            ->add("images", CollectionType::class, [
                "entry_type" => ImageType::class,
                "allow_add" => true,
                "allow_delete" => true,
                "by_reference" => false
            ])
            ->add("videos", CollectionType::class, [
                "entry_type" => VideoType::class,
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