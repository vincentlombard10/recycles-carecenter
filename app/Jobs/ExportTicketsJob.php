<?php

namespace App\Jobs;

use AllowDynamicProperties;
use App\Events\TicketsExported;
use App\Models\Ticket;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use OpenSpout\Common\Entity\Cell;
use OpenSpout\Common\Entity\Row;
use Matrix\Exception;
use Spatie\SimpleExcel\SimpleExcelWriter;

#[AllowDynamicProperties] class ExportTicketsJob extends BaseExportJob implements ShouldQueue
{
    use Dispatchable,
        InteractsWithQueue,
        \Illuminate\Bus\Queueable,
        SerializesModels;

    public int $timeout = 600;

    /**
     * Create a new job instance.
     */
    public function __construct(public Authenticatable $user, public $start_time = null, public $end_time = null)
    {
        parent::__construct();
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        ini_set('max_execution_time', 3600);
        ini_set('memory_limit', -1);

        try {

            $this->filename = sprintf('Tickets_%s.xlsx', \Carbon\Carbon::now()->format('YmdHis'));
            $start_time = $this->start_time ?? now()->subDays(30)->startOfDay()->toDateTimeString();
            $end_time = $this->end_time ?? now()->endOfDay()->toDateTimeString();

            Log::info($start_time);
            Log::info($end_time);

            $tickets = Ticket::query()->where(function ($query) use ($start_time, $end_time) {
                $query->whereDate('created_at', '>=', $start_time);
                $query->whereDate('created_at', '<=', $end_time);
            })->orderByDesc('id')->get();

            $writer = SimpleExcelWriter::create(
                Storage::disk('exports')->path($this->filename),
                '',
                function ($writer) {
                    $options = $writer->getOptions();
                    $options->DEFAULT_COLUMN_WIDTH = 25;
                    $options->DEFAULT_ROW_HEIGHT = 20;
                }
            );

            $headerRow = [
                'IZ Zendesk', 'Type de demande', 'Coode client', 'Statut', 'Chassis',
                'SKU', 'Type de produit', 'Commentaire client', 'Vente conso', 'Marque',
                'Type de composant', 'Type de défaut', 'Origine du défaut', 'Référence composant', 'Création',
                'Résolution',
            ];

            $writer->addHeader($headerRow);

            $writer->setHeaderStyle($this->headerCellStyle);

            foreach ($tickets as $ticket) {
                $row = (new Row([
                    Cell::fromValue($ticket->id),
                    Cell::fromValue($ticket->fields()->wherePivot('ticketfield_id', 360013813919)->first()->value),
                    Cell::fromValue($ticket->contact ? $ticket->contact->code : '-'),
                    Cell::fromValue($ticket->status),
                    Cell::fromValue($ticket->user_external_id),

                    Cell::fromValue($ticket->fields()->wherePivot('ticketfield_id', 23839797779090)->first()->value),
                    Cell::fromValue($ticket->fields()->wherePivot('ticketfield_id', 23839621467666)->first()->value),
                    Cell::fromValue('value'),
                    Cell::fromValue($ticket->fields()->wherePivot('ticketfield_id', 16604606187794)->first()->value),
                    Cell::fromValue($ticket->fields()->wherePivot('ticketfield_id', 25461954818834)->first()->value),


                    Cell::fromValue('value'),
                    Cell::fromValue('value'),
                    Cell::fromValue('value'),
                    Cell::fromValue('value'),
                    Cell::fromValue(date('Y-m-d H:i:s', $ticket->created_at)),

                    Cell::fromValue(''),
                ]));
                $writer->addRow($row);
            }
            $writer->close();

            TicketsExported::dispatch($this->user, $this->filename);

        } catch (Exception $exception) {

            Log::error($exception->getMessage());

        }
    }
}
