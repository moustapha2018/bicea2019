<?php

namespace App\Form;

use App\Entity\RhContract;
use App\Entity\RhUser;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RhContractType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $idAdmin=$options['idAdmin'];
        $builder
            ->add('salary')
            ->add('startDate')
            //->add('createdAt')
            ->add('endDate')
            //->add('BiceaAdmin')
            ->add('RhUser', EntityType::class,[
                'class'=> RhUser::class,
                'query_builder' => function (EntityRepository $er) use ($idAdmin) {
                    return $er->createQueryBuilder('u')
                        ->where('u.BiceaAdmin = :BiceaAdmin')
                        ->setParameter('BiceaAdmin', $idAdmin)
                        ->orderBy('u.firstName', 'ASC');
                },
                'choice_label'=> 'firstName'
            ])

            ->add('submit', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => RhContract::class,
            'idAdmin' => 1
        ]);
    }
}
