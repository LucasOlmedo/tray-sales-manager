<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Relatório Diário de Vendas</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            background-color: #f4f4f4;
            color: #333;
            padding: 20px;
        }
        .container {
            max-width: 600px;
            margin: auto;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            color: #2c3e50;
            text-align: center;
        }
        .info {
            margin: 20px 0;
            font-size: 16px;
        }
        .total-sales {
            font-size: 20px;
            font-weight: bold;
            color: #27ae60;
            text-align: center;
            padding: 10px;
            background: #ecf0f1;
            border-radius: 5px;
        }
        .table-sales {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            text-align: center;
        }
        .table-sales th, .table-sales td {
            border: 1px solid #ddd;
            padding: 5px;
            text-align: center;
            font-size: 13px;
        }
        .footer {
            margin-top: 20px;
            text-align: center;
            font-size: 12px;
            color: #7f8c8d;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>📊 Relatório de Vendas</h1>

    <p class="info">
        - Período: 
        <strong>{{ $report->startPeriod->format('d/m/Y H:i:s') }}</strong>
        até
        <strong>{{ $report->endPeriod ? $report->endPeriod->format('d/m/Y H:i:s') : now()->format('d/m/Y H:i:s') }}</strong>.
    </p>

    <div class="total-sales">
        💰 Total de Vendas: R$ {{ number_format($report->totalSaleAmount, 2, ',', '.') }}
        <br>
        💰 Comissões Sobre Vendas: R$ {{ number_format($report->getTotalCommissionAmount(), 2, ',', '.') }}
    </div>

    <table class="table-sales">
        <thead>
            <tr>
                <th>Data</th>
                <th>Vendedor</th>
                <th>Valor da Venda</th>
                <th>Comissão</th>
            </tr>
        </thead>
        <tbody>
            @foreach($report->saleList as $sale)
                <tr>
                    <td>{{ $sale->date }}</td>
                    <td>{{ $sale->seller->name }} - {{ $sale->seller->email }}</td>
                    <td>R$ {{ number_format($sale->amount, 2, ',', '.') }}</td>
                    <td>R$ {{ number_format($sale->getSellerAmount(), 2, ',', '.') }}  ({{ $sale->appliedCommission->value() }}%)</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <p class="footer">
        Este é um e-mail automático. Por favor, não responda.
    </p>
</div>

</body>
</html>
