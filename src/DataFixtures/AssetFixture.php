<?php

namespace App\DataFixtures;

use App\DTO\Asset\CurrencyEnum;
use App\DTO\Asset\LabelEnum;
use App\Entity\Asset;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AssetFixture extends Fixture
{
    private UserPasswordHasherInterface $passwordEncoder;

    public function __construct(UserPasswordHasherInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager): void
    {
        $user = new User();
        $user->setEmail('user1@example.com');
        $user->setRoles(['ROLE_USER']);
        $user->setPassword($this->passwordEncoder->hashPassword(
            $user,
            'password123'
        ));

        $manager->persist($user);
        $manager->flush();

        $asset1 = new Asset();
        $asset1->setLabel(LabelEnum::BINANCE);
        $asset1->setCurrency(CurrencyEnum::ETH);
        $asset1->setValue(1.0);
        $asset1->setOwner($user);
        $manager->persist($asset1);

        $asset2 = new Asset();
        $asset2->setLabel(LabelEnum::USB);
        $asset2->setCurrency(CurrencyEnum::BTC);
        $asset2->setValue(2.0);
        $asset2->setOwner($user);
        $manager->persist($asset2);

        $asset3 = new Asset();
        $asset3->setLabel(LabelEnum::BINANCE);
        $asset3->setCurrency(CurrencyEnum::IOTA);
        $asset3->setValue(5.0);
        $asset3->setOwner($user);
        $manager->persist($asset3);

        $asset4 = new Asset();
        $asset4->setLabel(LabelEnum::BINANCE);
        $asset4->setCurrency(CurrencyEnum::BTC);
        $asset4->setValue(2.0);
        $asset4->setOwner($user);
        $manager->persist($asset4);

        $manager->flush();
    }
}
