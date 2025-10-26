<?php

namespace Infrastructure\MessageBus;

use Domain\MessageBus\QueryBusInterface;
use RuntimeException;
use Throwable;

final class QueryBusStub implements QueryBusInterface
{
    /** @var array<int, array{result: mixed, assertion: (callable(object $query): void)|null}> */
    private array $queryResults = [];

    /** {@inheritDoc} */
    public function dispatch(object $query): mixed
    {
        $queryResult = array_shift($this->queryResults);

        if ($queryResult === null) {
            throw new RuntimeException('No more results. You need to add the expected result.');
        }

        if ($queryResult['assertion'] !== null) {
            $queryResult['assertion']($query);
        }

        if ($queryResult['result'] instanceof Throwable) {
            throw $queryResult['result'];
        }

        return $queryResult['result'];
    }

    public function addQueryResult(mixed $result, ?callable $assertion): void
    {
        $this->queryResults[] = compact('result', 'assertion');
    }
}
