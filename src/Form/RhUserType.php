<?php

namespace App\Form;

use App\Entity\RhFunction;
use App\Entity\RhUser;
use App\Repository\RhFunctionRepository;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\HttpFoundation\Session\Session;


class RhUserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $idAdmin=$options['idAdmin'];

        $builder
            ->add('firstName',TextType::class, [
                'label' => 'Prénom',
                'attr' => ['placeholder' => 'Saisir un prénom']
            ])
            ->add('lastName',TextType::class, [
                'label' => 'Nom',
                'attr' => ['placeholder' => 'Saisir un nom']
            ])
            ->add('email',TextType::class, [
                'label' => 'Adresse email',
                'attr' => ['placeholder' => 'Saisir une adresse email']
            ])
            ->add('password',TextType::class, [
                'label' => 'Mot de passe',
                'attr' => ['placeholder' => 'Insérer un mot de passe']
            ])
            ->add('phone',TextType::class, [
                'label' => 'Téléphone',
                'attr' => ['placeholder' => 'Saisir un numéro de téléphone']
            ])
            //->add('createdAt')
            ->add('loginUser',TextType::class, [
                'label' => 'Identifiant utilisateur',
                'attr' => ['placeholder' => 'Saisir un identifiant utilisateur']
            ])
            ->add('contract', FileType::class, [
                'label' => 'Contrat'
            ])
            ->add('passport', FileType::class,[
                'label' => 'Pièce d\'identité'
            ])
            ->add('photo', FileType::class,[
                'label' => 'Photo'
            ])

            ->add('RhFunction', EntityType::class,[
                'class' => RhFunction::class,

                'query_builder' => function (EntityRepository $er) use ($idAdmin) {
                    return $er->createQueryBuilder('u')
                        ->where('u.BiceaAdmin = :BiceaAdmin')
                        ->setParameter('BiceaAdmin', $idAdmin)
                        ->orderBy('u.functionName', 'ASC');
                },
                'choice_label' => 'functionName',
            ])
            ->add('submit', SubmitType::class, ['label'=>'Enregistrer'])

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => RhUser::class,
            'idAdmin' =>1
        ]);
    }
}
