<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Document</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Muli:400,600,700,800">
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
    <div style="height: 50%;">
        <table class="no-border-top">
            <tr>
                <td style="width: 30mm;">
                    <img src="{{ public_path('/pdf/logo/rcf-black.jpg') }}" alt="" width="100%">
                </td>
                <td style="width: 10mm;"></td>
                <td style="width: 80mm;">
                    <h1>
                        <div><small>Bon de retour</small></div>
                        <div>{{ Str::substr($productReturn->identifier, 0, 3) }}&nbsp;{{ Str::substr($productReturn->identifier, 3, 3) }}</div>
                    </h1>
                </td>
                <td>
                    <img src="{{ public_path(DNS1D::getBarcodePNGPath($productReturn->identifier, 'C39', 1.8, 80, [0,0,0], true )) }}" alt="">
                </td>
            </tr>
        </table>
        <table class="w-full">
            <tr>
                <td id="sender" style="width: 78mm; padding: 1rem; border: 2px solid black;">
                    <div><span class="semibold">Expéditeur</span></div>
                    <div style="font-size: 14px;">@include('pdf.product-returns.partials.routing-from')</div>
                </td>
                <td style="width: 10mm;"></td>
                <td id="recipient" style="width: 78mm; padding: 1rem; border: 2px solid black;">
                    <div><span class="semibold">Destinataire</span></div>
                    <div style="font-size: 14px;">
                        @include('pdf.product-returns.partials.routing-to')
                    </div>
                </td>
            </tr>
        </table>
        <table class="w-full">
            <tr>
                <td class="w-third" style="padding: 1rem;">
                    <h3>Type</h3>
                    {{ ucfirst($productReturn->type_label) }}
                </td>
                <td class="w-third" style="padding: 1rem;">
                    <h3>Contexte</h3>
                    {{ $productReturn->context_label }}
                </td>
                <td class="w-third" style="padding: 1rem;">
                    <h3>Motif</h3>
                    {{ ucfirst($productReturn->reason) }}
                </td>
            </tr>
            <tr>
                <td class="w-third" style="padding: 1rem; border: 2px solid black;">
                    <h3>Assignation</h3>
                    {{ ucfirst($productReturn->assignation) }}
                </td>
                <td class="w-third" style="padding: 1rem;">
                    <h3>Action</h3>
                    {{ ucfirst($productReturn->action ?? '-') }}
                </td>
                <td class="w-third" style="padding: 1rem;">
                    <h3>Destination</h3>
                    {{ ucfirst($productReturn->destination) }}
                </td>
            </tr>
        </table>
    </div>
    <div>
        <table class="w-full">
            <tr>
                <td class="w-third">
                    <h3>N° de dossier associé</h3>
                    <div>{{ $productReturn->ticket ? $productReturn->ticket->id : 'Non renseigné' }}</div>
                </td>
                <td class="w-third">
                    @if($productReturn->serial)
                        <div>
                            <h3>Vélo concerné</h3>
                            <div>{{ $productReturn->serial_code }}</div>
                            <div>{{ $productReturn->serial_itno }}</div>
                            <div>{{ $productReturn->serial_itds }}</div>
                            <div>{{ $productReturn->serial ? $productReturn->serial->item->brand->code : $productReturn->serial_itcl }}</div>
                        </div>
                    @else
                        <div>
                            <h3>Composant concerné</h3>
                            <div>{{ $productReturn->item_itno }}</div>
                            <div>{{ $productReturn->item_itds }}</div>
                        </div>
                    @endif
                </td>
                <td class="w-third">
                    <h3>Informations de vente</h3>
                    <div>Date de vente distributeur : {{ date('d/m/Y', strtotime($productReturn->bike_sold_at)) ?? '-' }}</div>
                    <div>Date de vente consommateur : {{ date('d/m/Y', strtotime($productReturn->bike_purchased_at )) ?? '-' }}</div>
                    <div>Commande : {{ $productReturn->order ?? '-' }}</div>
                    <div>Facture : {{ $productReturn->invoice ?? '-' }}</div>
                    <div>Bon de livraison : {{ $productReturn->delivery ?? '-' }}</div>
                    <div>Code client : {{ $productReturn->ticket?->contact?->code }}</div>
                </td>
            </tr>
        </table>
        <table class="w-full">
            <tr>
                <td class="w-full">
                    <h3>Informations</h3>
                    {{ $productReturn->info }}
                </td>
            </tr>
        </table>
    </div>
    <table class="w-full no-border-top" style="position: absolute; bottom: 0; left: 0;">
        <tr>
            <td class="w-third">
                Date : {{ $productReturn->created_at }}
            </td>
            <td>
                Agent : {{ $productReturn->author->username }}
            </td>
        </tr>
    </table>
</body>
</html>
