<?php
/**
 * Created by PhpStorm.
 * User: khysh
 * Date: 09/12/2019
 * Time: 00:51
 */

namespace App\Form;

use App\Entity\Comment;
use Symfony\Component\Form\AbstractType;

use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 *
 * Class CommentType
 * @package App\Form
 */
class CommentType extends AbstractType
{
    /**
     * @inheritDoc
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add("isvalid", ChoiceType::class, array(
                'expanded' => true,
                'multiple' => false,
                'choices' => array(
                    'Approuvé' => '1',
                    'En attente' => '0')))
            ->add("comment", TextareaType::class)
        ;
    }

    /**
     * @inheritDoc
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefault("data_class", Comment::class);
    }
}