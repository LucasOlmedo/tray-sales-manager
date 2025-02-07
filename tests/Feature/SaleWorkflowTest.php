<?php

namespace Tests\Feature;

use App\Application\DTOs\Filters\SaleFilterDTO;
use App\Application\DTOs\SaleDTO;
use App\Application\UseCases\Sales\CreateSaleUseCase;
use App\Application\UseCases\Sales\ListSalesUseCase;
use App\Domain\Entities\Sale;
use App\Domain\Entities\Seller;
use App\Domain\Repositories\SaleRepositoryInterface;
use App\Domain\ValueObjects\Commission;
use Illuminate\Foundation\Testing\RefreshDatabase;
use IteratorAggregate;
use Mockery;
use Tests\TestCase;

class SaleWorkflowTest extends TestCase
{
    use RefreshDatabase;

    private ListSalesUseCase $listUseCase;
    private CreateSaleUseCase $createUseCase;
    private SaleRepositoryInterface $saleRepositoryMock;

    public function setUp(): void
    {
        parent::setUp();

        $this->saleRepositoryMock = Mockery::mock(SaleRepositoryInterface::class);

        $this->listUseCase = new ListSalesUseCase($this->saleRepositoryMock);
        $this->createUseCase = new CreateSaleUseCase($this->saleRepositoryMock);
    }

    public function test_sale_create_workflow()
    {
        $seller = new Seller(
            id: 1,
            name: 'John Doe',
            email: 'Wl4wU@example.com',
            commission: new Commission(value: 10),
        );

        $saleEntity = new Sale(
            id: null,
            seller: $seller,
            amount: 1000,
            date: '2023-06-01',
            appliedCommission: $seller->commission,
        );

        $saleDTO = new SaleDTO(
            sellerId: $seller->id,
            amount: $saleEntity->amount
        );

        /**
         * @var Mockery\MockInterface $repo
         */
        $repo = $this->saleRepositoryMock;

        $repo->shouldReceive('save')
            ->once()
            ->andReturn($saleEntity);

        $createdSale = $this->createUseCase->execute($seller, $saleDTO);

        $this->assertEquals($saleEntity->amount, $createdSale->amount);
        $this->assertInstanceOf(Sale::class, $createdSale);
    }

    public function test_sale_list_workflow()
    {
        $filter = new SaleFilterDTO(
            sellerId: null,
            minDate: '2023-01-01',
            maxDate: '2023-06-01',
            page: 1,
            perPage: 10,
        );

        /**
         * @var Mockery\MockInterface $repo
         */
        $repo = $this->saleRepositoryMock;

        $repo->shouldReceive('list')
            ->once()
            ->andReturn(new class implements IteratorAggregate {
                public function getIterator(): \Traversable
                {
                    yield from [
                        new Sale(
                            id: 1,
                            seller: new Seller(
                                id: 1,
                                name: 'John Doe',
                                email: 'Wl4wU@example.com',
                                commission: new Commission(value: 10),
                            ),
                            amount: 1000,
                            date: '2023-06-01',
                            appliedCommission: new Commission(value: 10),
                        ),
                        new Sale(
                            id: 2,
                            seller: new Seller(
                                id: 1,
                                name: 'John Doe',
                                email: 'Wl4wU@example.com',
                                commission: new Commission(value: 10),
                            ),
                            amount: 1000,
                            date: '2023-06-01',
                            appliedCommission: new Commission(value: 10),
                        ),
                    ];
                }
            });

        $sales = $this->listUseCase->execute($filter);
        $this->assertInstanceOf(IteratorAggregate::class, $sales);
    }
}
