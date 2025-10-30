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
                    <div><small>Rapport d'intervention</small></div>
                    <div>{{ Str::substr($productReport->identifier, 0, 3) }}
                        &nbsp;{{ Str::substr($productReport->identifier, 3, 3) }}</div>
                </h1>
            </td>
        </tr>
    </table>
    <table class="w-full">
        <tr>
            <td id="sender" style="width: 88mm;">
                <div>Expéditeur</div>
                <div style="font-size: 14px;">@include('pdf.product-reports.partials.routing-to')</div>
            </td>
            <td style="width: 10mm;"></td>
            <td id="recipient" style="width: 88mm;">
                <div>Destinataire</div>
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
    <table class="w-full" style="padding: 0 2mm; background-color: rgb(0,0,0,0.05);">
        <tr>
            <td class="w-third">
                Date : {{ $productReport->closed_at }}
            </td>
            <td>
                Agent : ---
            </td>
        </tr>
    </table>
    <h2>Contrôles</h2>
    <table id="presence-checks" class="w-full">
        <thead>
        <tr>
            <th colspan="4">
                <h3>Présence des organes</h3>
            </th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td class="w-quarter">
                <h4>Clé de batterie</h4>
                <div>{{ $productReport->battery_key_label }}</div>
            </td>
            <td class="w-quarter">
                <h4>Clé d'antivol</h4>
                <div>{{ $productReport->lock_key_label }}</div>
            </td>
            <td class="w-quarter">
                <h4>Chargeur</h4>
                <div>{{ $productReport->charger_label }}</div>
            </td>
            <td class="w-quarter">
                <h4>Batterie</h4>
                <div>{{ $productReport->battery_label }}</div>
            </td>
        </tr>
        <tr>
            <td class="w-quarter">
                <h4>Pédales</h4>
                <div>{{ $productReport->pedals_label }}</div>
            </td>
            <td class="w-quarter">
                <h4>Roue avant</h4>
                <div>{{ $productReport->front_wheel_label }}</div>
            </td>
            <td class="w-quarter">
                <h4>Roue arrière</h4>
                <div>{{ $productReport->rear_wheel_label }}</div>
            </td>
            <td class="w-quarter">
                <h4>Selle</h4>
                <div>{{ $productReport->saddle_label }}</div>
            </td>
        </tr>
        <tr>
            <td class="w-quarter">
                <h4>Tige de selle</h4>
                <div>{{ $productReport->seatpost_label }}</div>
            </td>
            <td class="w-quarter">
                <h4>Display</h4>
                <div>{{ $productReport->display_label }}</div>
            </td>
            <td class="w-quarter">
                <h4>Moteur</h4>
                <div>{{ $productReport->motor_label }}</div>
            </td>
            <td class="w-quarter">&nbsp;</td>
        </tr>
        <tr>
            <td colspan="4">
                <h4>Commentaire</h4>
                <div>{{ $productReport->presence_comment }}</div>
            </td>
        </tr>
        </tbody>
    </table>
    <table id="look-checks" class="w-full">
        <thead>
        <tr>
            <th colspan="4">
                <h3>Etat visuel</h3>
            </th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td class="w-quarter">
                <h4>Rayures</h4>
                <div>{{ $productReport->stripes_label }}</div>
            </td>
            <td class="w-quarter">
                <h4>Corrosion</h4>
                <div>{{ $productReport->corrosion_label }}</div>
            </td>
            <td class="w-quarter">
                <h4>Terre</h4>
                <div>{{ $productReport->clay_label }}</div>
            </td>
            <td class="w-quarter">
                <h4>Sable</h4>
                <div>{{ $productReport->sand_label }}</div>
            </td>
        </tr>
        <tr>
            <td class="w-quarter">
                <h4>Impacts</h4>
                <div>{{ $productReport->impacts_label }}</div>
            </td>
            <td class="w-quarter">
                <h4>Fissures</h4>
                <div>{{ $productReport->cracks_label }}</div>
            </td>
            <td class="w-quarter">
                <h4>Casse</h4>
                <div>{{ $productReport->breakage_label }}</div>
            </td>
            <td class="w-quarter">
                <h4>Modifications</h4>
                <div>{{ $productReport->modification_label }}</div>
            </td>
        </tr>
        <tr>
            <td colspan="4">
                <h4>Commentaire</h4>
                <div>{{ $productReport->look_comment }}</div>
            </td>
        </tr>
        </tbody>
    </table>
    <table id="other-checks" class="w-full">
        <thead>
        <tr>
            <th colspan="4">
                <h3>Autres informations</h3>
            </th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td class="w-quarter">
                <h4>Kilométrage</h4>
            </td>
            <td class="w-quarter">&nbsp;</td>
            <td class="w-quarter">&nbsp;</td>
            <td class="w-quarter">&nbsp;</td>
        </tr>
        </tbody>
    </table>
    <h2>Diagnostic de la batterie</h2>
    <table id="battery-identification" class="w-full no-border-top">
        <tbody>
        <tr>
            <td class="w-half">
                <h3 style="margin-bottom: 1mm;">Identification</h3>
                <div>Référence de la batterie : {{ $productReport->reference }}</div>
                <div>Type : {{ $productReport->battery_type }}</div>
                <div>Numéro de série : {{ $productReport->battery_serial }}</div>
                <div>Tension nominale : {{ $productReport->battery_nominal_voltage }}</div>
                <div>Capacité nominale : {{ $productReport->battery_nominal_capacity }}</div>
            </td>
            <td class="w-half">
                <h3 style="margin-bottom: 1mm;">Etat visuel</h3>
                <div>{{ $productReport->battery_look_states }}</div>
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
                <div>La batterie s'allume t-elle ? : {{ $productReport->battery_indicator }}</div>
                <div>Codes erreur : {{ $productReport->battery_error_codes ?? '-' }}</div>
            </td>
            <td class="w-half">
                <h3 style="margin-bottom: 1mm;">Tests de charge - décharge</h3>
                <h4>Charge</h4>
                <div>La charge se lance-t-elle normalement ? : {{ $productReport->battery_charge_state }}</div>
                <div>Tension aux bornes de la batterie : {{ $productReport->battery_charge_voltage }}</div>
                <h4>Capacité banc de charge</h4>
                <div>Energie totale délivrée : {{ $productReport->battery_energy }}</div>
            </td>
        </tr>
        </tbody>
    </table>
    <table id="battery-diag" class="w-full no-border-top">
        <tbody>
        <tr>
            <td class="w-half">
                <h3 style="margin-bottom: 1mm;">Diagnostic via le BMS</h3>
                <div>Cycles de charge : {{ $productReport->battery_charge_cycles }}</div>
                <div>Etat des cellules : {{ $productReport->battery_cells_state }}</div>
                <div>Capacité utile : {{ $productReport->battery_usable_capacity }}</div>
                <div>Température : {{ $productReport->battery_temperature }}</div>
                <div>Résistance interne : {{ $productReport->battery_internal_resistance }}</div>
                <div>Diagnostic : {{ $productReport->diagnostic }}</div>
            </td>
            <td class="w-half">
                <h4>Diagnostic</h4>
                <div>{{ $productReport->diagnostic }}</div>
            </td>
        </tr>
        </tbody>
    </table>
    <h2>Composants remplacés</h2>
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
                <div>{{ $productReport->order }}</div>
            </td>
            <td class="w-half">&nbsp;</td>
        </tr>
        </tbody>
    </table>
</div>
</body>
</html>
