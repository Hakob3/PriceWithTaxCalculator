<?php

namespace App\DataFixtures;

use App\Entity\Buyer;
use Doctrine\Persistence\ObjectManager;
use JsonException;

class BuyerFixtures extends AppAbstractFixtures
{
    /** @var string  */
    private const JSON_DATA_PATH = 'src/DataFixtures/JsonData/buyer.json';

    /**
     * @param ObjectManager $manager
     * @return void
     * @throws JsonException
     */
    public function load(ObjectManager $manager): void
    {
        $buyers = $this->getJsonData(self::JSON_DATA_PATH);

        foreach ($buyers as $buyer) {
            $buyerEntity = new Buyer();

            $buyerEntity->setTaxNumber($buyer['taxNumber']);
            $manager->persist($buyerEntity);
        }
        $manager->flush();
    }
}
