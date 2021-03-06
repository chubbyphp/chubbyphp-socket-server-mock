<?php

declare(strict_types=1);

namespace Chubbyphp\SocketServerMock\Stream;

final class ServerFactory implements ServerFactoryInterface
{
    public function createByHostAndPort(string $host, int $port): ServerInterface
    {
        return new Server($host, $port);
    }
}
