<?php
namespace OroCRM\Bundle\MagentoBundle\Tests\Functional\Entity;

use Doctrine\ORM\EntityManagerInterface;
use Oro\Bundle\IntegrationBundle\Async\Topics;
use Oro\Bundle\IntegrationBundle\Entity\Channel;
use Oro\Bundle\TestFrameworkBundle\Test\WebTestCase;
use Oro\Component\MessageQueue\Client\MessagePriority;
use Oro\Component\MessageQueue\Client\TraceableMessageProducer;
use OroCRM\Bundle\MagentoBundle\Entity\MagentoSoapTransport;
use OroCRM\Bundle\MagentoBundle\Tests\Functional\Fixture\LoadMagentoChannel;

/**
 * @dbIsolationPerTest
 */
class MagentoSoapTransportTest extends WebTestCase
{
    public function setUp()
    {
        $this->initClient();
        $this->loadFixtures([LoadMagentoChannel::class]);
        $this->getMessageProduer()->clearTraces();
    }

    public function testShouldScheduleSyncIntegrationIfSyncStartDateIsChanged()
    {
        /** @var Channel $integration */
        $integration = $this->getReference('integration');

        /** @var MagentoSoapTransport $transport */
        $transport = $integration->getTransport();

        //guard
        self::assertInstanceOf(MagentoSoapTransport::class, $transport);

        $transport->setSyncStartDate(new \DateTime('2010-01-01'));

        $this->getEntityManager()->flush();

        $traces = $this->getMessageProduer()->getTopicTraces(Topics::SYNC_INTEGRATION);

        self::assertCount(1, $traces);

        self::assertEquals([
            'integrationId' => $integration->getId(),
            'connector_parameters' => [],
            'connector' => null,
            'transport_batch_size' => 100,
        ], $traces[0]['message']);
        self::assertEquals(MessagePriority::VERY_LOW, $traces[0]['priority']);
    }

    /**
     * @return EntityManagerInterface
     */
    private function getEntityManager()
    {
        return self::getContainer()->get('doctrine.orm.entity_manager');
    }

    /**
     * @return TraceableMessageProducer
     */
    private function getMessageProduer()
    {
        return self::getContainer()->get('oro_message_queue.message_producer');
    }
}
