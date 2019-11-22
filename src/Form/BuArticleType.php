<?php

namespace App\Form;

use App\Entity\BuArticle;
use App\Entity\BuCategory;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BuArticleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $idAdmin = $options['idAdmin'];
        $builder
            ->add('articleName')
            ->add('unitPrice')
            //->add('createdAt')
            ->add('description')
            ->add('comment')
            //->add('BiceaAdmin')
            ->add('BuCategory', EntityType::class,[
                'class' => BuCategory::class,
                'query_builder' => function (EntityRepository $er) use ($idAdmin) {
                    return $er->createQueryBuilder('u')
                        ->where('u.BiceaAdmin = :BiceaAdmin')
                        ->setParameter('BiceaAdmin', $idAdmin)
                        ->orderBy('u.categoryName', 'ASC');
                },
                'choice_label' => 'categoryName',
            ])
            ->add('submit', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => BuArticle::class,
            'idAdmin' => 1
        ]);
    }
}
