<?php

namespace App\Form;

use App\Entity\BiceaAdmin;
use App\Entity\Project;
use App\Entity\PrTask;
use App\Entity\RhUser;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PrTaskType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $idAdmin = $options['idAdmin'];
        $builder
            ->add('taskName')
            ->add('description')
            ->add('comment')
            ->add('startDate')
            ->add('endDate')
            //->add('createdAt')
            /*->add('BiceaAdmin', EntityType::class, [
                'class' => BiceaAdmin::class,
                'label' => 'firtName',
            ])*/
            ->add('RhUser',EntityType::class, [
                'class' => RhUser::class,
                'query_builder' => function (EntityRepository $er) use ($idAdmin) {
                    return $er->createQueryBuilder('u')
                        ->where('u.BiceaAdmin = :BiceaAdmin')
                        ->setParameter('BiceaAdmin', $idAdmin)
                        ->orderBy('u.firstName', 'ASC');
                },

                'choice_label' => 'firstName',
            ])
            ->add('Project', EntityType::class,[
                'class' => Project::class,
                'query_builder' => function (EntityRepository $er) use ($idAdmin) {
                    return $er->createQueryBuilder('u')
                        ->where('u.BiceaAdmin = :BiceaAdmin')
                        ->setParameter('BiceaAdmin', $idAdmin)
                        ->orderBy('u.projectName', 'ASC');
                },
                'choice_label' => 'projectName',
            ] )
            ->add('submit', SubmitType::class, ['label'=>'Enregistrer'])

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => PrTask::class,
            'idAdmin' =>1
        ]);
    }
}
