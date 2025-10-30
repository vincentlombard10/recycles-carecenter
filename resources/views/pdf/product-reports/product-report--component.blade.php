<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Document</title>
    @vite(['resources/scss/pdf.scss'])
    <style media="all">
        @font-face {
            font-family: 'Poppins';
            font-style: normal;
            font-weight: 400;
            src: url('{{ public_path('fonts/poppins/Poppins-Regular.ttf') }}') format('truetype');
        }
        @font-face {
            font-family: 'Poppins-Bold';
            font-style: normal;
            font-weight: 600;
            src: url('{{ public_path('fonts/poppins/Poppins-Bold.ttf') }}') format('truetype');
        }
        @font-face {
            font-family: 'Poppins-Semibold';
            font-style: normal;
            font-weight: 600;
            src: url('{{ public_path('fonts/poppins/Poppins-SemiBold.ttf') }}') format('truetype');
        }

        body {
            font-family: 'Poppins', sans-serif;
            font-size: 12px;
            line-height: 12px;
        }
        .bold {
            font-family: 'poppins-bold', sans-serif;
            font-weight: 600;
        }
        .semibold {
            font-family: 'poppins-semibold', sans-serif;
            font-weight: 600;
        }

        h1 {
            font-family: 'poppins-bold', sans-serif;
            font-weight: 600;
            font-size: 32px;
            line-height: 20px;
            margin: 0;
        }

        h2 {
            font-family: 'poppins-bold', sans-serif;
            font-weight: 600;
            font-size: 24px;
            line-height: 20px;
            border-bottom: 1Px solid black;
            padding-bottom: 3mm;
            margin-bottom: 3mm;
        }

        h3 {
            font-family: 'poppins-bold', sans-serif;
            font-weight: 600;
            font-size: 16px;
            margin: 0;
        }

        h4 {
            font-family: 'poppins-bold', sans-serif;
            font-weight: 600;
            margin: 0;
        }

        table {
            margin-bottom: 10mm;
        }
        table thead tr th {
            text-align: left;
        }

        table tr td {
            vertical-align: top;
            padding-top: 0.2cm;
        }

        .w-full {
            width: 100%
        }

        .w-half {
            width: 50%
        }

        .w-third {
            width: 33.33%;
        }

        .w-quarter {
            width: 25%;
        }
    </style>
</head>
<body>
<table class="no-border-top">
    <tr>
        <td style="width: 30mm;">
            <img src="{{ public_path('/pdf/logo/rcf-black.jpg') }}" alt="" width="100%">
        </td>
        <td style="width: 10mm;"></td>
        <td style="width: 140mm;">
            <h1>
                <div><small>Rapport d'intervention composant</small></div>
                <div>{{ Str::substr($productReport->identifier, 0, 3) }}{{ Str::substr($productReport->identifier, 3, 3) }}</div>
            </h1>
        </td>
    </tr>
</table>
<table class="w-full">
    <tr>
        <td id="sender" style="width: 88mm;">
            <div><span class="semibold">Expéditeur</span></div>
            <div style="font-size: 14px;">@include('pdf.product-reports.partials.routing-to')</div>
        </td>
        <td style="width: 10mm;"></td>
        <td id="recipient" style="width: 88mm;">
            <div><span class="semibold">Destinataire</span></div>
            <div style="font-size: 14px;">
                @if($productReport->return->return_to_id)
                    @include('pdf.product-reports.partials.return-to')
                @else
                    @include('pdf.product-reports.partials.routing-from')
                @endif
            </div>
        </td>
    </tr>
</table>
<h2>1. Contrôles</h2>
<table class="w-full">
    <tbody>
    <tr>
        <td class="w-full">
            <h4>Etat visuel du produit</h4>
            <div style="margin-bottom: 3mm;">{{ $productReport->description }}</div>
            <h4>Défaut constaté</h4>
            <div style="margin-bottom: 3mm;">{{ $productReport->defect }}</div>
            <h4>Tests ralisés</h4>
            <div style="margin-bottom: 3mm;">{{ $productReport->tests }}</div>
        </td>
    </tr>
    </tbody>
</table>
<h2>2. Composants remplacés</h2>
<table id="components-replaced" class="w-full">
    <thead>
    <tr>
        <th><span class="semibold">Référence</span></th>
        <th><span class="semibold">Désignation</span></th>
        <th><span class="semibold">Qté</span></th>
        <th><span class="semibold">Prise en charge</span></th>
    </tr>
    </thead>
    <tbody>
    @foreach($productReport->replacementItems as $item)
        <tr>
            <td><span class="semibold">{{ $item->itno }}</span></td>
            <td>{{ $item->itds }}</td>
            <td>{{ $item->quantity }}</td>
            <td>{{ $item->care }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
<table id="components-replaced-other-info" class="w-full">
    <tbody>
    <tr>
        <td class="w-half">
            <h4>Commande</h4>
            <div>{{ $productReport->order }}</div>
        </td>
        <td class="w-half">&nbsp;</td>
    </tr>
    </tbody>
</table>
<table class="w-full" style="padding: 0 2mm; background-color: rgb(0,0,0,0.05);">
    <tr>
        <td class="w-half">
            <span class="semibold">Rapport d'intervention édité le </span> {{ date('d/m/Y à H:i', strtotime($productReport->closed_at)) }}
        </td>
        <td class="half">
            Agent : ---
        </td>
    </tr>
</table>
</body>
</html>
