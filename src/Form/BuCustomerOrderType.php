<?php

namespace App\Form;

use App\Entity\BuArticle;
use App\Entity\BuCustomer;
use App\Entity\BuCustomerOrder;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BuCustomerOrderType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $idAdmin = $options['idAdmin'];
        $builder
            ->add('numberOrder')
            ->add('quantity')
            //->add('createdAt')
            ->add('BuCustomer', EntityType::class,[
                'class' => BuCustomer::class,
                'query_builder' => function (EntityRepository $er) use ($idAdmin) {
                    return $er->createQueryBuilder('u')
                        ->where('u.BiceaAdmin = :BiceaAdmin')
                        ->setParameter('BiceaAdmin', $idAdmin)
                        ->orderBy('u.firstName', 'ASC');
                },
                'choice_label' => 'firstName'
            ])
            ->add('BuArticle', EntityType::class,[
                'class' =>BuArticle::class,
                'query_builder' => function (EntityRepository $er) use ($idAdmin) {
                    return $er->createQueryBuilder('u')
                        ->where('u.BiceaAdmin = :BiceaAdmin')
                        ->setParameter('BiceaAdmin', $idAdmin)
                        ->orderBy('u.articleName', 'ASC');
                },
                'choice_label' => 'articleName'
            ])
            //->add('BiceaAdmin')
            ->add('submit', SubmitType::class,[
                'label' => 'Ajouter au panier'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => BuCustomerOrder::class,
            'idAdmin' => true
        ]);
    }
}
