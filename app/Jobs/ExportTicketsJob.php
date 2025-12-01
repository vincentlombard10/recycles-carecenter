<?php

namespace App\Jobs;

use AllowDynamicProperties;
use App\Events\TicketsExported;
use App\Models\Serial;
use App\Models\Ticket;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use OpenSpout\Common\Entity\Cell;
use OpenSpout\Common\Entity\Row;
use OpenSpout\Common\Entity\Style\Border;
use OpenSpout\Common\Entity\Style\BorderPart;
use OpenSpout\Common\Entity\Style\CellAlignment;
use OpenSpout\Common\Entity\Style\Color;
use OpenSpout\Common\Entity\Style\Style;
use Exception;
use OpenSpout\Common\Exception\InvalidArgumentException;
use OpenSpout\Writer\Exception\Border\InvalidNameException;
use OpenSpout\Writer\Exception\Border\InvalidStyleException;
use OpenSpout\Writer\Exception\Border\InvalidWidthException;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use Spatie\SimpleExcel\SimpleExcelWriter;
use Illuminate\Foundation\Queue\Queueable;

#[AllowDynamicProperties] class ExportTicketsJob extends BaseExportJob implements ShouldQueue
{
    use Dispatchable,
        InteractsWithQueue,
        Queueable,
        SerializesModels;

    public int $timeout = 3600;

    public Style $headerCellStyle;
    public Style $defaultCellStyle;
    public Style $emptyCellStyle;
    public Style $identityCellStyle;
    public Style $centeredCellStyle;
    public Style $statusNewCellStyle;
    public Style $statusOpenCellStyle;
    public Style $statusHoldCellStyle;
    public Style $statusSolvedCellStyle;
    public Style $supportRedCellStyle;
    public Style $supportAnsweredCellStyle;
    public Style $statusClosedCellStyle;
    public Style $statusPendingCellStyle;
    public Style $statusReviewingCellStyle;
    public Style $supportAcceptedCellStyle;
    public Style $supportRejectedCellStyle;
    public Style $supportExpertiseCellStyle;
    public Style $statusStandbyCellStyle;
    public Style $separatorCellStyle;
    public Border $defaultBorder;
    public Border $grayBorder;

    /**
     * Create a new job instance.
     */
    public function __construct(public Authenticatable $user, public $start_time = null, public $end_time = null)
    {
        parent::__construct();
        try {
            $this->defaultBorder = new Border(
                new BorderPart(Border::BOTTOM, Color::BLACK, Border::WIDTH_THIN, Border::STYLE_SOLID),
                new BorderPart(Border::LEFT, Color::BLACK, Border::WIDTH_THIN, Border::STYLE_SOLID),
                new BorderPart(Border::RIGHT, Color::BLACK, Border::WIDTH_THIN, Border::STYLE_SOLID),
                new BorderPart(Border::TOP, Color::BLACK, Border::WIDTH_THIN, Border::STYLE_SOLID)
            );
        } catch (InvalidNameException|InvalidStyleException|InvalidWidthException $e) {
        }
        try {
            $this->grayBorder = new Border(
                new BorderPart(Border::BOTTOM, Color::rgb(148, 163, 184), Border::WIDTH_THIN, Border::STYLE_SOLID),
                new BorderPart(Border::LEFT, Color::rgb(148, 163, 184), Border::WIDTH_THIN, Border::STYLE_SOLID),
                new BorderPart(Border::RIGHT, Color::rgb(148, 163, 184), Border::WIDTH_THIN, Border::STYLE_SOLID),
                new BorderPart(Border::TOP, Color::rgb(148, 163, 184), Border::WIDTH_THIN, Border::STYLE_SOLID)
            );
        } catch (InvalidNameException|InvalidStyleException|InvalidWidthException $e) {
        }

        $this->headerCellStyle = (new Style())
            ->setCellVerticalAlignment(CellAlignment::CENTER)
            ->setCellAlignment(CellAlignment::CENTER)
            ->setBackgroundColor('1e293b')
            ->setFontColor('f1f5f9')
            ->setBorder($this->defaultBorder);

        $this->defaultCellStyle = (new Style())
            ->setCellVerticalAlignment(CellAlignment::CENTER)
            ->setCellAlignment(CellAlignment::LEFT)
            ->setBorder($this->defaultBorder);

        $this->identityCellStyle = (new Style())
            ->setCellVerticalAlignment(CellAlignment::CENTER)
            ->setCellAlignment(CellAlignment::CENTER)
            ->setFontBold()
            ->setBorder($this->defaultBorder);

        $this->centeredCellStyle = (new Style())
            ->setCellVerticalAlignment(CellAlignment::CENTER)
            ->setCellAlignment(CellAlignment::CENTER)
            ->setBorder($this->defaultBorder);

        $this->emptyCellStyle = (new Style())
            ->setCellVerticalAlignment(CellAlignment::CENTER)
            ->setCellAlignment(CellAlignment::CENTER)
            ->setBackgroundColor('e2e8f0')
            ->setFontColor('94a3b8')
            ->setBorder($this->defaultBorder);

        $this->statusNewCellStyle = (new Style())
            ->setCellVerticalAlignment(CellAlignment::CENTER)
            ->setCellAlignment(CellAlignment::CENTER)
            ->setBackgroundColor('e9d5ff')
            ->setFontColor('6b21a8')
            ->setFontBold()
            ->setBorder($this->defaultBorder);

        $this->statusOpenCellStyle = (new Style())
            ->setCellVerticalAlignment(CellAlignment::CENTER)
            ->setCellAlignment(CellAlignment::CENTER)
            ->setBackgroundColor('7dd3fc')
            ->setFontColor('0c4a6e')
            ->setFontBold()
            ->setBorder($this->defaultBorder);

        $this->statusHoldCellStyle = (new Style())
            ->setCellVerticalAlignment(CellAlignment::CENTER)
            ->setCellAlignment(CellAlignment::CENTER)
            ->setBackgroundColor('fdba74')
            ->setFontColor('7c2d12')
            ->setFontBold()
            ->setBorder($this->defaultBorder);

        $this->statusSolvedCellStyle = (new Style())
            ->setCellVerticalAlignment(CellAlignment::CENTER)
            ->setCellAlignment(CellAlignment::CENTER)
            ->setBackgroundColor('99f6e4')
            ->setFontColor('115e59')
            ->setFontBold()
            ->setBorder($this->defaultBorder);

        $this->supportRedCellStyle = (new Style())
            ->setCellVerticalAlignment(CellAlignment::CENTER)
            ->setCellAlignment(CellAlignment::CENTER)
            ->setBackgroundColor('06b6d4')
            ->setFontColor('ecfeff')
            ->setFontBold()
            ->setBorder($this->defaultBorder);

        $this->supportAnsweredCellStyle = (new Style())
            ->setCellVerticalAlignment(CellAlignment::CENTER)
            ->setCellAlignment(CellAlignment::CENTER)
            ->setBackgroundColor('06b6d4')
            ->setFontColor('ecfeff')
            ->setBorder($this->defaultBorder);

        $this->statusClosedCellStyle = (new Style())
            ->setCellVerticalAlignment(CellAlignment::CENTER)
            ->setCellAlignment(CellAlignment::CENTER)
            ->setBackgroundColor('94a3b8')
            ->setFontColor('f8fafc')
            ->setFontBold()
            ->setBorder($this->defaultBorder);

        $this->statusPendingCellStyle = (new Style())
            ->setCellVerticalAlignment(CellAlignment::CENTER)
            ->setCellAlignment(CellAlignment::CENTER)
            ->setBackgroundColor('fed7aa')
            ->setFontColor('9a3412')
            ->setFontBold()
            ->setBorder($this->defaultBorder);

        $this->statusReviewingCellStyle = (new Style())
            ->setCellVerticalAlignment(CellAlignment::CENTER)
            ->setCellAlignment(CellAlignment::CENTER)
            ->setBackgroundColor('a5f3fc')
            ->setFontColor('155e75')
            ->setFontBold()
            ->setBorder($this->defaultBorder);

        $this->supportAcceptedCellStyle = (new Style())
            ->setCellVerticalAlignment(CellAlignment::CENTER)
            ->setCellAlignment(CellAlignment::CENTER)
            ->setBackgroundColor('4ade80')
            ->setFontColor('f0fdf4')
            ->setFontBold()
            ->setBorder($this->defaultBorder);

        $this->supportExpertiseCellStyle = (new Style())
            ->setCellVerticalAlignment(CellAlignment::CENTER)
            ->setCellAlignment(CellAlignment::CENTER)
            ->setBackgroundColor('818cf8')
            ->setFontColor('eef2ff')
            ->setFontBold()
            ->setBorder($this->defaultBorder);

        $this->supportRejectedCellStyle = (new Style())
            ->setCellVerticalAlignment(CellAlignment::CENTER)
            ->setCellAlignment(CellAlignment::CENTER)
            ->setBackgroundColor('fb7185')
            ->setFontColor('fff1f2')
            ->setFontBold()
            ->setBorder($this->defaultBorder);

        $this->statusStandbyCellStyle = (new Style())
            ->setCellVerticalAlignment(CellAlignment::CENTER)
            ->setCellAlignment(CellAlignment::CENTER)
            ->setBackgroundColor('fef08a')
            ->setFontColor('854d0e')
            ->setFontBold()
            ->setBorder($this->defaultBorder);

        $this->separatorCellStyle = (new Style())
            ->setCellVerticalAlignment(CellAlignment::CENTER)
            ->setCellAlignment(CellAlignment::CENTER)
            ->setBackgroundColor('cbd5e1')
            ->setFontColor('cbd5e1')
            ->setBorder($this->defaultBorder);
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
                    $options->DEFAULT_COLUMN_WIDTH = 15; // set default width
                    $options->DEFAULT_ROW_HEIGHT = 20; // set default height
                    $options->DEFAULT_CELL_STYLE = (new Style())
                        ->setCellVerticalAlignment(Alignment::VERTICAL_CENTER)
                        ->setCellAlignment(CellAlignment::CENTER)
                        ->setBorder(new Border(
                            new BorderPart(Border::BOTTOM, Color::BLACK, Border::WIDTH_THIN, Border::STYLE_SOLID),
                            new BorderPart(Border::LEFT, Color::BLACK, Border::WIDTH_THIN, Border::STYLE_SOLID),
                            new BorderPart(Border::RIGHT, Color::BLACK, Border::WIDTH_THIN, Border::STYLE_SOLID),
                            new BorderPart(Border::TOP, Color::BLACK, Border::WIDTH_THIN, Border::STYLE_SOLID)
                        ));
                }
            );

            $headerRow = [
                'ID Zendesk', 'Type de demande', 'Coode client', 'Statut', 'Chassis',
                'SKU', 'Type de produit', 'Commentaire client', 'Vente conso', 'Marque',
                'Type de composant', 'Type de défaut', 'Origine du défaut', 'Référence composant', 'Création',
                'Résolution',
            ];

            $writer->addHeader($headerRow);

            $writer->setHeaderStyle($this->headerCellStyle);

            foreach ($tickets as $ticket) {
                $row = (new Row([
                    Cell::fromValue($ticket->id, $this->identityCellStyle),
                    Cell::fromValue(self::getTicketField($ticket, 26799500920978), $this->defaultCellStyle),
                    Cell::fromValue($ticket->contact ? $ticket->contact->code : '-', $this->defaultCellStyle),
                    Cell::fromValue($ticket->status, $this->defaultCellStyle),
                    Cell::fromValue(self::getFormattedSerial(self::getTicketField($ticket, 22607784559250)), $this->defaultCellStyle),

                    Cell::fromValue(self::getItem($ticket), $this->defaultCellStyle),
                    Cell::fromValue(self::getTicketField($ticket, 23839621467666), $this->defaultCellStyle),
                    Cell::fromValue('value', $this->defaultCellStyle),
                    Cell::fromValue(self::getTicketField($ticket, 16604606187794), $this->defaultCellStyle),
                    Cell::fromValue(self::getTicketField($ticket, 25461954818834), $this->defaultCellStyle),


                    Cell::fromValue(self::getTicketField($ticket, 25462537828754), $this->defaultCellStyle),
                    Cell::fromValue(self::getTicketField($ticket, 25462965934354), $this->defaultCellStyle),
                    Cell::fromValue(self::getTicketField($ticket, 25463023390610), $this->defaultCellStyle),
                    Cell::fromValue(self::getTicketField($ticket, 23839797779090), $this->defaultCellStyle),
                    Cell::fromValue(date('Y-m-d H:i:s', $ticket->created_at), $this->defaultCellStyle),

                    Cell::fromValue('', $this->defaultCellStyle),
                ]));
                $writer->addRow($row);
            }
            $writer->close();

            TicketsExported::dispatch($this->user, $this->filename);

        } catch (Exception $exception) {

            Log::error($exception->getMessage());

        } catch (InvalidArgumentException $e) {
        }
    }

    private function getTicketField($ticket, $identifier): string|null
    {
        if ($ticket->fields()->wherePivot('ticketfield_id', $identifier)->exists()) {
            return $ticket->fields()->wherePivot('ticketfield_id', $identifier)->first()->pivot->value;
        }
        return null;
    }

    private function getFormattedSerial($serial): string|null
    {
        if (Str::startsWith($serial, '500')) {
            return Str::substr($serial, 3, 8);
        }
        return $serial;
    }

    private function getItem($ticket): string|null
    {
        $formatted_serial = self::getFormattedSerial(self::getTicketField($ticket, 22607784559250));
        if (
            Str::length($formatted_serial) === 8
        ) {
            return Serial::where('code', $formatted_serial)->exists() ? Serial::where('code', $formatted_serial)->first()->item_itno : '-';
        } else {
            return self::getTicketField($ticket, 23839797779090);
        }
    }
}
