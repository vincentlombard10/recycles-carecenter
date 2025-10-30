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

        body {
            font-family: 'Poppins', sans-serif;
            font-size: 12px;
            line-height: 12px;
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
            padding-bottom: 1mm;
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
                <div><small>Rapport d'intervention batterie</small></div>
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
<h2>1. Diagnostic de la batterie</h2>
<table id="battery-identification" class="w-full no-border-top">
    <tbody>
    <tr>
        <td class="w-half">
            <h3 style="margin-bottom: 1mm;">Identification</h3>
            <div><span class="semibold">Référence de la batterie</span></div>
            <div style="margin-bottom: 3mm;">{{ $productReport->reference }}</div>
            <div><span class="semibold">Type</span></div>
            <div style="margin-bottom: 3mm;">{{ $productReport->battery_type }}</div>
            <div><span class="semibold">Numéro de série</span></div>
            <div style="margin-bottom: 3mm;">{{ $productReport->battery_serial }}</div>
            <div><span class="semibold">Tension nominale</span></div>
            <div style="margin-bottom: 3mm;">{{ $productReport->battery_nominal_voltage_label }}</div>
            <div><span class="semibold">Capacité nominale</span></div>
            <div>{{ $productReport->battery_nominal_capacity_label }}</div>
        </td>
        <td class="w-half">
            <h3 style="margin-bottom: 1mm;">Etat visuel</h3>
            <div>
                @foreach($productReport->batteryStates as $bs)
                    <li style="margin-bottom: 2mm">
                        <div class="semibold">{{ $bs->title }}</div>
                        <div>{{ $bs->description }}</div>
                    </li>
                @endforeach
            </div>
            <div>{{ $productReport->battery_look_custom_state }}</div>
        </td>
    </tr>
    </tbody>
</table>
<table id="battery-state" class="w-full no-border-top">
    <tbody>
    <tr>
        <td class="w-half">
            <h3 style="margin-bottom: 1mm;">Tests de fonctionnement</h3>
            <div><span class="semibold">La batterie s'allume t-elle ?</span></div>
            <div style="margin-bottom: 3mm;">{{ $productReport->battery_indicator_label }}</div>
            <div><span class="semibold">Codes erreur</span></div>
            <div style="margin-bottom: 3mm;">{{ $productReport->battery_error_codes_label }}</div>
        </td>
        <td class="w-half">
            <h3 style="margin-bottom: 1mm;">Tests de charge - décharge</h3>
            <h4>Charge</h4>
            <div><span class="semibold">La charge se lance-t-elle normalement ?</span></div>
            <div style="margin-bottom: 3mm;">{{ $productReport->battery_charge_state_label }}</div>
            <div><span class="semibold">Tension aux bornes de la batterie</span></div>
            <div style="margin-bottom: 3mm;">{{ $productReport->battery_charge_voltage_label }}</div>
            <h4>Capacité banc de charge</h4>
            <div><span class="semibold">Energie totale délivrée</span></div>
            <div style="margin-bottom: 3mm;">{{ $productReport->battery_energy_label }}</div>
        </td>
    </tr>
    </tbody>
</table>
<table id="battery-diag" class="w-full no-border-top">
    <tbody>
    <tr>
        <td class="w-half">
            <h3 style="margin-bottom: 1mm;">Diagnostic via le BMS</h3>
            <div><span class="semibold">Cycles de charge </span></div>
            <div style="margin-bottom: 3mm;">{{ $productReport->battery_charge_cycles }}</div>
            <div><span class="semibold">Etat des cellules</span></div>
            <div style="margin-bottom: 3mm;">{{ $productReport->battery_cells_state_label }}</div>
            <div><span class="semibold">Capacité utile</span></div>
            <div style="margin-bottom: 3mm;">{{ $productReport->battery_usable_capacity }}</div>
            <div><span class="semibold">Température</span></div>
            <div style="margin-bottom: 3mm;">{{ $productReport->battery_temperature_label }}</div>
            <div><span class="semibold">Résistance interne</span></div>
            <div style="margin-bottom: 3mm;">{{ $productReport->battery_internal_resistance_label }}</div>
        </td>
        <td class="w-half">
            <div><span class="semibold">Diagnostic</span></div>
            <div style="margin-bottom: 3mm;">{{ $productReport->diagnostic }}</div>
        </td>
    </tr>
    </tbody>
</table>
@if($productReport->replacementItems->count())
    <h2>2. Composants remplacés</h2>
    <table id="components-replaced" class="w-full">
        <thead>
        <tr>
            <th>Référence</th>
            <th>Désignation</th>
            <th>Qté</th>
            <th>Prise en charge</th>
        </tr>
        </thead>
        <tbody>
        @foreach($productReport->replacementItems as $item)
            <tr>
                <td>{{ $item->itno }}</td>
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
                <div>{{ $productReport->order ?? '-' }}</div>
            </td>
            <td class="w-half">&nbsp;</td>
        </tr>
        </tbody>
    </table>
    <table class="w-full" style="padding: 0 2mm; background-color: rgb(0,0,0,0.05);">
        <tr>
            <td class="w-half">
                <span
                    class="semibold">Rapport d'intervention édité le </span> {{ date('d/m/Y à H:i', strtotime($productReport->closed_at)) }}
            </td>
            <td class="half">
                Agent : ---
            </td>
        </tr>
    </table>
@endif
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
