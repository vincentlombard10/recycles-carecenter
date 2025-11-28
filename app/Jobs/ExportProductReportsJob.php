<?php

namespace App\Jobs;

use App\Events\ProductReportsExported;
use App\Models\ProductReport;
use App\Models\ReplacementItem;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
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
use Exception;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use Spatie\SimpleExcel\SimpleExcelWriter;

class ExportProductReportsJob extends BaseExportJob implements ShouldQueue
{
    use Dispatchable,
        InteractsWithQueue,
        Queueable,
        SerializesModels;

    public int $timeout = 600;
    public Style $headerCellStyle;
    public Style $defaultCellStyle;
    public Style $emptyCellStyle;
    public Style $separatorCellStyle;
    public Border $defaultBorder;
    public Border $grayBorder;

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
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        ini_set('max_execution_time', 3600);
        ini_set('memory_limit', -1);

        try {

            $this->filename = sprintf('Rapports_%s.xlsx', \Carbon\Carbon::now()->format('YmdHis'));
            $start_time = $this->start_time ?? now()->subDays(30)->startOfDay()->toDateTimeString();
            $end_time = $this->end_time ?? now()->endOfDay()->toDateTimeString();

            $reports = ProductReport::query()->where(function ($query) use ($start_time, $end_time) {
                $query->whereDate('created_at', '>=', $start_time);
                $query->whereDate('created_at', '<=', $end_time);
            })->orderBy('updated_at', 'desc')->get();

/*            $replacementItems = ReplacementItem::query()->where(function ($query) use ($start_time, $end_time) {
                $query->whereHas('report', function ($query) use ($start_time, $end_time) {
                    $query->whereDate('created_at', '>=', $start_time);
                    $query->whereDate('created_at', '<=', $end_time);
                });
            })->get();*/

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

            $writer->addHeader([
                'Identifiant',
                'Statut',

                'Cle_Batterie',
                'Cle_Antivol',
                'Chargeur',
                'Batterie',
                'Pedales',

                'Roue_Avant',
                'Roue_Arriere',
                'Selle',
                'Tige_Selle',
                'Display',

                'Moteur',
                'Commentaire_Presence',
                'Rayures',
                'Corrosion',
                'Terre',

                'Sable',
                'Impacts',
                'Fissures',
                'Casse',
                'Modifications',

                'Commentaire_Etat_Visuel',
                'Km',
                'Ref_Batterie',
                'SN_Batterie',
                'Type_Batterie',

                'V_Nom_Batterie',
                'Ah_Nom_Batterie',
                'Etat_Visuel_Batterie',
                'Fonctionnement',
                'Codes_Erreur',

                'Charge_Batterie',
                'Tension_Bornes',
                'Energie_Batterie',
                'BMS_Cycles',
                'BMS_Cellules',

                'BMS_Capacite',
                'BMS_Temperature',
                'BMS_Reistance',
                'Diagnostic',
                'Composants Remplacés',

                'Commande',
                'Creation',
                'Demarrage',
                'Cloture',
                'Technicien',
            ]);
            //$writer->setHeaderStyle($this->headerCellStyle);
            foreach ($reports as $report) {

                $row = new Row([
                    Cell::fromValue($report->identifier),
                    Cell::fromValue($report->status),

                    Cell::fromValue($report->battery_key),
                    Cell::fromValue($report->lock_key),
                    Cell::fromValue($report->charger),
                    Cell::fromValue($report->battery),
                    Cell::fromValue($report->pedals),

                    Cell::fromValue($report->front_wheel),
                    Cell::fromValue($report->rear_wheel),
                    Cell::fromValue($report->saddle),
                    Cell::fromValue($report->seatpost),
                    Cell::fromValue($report->display),

                    Cell::fromValue($report->motor),
                    Cell::fromValue($report->presence_comment),
                    Cell::fromValue($report->stripes),
                    Cell::fromValue($report->corrosion),
                    Cell::fromValue($report->clay),

                    Cell::fromValue($report->sand),
                    Cell::fromValue($report->impacts),
                    Cell::fromValue($report->cracks),
                    Cell::fromValue($report->breakage),
                    Cell::fromValue($report->modification),

                    Cell::fromValue($report->comment),
                    Cell::fromValue($report->odo),
                    Cell::fromValue($report->battery_reference),
                    Cell::fromValue($report->battery_serial),
                    Cell::fromValue($report->battery_type),

                    Cell::fromValue($report->battery_nominal_voltage),
                    Cell::fromValue($report->battery_nominal_capacity),
                    Cell::fromValue($report->battery_look_states),
                    Cell::fromValue($report->battery_indicator),
                    Cell::fromValue($report->battery_error_codes),

                    Cell::fromValue($report->battery_charge_state),
                    Cell::fromValue($report->battery_charge_voltage),
                    Cell::fromValue($report->battery_energy),
                    Cell::fromValue($report->battery_charge_cycles),
                    Cell::fromValue($report->battery_cells_state),

                    Cell::fromValue($report->battery_usable_capacity),
                    Cell::fromValue($report->battery_temperature),
                    Cell::fromValue($report->battery_internal_resistance),
                    Cell::fromValue($report->diagnostic),
                    Cell::fromValue($report->replacementItems()->count()),

                    Cell::fromValue($report->order),
                    Cell::fromValue(date('d/m/Y H:i:s', strtotime($report->created_at))),
                    Cell::fromValue(date('d/m/Y H:i:s', strtotime($report->updated_at))),
                    Cell::fromValue(date('d/m/Y H:i:s', strtotime($report->closed_at))),
                    Cell::fromValue($report->technicien?->username),

                ]);
                $writer->addRow($row);
/*                if(!$report->is($reports->last())) {
                    $writer->addNewSheetAndMakeItCurrent();
                    $writer->nameCurrentSheet($report->identifier);
                }*/

            }

            $writer->close();

            ProductReportsExported::dispatch($this->user, $this->filename);

        } catch (Exception $exception) {

            Log::error($exception->getMessage());

        }
    }
}
