<?php

namespace App\DataFixtures;

use App\Entity\Annonce;
use App\Entity\Avis;
use App\Entity\Conseil;
use App\Entity\Message;
use App\Entity\Type;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Faker;

/**
 * @codeCoverageIgnore
 */
class AppFixtures extends Fixture
{
    private $encoder;

    public function __construct( UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager): void
    {
        $faker = Faker\Factory::create('fr_FR');

        for($u=0; $u < 20 ; $u++){
            $user = new User();
            $user->setUsername('username-'.$u)
                    ->setNom($faker->lastName())
                    ->setPrenom($faker->firstName())
                    ->setMail($faker->email())
                    ->setPhoto('/img/avatar-neutre.png')
                    ->setPassword($this->encoder->encodePassword($user, 'password'));
            $manager->persist($user);

            $this->addReference('user_'.$u, $user);
        }
        $manager->flush();
        
            $user = new user();
            $user->setUsername('admin')
                ->setPassword($this->encoder->encodePassword($user, 'adminPass'))
                ->setRoles(['ROLE_ADMIN'])
                ->setNom($faker->name())
                ->setPrenom($faker->firstName())
                ->setMail($faker->email())
                ->setPhoto('/img/avatar-neutre.png');
            $manager->persist($user);
            $this->addReference('user_admin', $user);

        $manager->flush();
        //      USER    END

        //      TYPE
        $choice = ['je recherche', 'je propose', 'je donne'];
        for($t=0; $t < sizeof($choice) ; $t++){
            $type = new Type();
            $type->setNom($choice[$t]);
            $manager->persist($type);
            // save type in reference
            $this->addReference('type_'.$t, $type);
        }

        $manager->flush();
        //      TYPE   END

        //      CONSEIL
        for($c=0; $c < 20 ; $c++){
            $user = $this->getReference('user_'. rand(0,19));
            $conseil = new Conseil();
            $conseil->setTitre($faker->words(3, true))
                    ->setDescription($faker->realText($faker->numberBetween(400, 4000)))
                    ->setDatePublication($faker->dateTime())
                    ->setNombreVue(rand(0,72))
                    ->setUser($user)
                    ->setPhoto('/img/fake/fakeImg-'.rand(1,12).'.jpg');
            $manager->persist($conseil);

            $this->addReference('conseil_'.$c, $conseil);

        }

        $manager->flush();
        //      CONSEIL   END

        //      AVIS
        for($a=0; $a < 40 ; $a++){
            $user = $this->getReference('user_'. rand(0,19));
            $conseil = $this->getReference('conseil_'. rand(0,19));
            $avis = new Avis();
            $avis->setText($faker->realText($faker->numberBetween(100, 400)))
                    ->setDatePublication($faker->dateTime())
                    ->setConseil($conseil)
                    ->setUser($user);
            $manager->persist($avis);
            $this->addReference('avis_'.$a, $avis);
        }
        

        $manager->flush();
        //      AVIS   END

        //      ANNONCE

        // for testing
        $type = $this->getReference('type_'. rand(0,2));
        $user = $this->getReference('user_'. rand(0,19));
        $annonce = new Annonce();
        $annonce->setTitre('titre')
                ->setDescription($faker->realText($faker->numberBetween(400, 5000)))
                ->setDatePublication($faker->dateTime())
                ->setNombreVue(rand(0,72))
                ->setVille($faker->city())
                ->setType($type)
                ->setActive(0)
                ->setUser($user)
                ->setPhoto('/img/fake/fakeImg-'.rand(1,12).'.jpg');
        $manager->persist($annonce);
        $this->addReference('annonce_test', $annonce);


        for($a=0; $a < 20 ; $a++){
            $type = $this->getReference('type_'. rand(0,2));
            $user = $this->getReference('user_'. rand(0,19));
            $annonce = new Annonce();
            $annonce->setTitre($faker->words(3, true))
                    ->setDescription($faker->realText($faker->numberBetween(400, 5000)))
                    ->setDatePublication($faker->dateTime())
                    ->setNombreVue(rand(0,72))
                    ->setVille($faker->city())
                    ->setType($type)
                    ->setUser($user)
                    ->setPhoto('/img/fake/fakeImg-'.rand(1,12).'.jpg');
            $manager->persist($annonce);
            $this->addReference('annonce_'.$a, $annonce);
        }
        
        $manager->flush();
        //      ANNONCE   END

        //      MESSAGE
        for($m=0; $m < 20 ; $m++){
            $message = new Message();
            $annonce = $this->getReference('annonce_'. rand(0,19));
            $destinataire = $annonce->getUser();
            $destinataireId = $destinataire->getId();
            $sender = $manager->getRepository(User::class)->find($destinataireId + 1);
            $message->setContenu($faker->paragraph(2))
                    ->setDate($faker->dateTime())
                    ->setLu($faker->boolean())
                    ->setDestinataire($destinataire)
                    ->setSender($sender)
                    ->setAnnonce($annonce);
            $manager->persist($message);

            $this->addReference('message_'.$m, $message);
        }
        $manager->flush();
        //      MESSAGE   END
    }
}