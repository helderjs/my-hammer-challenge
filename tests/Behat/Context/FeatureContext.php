<?php

declare(strict_types=1);

namespace MyHammer\Job\Tests\Behat\Context;

use Behat\Behat\Context\Context;
use Behat\Behat\Hook\Scope\BeforeScenarioScope;
use Behat\Gherkin\Node\PyStringNode;
use Doctrine\Common\DataFixtures\Executor\ORMExecutor;
use Doctrine\Common\DataFixtures\Loader;
use Doctrine\Common\DataFixtures\Purger\ORMPurger;
use Symfony\Component\HttpFoundation\ParameterBag;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\KernelInterface;

require_once __DIR__ . '/../../../vendor/phpunit/phpunit/src/Framework/Assert/Functions.php';

/**
 * Class FeatureContext
 */
class FeatureContext implements Context
{
    /**
     * @var KernelInterface
     */
    private $kernel;

    /**
     * @var Response|null
     */
    private $response;

    /**
     * FeatureContext constructor.
     *
     * @param KernelInterface $kernel
     */
    public function __construct(KernelInterface $kernel)
    {
        $this->kernel = $kernel;
    }

    /**
     * @When I send a :method request to :path
     */
    public function iSendARequestTo(string $method, string $path): void
    {
        $this->response = $this->kernel->handle(
            Request::create(
                $path,
                $method,
                [],
                [],
                [],
                [
                    'HTTP_CONTENT-TYPE' => 'application/json',
                    'HTTP_X-ACCEPT-VERSION' => 'v1',
                ]
            )
        );
    }

    /**
     * @When I send a :method request to :path with body:
     */
    public function iSendARequestWithBodyTo(string $method, string $path, PyStringNode $body = null): void
    {
        $request = Request::create(
            $path,
            $method,
            [],
            [],
            [],
            [
                'HTTP_CONTENT-TYPE' => 'application/json',
                'HTTP_X-ACCEPT-VERSION' => 'v1',
            ],
            $body->getRaw()
        );
        $request->request = new ParameterBag(json_decode($body->getRaw(), true));
        $this->response = $this->kernel->handle($request);
    }

    /**
     * @Then /^the response should be received$/
     */
    public function theResponseShouldBeReceived()
    {
        assertNotNull($this->response);
    }

    /**
    * @Then /^the response status code should be (?P<code>\d+)$/
    */
    public function theResponseStatusCode(int $code): void
    {
        assertEquals($code, $this->response->getStatusCode());
    }

    /**
     * @Then /^the response body contains:$/
     */
    public function theResponseContains(PyStringNode $payload): void
    {
        $expected = json_decode($payload->getRaw(), true);
        $response = json_decode($this->response->getContent(), true);

        assertArraySubset($expected, $response);
    }

    /**
     * @BeforeScenario
     */
    public function cleanDB(BeforeScenarioScope $scope)
    {
        $loader = new Loader();
        $loader->loadFromDirectory(__DIR__ . '/../../../src/DataFixtures');
        $fixtures = $loader->getFixtures();
        $doctrine = $this->kernel->getContainer()->get('doctrine');
        $em = $doctrine->getManager('default');
        $purger = new ORMPurger($em);
        $purger->setPurgeMode(ORMPurger::PURGE_MODE_DELETE);
        $executor = new ORMExecutor($em, $purger);
        $executor->execute($fixtures);
    }
}
