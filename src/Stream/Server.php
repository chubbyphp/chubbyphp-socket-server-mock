<?php

declare(strict_types=1);

namespace Chubbyphp\SocketServerMock\Stream;

final class Server implements ServerInterface
{
    /**
     * @var resource
     */
    private $stream;

    /**
     * @param string $host
     * @param int    $port
     */
    public function __construct(string $host, int $port)
    {
        $code = 0;
        $message = '';

        $stream = stream_socket_server(sprintf('tcp://%s:%d', $host, $port), $code, $message);

        if (!is_resource($stream)) {
            throw StreamException::createFromStreamServerError($host, $port, $message);
        }

        $this->stream = $stream;

        fwrite(STDOUT, 'socket server mock: started'.PHP_EOL);
    }

    /**
     * @return ConnectionInterface
     */
    public function createConnection(): ConnectionInterface
    {
        return new Connection($this);
    }

    public function __deconstruct()
    {
        fclose($this->stream);
    }

    /**
     * @return resource
     */
    public function __invoke()
    {
        return $this->stream;
    }
}
