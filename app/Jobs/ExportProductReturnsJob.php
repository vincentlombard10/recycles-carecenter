<?php

namespace App\Jobs;

use App\Events\ProductReturnsExported;
use App\Models\ProductReturn;
use Exception;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;
use OpenSpout\Common\Entity\Cell;
use OpenSpout\Common\Entity\Row;
use OpenSpout\Common\Entity\Style\Border;
use OpenSpout\Common\Entity\Style\BorderPart;
use OpenSpout\Common\Entity\Style\CellAlignment;
use OpenSpout\Common\Entity\Style\Color;
use OpenSpout\Common\Entity\Style\Style;
use OpenSpout\Common\Exception\InvalidArgumentException;
use OpenSpout\Writer\Exception\Border\InvalidNameException;
use OpenSpout\Writer\Exception\Border\InvalidStyleException;
use OpenSpout\Writer\Exception\Border\InvalidWidthException;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use Spatie\SimpleExcel\SimpleExcelWriter;

class ExportProductReturnsJob extends BaseExportJob implements ShouldQueue
{
    use Dispatchable,
        InteractsWithQueue,
        Queueable,
        SerializesModels;

    public int $timeout = 600;

    /**
     * Create a new job instance.
     * @throws InvalidArgumentException
     */
    public function __construct(
        public Authenticatable $user,
        public $start_time = null,
        public $end_time = null
    )
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

            $this->filename = sprintf('Retours_%s.xlsx', \Carbon\Carbon::now()->format('YmdHis'));
            $start_time = $this->start_time ?? now()->subDays(30)->startOfDay()->toDateTimeString();
            $end_time = $this->end_time ?? now()->endOfDay()->toDateTimeString();

            $returns = ProductReturn::query()->where(function ($query) use ($start_time, $end_time) {
                $query->whereDate('created_at', '>=', $start_time);
                $query->whereDate('created_at', '<=', $end_time);
            })->orderByDesc('id')->get();

            $writer = SimpleExcelWriter::create(
                Storage::disk('exports')->path($this->filename),
                '',
                function ($writer) {
                    $options = $writer->getOptions();
                    $options->DEFAULT_COLUMN_WIDTH = 15;
                    $options->DEFAULT_ROW_HEIGHT = 20;
                    $options->DEFAULT_CELL_STYLE = $this->defaultCellStyle;
                }
            );

            $headerRow = [
                'Identifiant',
                'Type',
                'Contexte',
                'Ticket',
                'Code client',

                'Nom Client',
                'Statut',

                'Créé le',
                'Par',
                'Validé le',
                'Par',
                'Reçu le',
                'Par',
            ];

            $writer->addHeader($headerRow);
            $writer->setHeaderStyle($this->headerCellStyle);

            foreach ($returns as $return) {

                $row = new Row([
                    Cell::fromValue($return->identifier, $this->defaultCellStyle),
                    Cell::fromValue($return->type),
                    Cell::fromValue($return->context),
                    Cell::fromValue($return->ticket?->id),
                    Cell::fromValue($return->ticket?->contact?->code),

                    Cell::fromValue($return->ticket?->contact?->name),
                    Cell::fromValue($return->status),

                    Cell::fromValue($return->created_at ? date('d/m/Y H:i:s', strtotime($return->created_at)) : null),
                    Cell::fromValue($return->author?->username),
                    Cell::fromValue($return->validated_at ? date('d/m/Y H:i:s', strtotime($return->validated_at)) : null),
                    Cell::fromValue($return->validator?->username),
                    Cell::fromValue($return->received_at ? date('d/m/Y H:i:s', strtotime($return->received_at)) : null),
                    Cell::fromValue($return->receiver?->username),
                ]);
                $writer->addRow($row);

            }
            $writer->close();

            ProductReturnsExported::dispatch($this->user, $this->filename);

        } catch (Exception $exception) {

        }
    }
}
