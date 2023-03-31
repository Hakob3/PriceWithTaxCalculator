<?php

namespace App\DataFixtures;

use App\Entity\Product;
use App\Repository\CurrencyRepository;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use JsonException;

class ProductFixtures extends AppAbstractFixtures implements DependentFixtureInterface
{
    /** @var string  */
    private const JSON_DATA_PATH = 'src/DataFixtures/JsonData/product.json';

    /**
     * @param CurrencyRepository $currencyRepository
     * @param string $rootPath
     */
    public function __construct(
        private readonly CurrencyRepository $currencyRepository,
        string                              $rootPath
    )
    {
        parent::__construct($rootPath);
    }

    /**
     * @param ObjectManager $manager
     * @return void
     * @throws JsonException
     */
    public function load(ObjectManager $manager): void
    {
        $products = $this->getJsonData(self::JSON_DATA_PATH);

        foreach ($products as $product) {
            $productEntity = new Product();

            $productEntity->setName($product['name']);
            $productEntity->setPrice($product['price']);
            $productEntity->setCurrency($this->currencyRepository->findOneBy(['code' => $product['currency']]));
            $manager->persist($productEntity);
        }
        $manager->flush();
    }

    /**
     * @return string[]
     */
    public function getDependencies(): array
    {
        return [
            CurrencyFixtures::class
        ];
    }
}
