<?php

namespace Tests\Feature;

use App\Application\DTOs\Filters\SellerFilterDTO;
use App\Application\DTOs\SellerDTO;
use App\Application\UseCases\Sellers\CreateSellerUseCase;
use App\Application\UseCases\Sellers\FindSellerUseCase;
use App\Application\UseCases\Sellers\ListSellersUseCase;
use App\Domain\Entities\Seller;
use App\Domain\Repositories\SellerRepositoryInterface;
use App\Domain\ValueObjects\Commission;
use Illuminate\Foundation\Testing\RefreshDatabase;
use IteratorAggregate;
use Mockery;
use Tests\TestCase;

class SellerWorkflowTest extends TestCase
{
    use RefreshDatabase;

    private CreateSellerUseCase $createUseCase;
    private ListSellersUseCase $listUseCase;
    private FindSellerUseCase $findUseCase;
    private SellerRepositoryInterface $repositoryMock;

    public function setUp(): void
    {
        parent::setUp();

        $this->repositoryMock = Mockery::mock(SellerRepositoryInterface::class);

        $this->createUseCase = new CreateSellerUseCase($this->repositoryMock);
        $this->listUseCase = new ListSellersUseCase($this->repositoryMock);
        $this->findUseCase = new FindSellerUseCase($this->repositoryMock);
    }

    public function test_seller_create_workflow()
    {
        $sellerEntity = new Seller(
            id: null,
            name: 'John Doe',
            email: 'Wl4wU@example.com',
            commission: new Commission(value: 10),
        );

        $sellerDTO = new SellerDTO(
            name: $sellerEntity->name,
            email: $sellerEntity->email,
            commission: $sellerEntity->commission->value(),
        );

        /**
         * @var Mockery\MockInterface $repo
         */
        $repo = $this->repositoryMock;

        $repo->shouldReceive('save')
            ->once()
            ->with(Mockery::on(fn($arg) => $arg instanceof Seller))
            ->andReturn($sellerEntity);

        $createdSeller = $this->createUseCase->execute($sellerDTO);

        $this->assertEquals($sellerEntity->name, $createdSeller->name);
        $this->assertEquals($sellerEntity->email, $createdSeller->email);
        $this->assertInstanceOf(Seller::class, $createdSeller);
        $this->assertInstanceOf(Commission::class, $createdSeller->commission);
    }

    public function test_seller_list_workflow()
    {
        $filters = new SellerFilterDTO(
            name: null,
            email: null,
            page: 1,
            perPage: 10,
        );

        /**
         * @var Mockery\MockInterface $repo
         */
        $repo = $this->repositoryMock;

        $repo->shouldReceive('list')
            ->once()
            ->with($filters)
            ->andReturn(new class implements IteratorAggregate {
                public function getIterator(): \Traversable
                {
                    yield from [
                        new Seller(
                            id: 1,
                            name: 'John Doe',
                            email: 'Wl4wU@example.com',
                            commission: new Commission(value: 10),
                        ),
                        new Seller(
                            id: 2,
                            name: 'John Doe',
                            email: 'Wl4wU@example.com',
                            commission: new Commission(value: 10),
                        ),
                    ];
                }
            });

        $result = $this->listUseCase->execute($filters);
        $this->assertInstanceOf(IteratorAggregate::class, $result);
    }

    public function test_seller_find_workflow()
    {
        $seller = new Seller(
            id: 1,
            name: 'John Doe',
            email: 'Wl4wU@example.com',
            commission: new Commission(value: 10),
        );

        /**
         * @var Mockery\MockInterface $repo
         */
        $repo = $this->repositoryMock;

        $repo->shouldReceive('find')
            ->once()
            ->with(1)
            ->andReturn($seller);

        $result = $this->findUseCase->execute(1);
        $this->assertInstanceOf(Seller::class, $result);
    }
}
