<?php

    namespace App\DataFixtures;

    use App\Entity\User;
    use Doctrine\Bundle\FixturesBundle\Fixture;
    use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
    use Doctrine\Persistence\ObjectManager;
    use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

    class UserFixtures extends Fixture implements OrderedFixtureInterface
    {
        const USER_REFERENCE = 'user-';

        private $passwordEncoder;

        /**
         * UserFixtures constructor.
         * @param UserPasswordEncoderInterface $passwordEncoder
         */
        public function __construct(UserPasswordEncoderInterface $passwordEncoder)
        {
            $this->passwordEncoder = $passwordEncoder;
        }

        /**
         * @param ObjectManager $manager
         */
        public function load(ObjectManager $manager)
        {
            $i = 1;
            foreach ($this->getUser() as [$mail, $pass]) {
                $user = new User();

                $user->setEmail($mail);
                $user->setPassword($this->passwordEncoder->encodePassword(
                    $user,
                    $pass
                ));
                $user->setRoles(['ROLE_USER']);

                $this->addReference(self::USER_REFERENCE.$i, $user);

                $manager->persist($user);
                ++$i;
            }
            $manager->flush();
        }

        /**
         * Get an array of random Classroom names and grades.
         */
        private function getUser(): array
        {
            return [
                ['demo1@gmail.com', 'demo1'],
                ['demo2@gmail.com', 'demo2'],
            ];
        }

        public function getOrder()
        {
            return 1;
        }
    }
