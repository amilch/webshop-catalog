<?php

namespace App\Console\Commands;

use Domain\UseCases\CreateProduct\CreateProductInputPort;
use Domain\UseCases\CreateProduct\CreateProductRequestModel;
use Domain\UseCases\UpdateStock\UpdateStockInputPort;
use Domain\UseCases\UpdateStock\UpdateStockRequestModel;
use Illuminate\Console\Command;
use BSchmitt\Amqp\Facades\Amqp;
use BSchmitt\Amqp\Consumer;
use PhpAmqpLib\Message\AMQPMessage;
use Exception;

class ConsumeAMQPCommand extends Command
{
    protected $signature = 'app:consume';

    protected $description = 'AMQP consumer';

    private $should_keep_running = true;

    public function __construct(
        private UpdateStockInputPort $interactor,
    ) {
        parent::__construct();
    }

    public function handle()
    {
        $this->trap(15, fn () => $this->should_keep_running = false);
        var_dump('Listening for messages...');

        Amqp::consume('catalog_inventory_updated',
            function (AMQPMessage $message, Consumer $resolver) {
                try{
                    $payload = json_decode($message->getBody(), true);
                    var_dump('Message received', $payload);

                    $this->interactor->updateStock(
                        new UpdateStockRequestModel($payload)
                    );

                    $resolver->acknowledge($message);
                } catch (Exception $e) {
                    var_dump('Error processing message');
                    var_dump($e->getMessage());
                    $resolver->reject($message);
                }
            },[
                'routing' => 'inventory_updated',
                'persistent' => true,
            ]);

        while($this->should_keep_running) {}
    }
}
