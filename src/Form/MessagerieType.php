<?php

    namespace App\Form;

    use App\Entity\Messagerie;
    use App\Entity\User;
    use App\Repository\UserRepository;
    use Doctrine\ORM\EntityRepository;
    use Symfony\Bridge\Doctrine\Form\Type\EntityType;
    use Symfony\Component\Form\AbstractType;
    use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
    use Symfony\Component\Form\Extension\Core\Type\FileType;
    use Symfony\Component\Form\Extension\Core\Type\ResetType;
    use Symfony\Component\Form\Extension\Core\Type\TextareaType;
    use Symfony\Component\Form\Extension\Core\Type\TextType;
    use Symfony\Component\Form\FormBuilderInterface;
    use Symfony\Component\OptionsResolver\OptionsResolver;
    use Symfony\Component\Security\Core\Security;
    use Symfony\Component\Validator\Constraints\File;

    class MessagerieType extends AbstractType
    {
        private $security;

        public function __construct(Security $security)
        {
            $this->security = $security;
        }

        public function buildForm(FormBuilderInterface $builder, array $options)
        {
            $user = $this->security->getUser();
            $email = $user->getUsername();

            $builder
                ->add('subject', TextType::class, [
                    'label' => 'Objet',
                    'attr' => ['class' => 'form-control'],
                ])
                ->add('body', TextareaType::class, [
                    'label' => 'Body',
                    'attr' => ['class' => 'form-control'],
                ])
                ->add('users', EntityType::class, [
                    'label' => 'Destinataire',
                    'attr' => ['class' => 'form-control'],
                    'class' => User::class,
                    'choice_label' => 'username',
                    'query_builder' => function (EntityRepository $users) use ($email) {
                        return $users->createQueryBuilder('u')
                            ->where('u.email != :email')
                            ->setParameter('email', $email);
                    }
                ])
                ->add('documents', FileType::class, [
                    'label' => 'Document (PDF file)',
                    'mapped' => false,
                    'required' => false,
                ])
                ->add('cancel', ResetType::class, [
                    'label' => 'Recommencer',
                    'attr' => ['class' => 'btn btn-warning'],
                ]);
        }

        public function configureOptions(OptionsResolver $resolver)
        {
            $resolver->setDefaults([
                'data_class' => Messagerie::class,
            ]);
        }
    }
