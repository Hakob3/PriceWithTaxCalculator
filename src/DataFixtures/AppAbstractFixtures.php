<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use JsonException;

abstract class AppAbstractFixtures extends Fixture
{
    /**
     * @param string $rootPath
     */
    public function __construct(private readonly string $rootPath)
    {
    }

    /**
     * @param string $jsonDataPath
     * @return mixed
     * @throws JsonException
     */
    protected function getJsonData(string $jsonDataPath): mixed
    {
        return json_decode(
            file_get_contents(sprintf('%s/%s', $this->rootPath, $jsonDataPath)),
            true,
            512,
            JSON_THROW_ON_ERROR
        );
    }
}
