<!DOCTYPE html>
<html>
<head>
    <title>Factura de Recarga</title>
    <style>
        body { font-family: Arial, sans-serif; }
        .invoice-box { max-width: 800px; margin: auto; padding: 30px; border: 1px solid #eee; box-shadow: 0 0 10px rgba(0, 0, 0, 0.15); }
        .invoice-box table { width: 100%; line-height: inherit; text-align: left; }
        .invoice-box table td { padding: 5px; vertical-align: top; }
        .invoice-box table tr td:nth-child(2) { text-align: right; }
        .invoice-box table tr.top table td { padding-bottom: 20px; }
        .invoice-box table tr.information table td { padding-bottom: 40px; }
        .invoice-box table tr.heading td { background: #eee; border-bottom: 1px solid #ddd; font-weight: bold; }
        .invoice-box table tr.details td { padding-bottom: 20px; }
        .invoice-box table tr.item td { border-bottom: 1px solid #eee; }
        .invoice-box table tr.item.last td { border-bottom: none; }
        .invoice-box table tr.total td:nth-child(2) { border-top: 2px solid #eee; font-weight: bold; }
    </style>
</head>
<body>
    <div class="invoice-box">
        <table>
            <tr class="top">
                <td colspan="2">
                    <table>
                        <tr>
                            <td class="title">
                                <h2>Factura de Recarga</h2>
                            </td>
                            <td>
                                Fecha: {{ $recarga->created_at }}
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr class="information">
                <td colspan="2">
                    <table>
                        <tr>
                            <td>
                                Comercio: {{ $recarga->comercio->razon_social }}<br>
                                Dirección: {{ $recarga->comercio->direccion }}
                            </td>
                            <td>
                                Usuario: {{ $recarga->dni }}<br>
                                Patente: {{ $recarga->patente }}
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr class="heading">
                <td>Descripción</td>
                <td>Importe</td>
            </tr>
            <tr class="item">
                <td>Recarga de saldo</td>
                <td>{{ $recarga->importe }}</td>
            </tr>
            <tr class="total">
                <td></td>
                <td>Total: {{ $recarga->importe }}</td>
            </tr>
        </table>
    </div>
</body>
</html>
