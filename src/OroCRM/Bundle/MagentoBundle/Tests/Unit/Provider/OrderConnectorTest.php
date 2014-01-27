<?php

namespace OroCRM\Bundle\MagentoBundle\Tests\Unit\Provider;

use Oro\Bundle\ImportExportBundle\Context\ContextRegistry;
use Oro\Bundle\IntegrationBundle\Logger\LoggerStrategy;
use Oro\Bundle\IntegrationBundle\Provider\ConnectorContextMediator;

use OroCRM\Bundle\MagentoBundle\Provider\OrderConnector;

class OrderConnectorTest extends MagentoConnectorTestCase
{
    /**
     * {@inheritdoc}
     */
    protected function getConnectorInstance(
        ContextRegistry $contextRegistry,
        LoggerStrategy $logger,
        ConnectorContextMediator $contextMediator
    ) {
        return new OrderConnector($contextRegistry, $logger, $contextMediator);
    }

    /**
     * {@inheritdoc}
     */
    protected function getIteratorGetterMethodName()
    {
        return 'getOrders';
    }

    public function testPublicInterface()
    {
        $contextMediatorMock = $this
            ->getMockBuilder('Oro\\Bundle\\IntegrationBundle\\Provider\\ConnectorContextMediator')
            ->disableOriginalConstructor()->getMock();

        $connector = $this->getConnectorInstance(new ContextRegistry(), new LoggerStrategy(), $contextMediatorMock);

        $this->assertEquals('order', $connector->getType());
        $this->assertEquals('mage_order_import', $connector->getImportJobName());
        $this->assertEquals('OroCRM\\Bundle\\MagentoBundle\\Entity\\Order', $connector->getImportEntityFQCN());
        $this->assertEquals('orocrm.magento.connector.order.label', $connector->getLabel());
    }
}
