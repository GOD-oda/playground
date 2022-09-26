<?php

declare(strict_types=1);

namespace Tests\CoolWord\Domain\CoolWord;

use CoolWord\Domain\CoolWord\CoolWord;
use CoolWord\Domain\CoolWord\CoolWordId;
use CoolWord\Domain\CoolWord\CoolWordRepository;
use CoolWord\Domain\CoolWord\CoolWordService;
use CoolWord\Domain\CoolWord\Name;
use Tests\TestCase;

class CoolWordServiceTest extends TestCase
{
    private CoolWordRepository $repository;
    private CoolWordService $service;

    protected function setUp(): void
    {
        parent::setUp();

        $this->service = $this->app->make(CoolWordService::class);
        $this->repository = $this->app->make(CoolWordRepository::class);
    }

    public function testFalseIsDuplicated()
    {
        $coolWord = new CoolWord(
            id: new CoolWordId(1),
            name: new Name('foo')
        );
        $this->assertFalse($this->service->isDuplicated($coolWord));
    }

    public function testTrueIsDuplicated()
    {
        $coolWord = new CoolWord(
            id: new CoolWordId(1),
            name: new Name('foo')
        );
        $this->repository->store($coolWord);

        $anotherCoolWord = new CoolWord(
            id: new CoolWordId(2),
            name: new Name('foo')
        );

        $this->assertTrue($this->service->isDuplicated($anotherCoolWord));
    }
}
