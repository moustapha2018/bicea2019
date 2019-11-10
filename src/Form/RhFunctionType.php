<?php

namespace App\Form;

use App\Entity\RhFunction;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RhFunctionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('functionName',TextType::class, [
                'label' => 'Nom de la fonction',
                'attr' => ['placeholder' => 'Saisir le nom de la fonction']
            ])
            ->add('description',TextType::class, [
                'label' => 'Description de la fonction',
                'attr' => ['placeholder' => 'Saisir la description de la fonction']
            ])
            ->add('comment',TextType::class, [
                'label' => 'Commentaire',
                'attr' => ['placeholder' => 'Saisir un commentaire']
            ])
            //->add('createdAt')
            ->add('submit', SubmitType::class,[
                'label'=>'Soumettre'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => RhFunction::class,
        ]);
    }
}
