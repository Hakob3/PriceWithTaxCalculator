<?php

namespace App\DataFixtures;

use App\Entity\Buyer;
use App\Entity\Country;
use Doctrine\Persistence\ObjectManager;
use JsonException;

class CountryFixtures extends AppAbstractFixtures
{
    /** @var string  */
    private const JSON_DATA_PATH = 'src/DataFixtures/JsonData/country.json';

    /**
     * @param ObjectManager $manager
     * @return void
     * @throws JsonException
     */
    public function load(ObjectManager $manager): void
    {
        $countries = $this->getJsonData(self::JSON_DATA_PATH);

        foreach ($countries as $country) {
            $countryEntity = new Country();

            $countryEntity->setName($country['name']);
            $countryEntity->setTax($country['tax']);
            $countryEntity->setTaxNumberPrefix($country['taxNumberPrefix']);
            $manager->persist($countryEntity);
        }
        $manager->flush();
    }
}
