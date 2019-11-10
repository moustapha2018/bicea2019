<?php

namespace App\Form;

use App\Entity\BiceaAdmin;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BiceaAdminType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstName',TextType::class,[
                'label' => 'Prénom',
                'attr' => ['placeholder' => 'Saisir un prénom']
            ])
            ->add('lastName',TextType::class,[
                'label' => 'Nom',
                'attr' => ['placeholder' => 'Saisir un nom']
            ])
            ->add('email',TextType::class,[
                'label' => 'Adresse email',
                'attr' => ['placeholder' => 'Saisir une adresse email']
            ])
            ->add('password',TextType::class,
                [
                    'label' => 'Mot de passe',
                    'attr' => ['placeholder' => 'Saisir un mot de passe']
                ])
            //->add('createdAt')
            ->add('loginAdmin',TextType::class,[
                'label' => 'Identifiant Administrateur',
                'attr' => ['placeholder' => 'Saisir un identifiant administrateur']
            ])
            ->add('companyName',TextType::class,[
                'label' => 'Nom de l\'entreprise',
                'attr' => ['placeholder' => 'Saisir le nom de l\'entreprise']
            ])
            ->add('headOffice',TextType::class,[
                'label' => 'Siège Social',
                'attr' => ['placeholder' => 'Saisir le siège social']
            ])
            ->add('loginCompany',TextType::class,[
                'label' => 'Identifiant Entreprise',
                'attr' => ['placeholder' => 'Saisir un identifiant entreprise']
            ])
            //->add('active')
            //->add('paid')
            ->add('activitySector', ChoiceType::class,[
                'choices'  => [
                BiceaAdmin::business => BiceaAdmin::business,
                BiceaAdmin::education => BiceaAdmin::education
            ]])
            ->add('submit', SubmitType::class, ['label'=> 'Enregistrer'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => BiceaAdmin::class,
        ]);
    }
}
