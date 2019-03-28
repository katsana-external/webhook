<?php

namespace Laravie\Webhook;

use Laravie\Codex\Common\HttpClient;
use Http\Client\Common\HttpMethodsClient;
use Laravie\Codex\Contracts\Request as RequestContract;

class Client implements \Laravie\Codex\Contracts\Client
{
    use HttpClient;

    /**
     * Content-Type for Webhook requests.
     *
     * @var string
     */
    protected $contentType = 'application/json';

    /**
     * Construct a new client.
     *
     * @param \Http\Client\Common\HttpMethodsClient  $http
     */
    public function __construct(HttpMethodsClient $http)
    {
        $this->http = $http;
    }

    /**
     * Handle uses using via.
     *
     * @param  \Laravie\Codex\Contracts\Request  $request
     *
     * @return \Laravie\Codex\Contracts\Request
     */
    public function via(RequestContract $request): RequestContract
    {
        $request->setClient($this);

        return $request;
    }

    /**
     * Set Content-Type value for webhook request.
     *
     * @param  string  $contentType
     *
     * @return $this
     */
    final public function setContentType(string $contentType): self
    {
        $this->contentType = $contentType;

        return $this;
    }

    /**
     * Get Content-Type value for webhook request.
     *
     * @return string
     */
    public function getContentType(): string
    {
        return $this->contentType;
    }

    /**
     * Prepare request headers.
     *
     * @param  array  $headers
     *
     * @return array
     */
    protected function prepareRequestHeaders(array $headers = []): array
    {
        $headers['Content-Type'] = $this->contentType;

        return $headers;
    }
}
