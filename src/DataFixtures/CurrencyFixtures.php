<?php

namespace App\DataFixtures;

use App\Entity\Currency;
use Doctrine\Persistence\ObjectManager;
use JsonException;

class CurrencyFixtures extends AppAbstractFixtures
{
    /** @var string  */
    private const JSON_DATA_PATH = 'src/DataFixtures/JsonData/currency.json';

    /**
     * @param ObjectManager $manager
     * @return void
     * @throws JsonException
     */
    public function load(ObjectManager $manager): void
    {
        $currencies = $this->getJsonData(self::JSON_DATA_PATH);

        foreach ($currencies as $currency) {
            $currencyEntity = new Currency();

            $currencyEntity->setName($currency['name']);
            $currencyEntity->setSymbol($currency['symbol']);
            $currencyEntity->setCode($currency['code']);
            $manager->persist($currencyEntity);
        }
        $manager->flush();
    }
}
