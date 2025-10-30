<?php

namespace App\Jobs;

use Dompdf\Css\Stylesheet;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use OpenSpout\Common\Entity\Style\Border;
use OpenSpout\Common\Entity\Style\BorderPart;
use OpenSpout\Common\Entity\Style\CellAlignment;
use OpenSpout\Common\Entity\Style\Color;
use OpenSpout\Common\Entity\Style\Style;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use OpenSpout\Common\Exception\InvalidArgumentException;

class BaseExportJob implements ShouldQueue
{
    use Dispatchable,
        InteractsWithQueue,
        Queueable,
        SerializesModels;

    public string $filename = "export.xlsx";

    public Style $headerCellStyle;
    public Style $defaultCellStyle;
    public Style $emptyCellStyle;
    /**
     * Create a new job instance.
     * @throws InvalidArgumentException
     */
    public function __construct()
    {
        $this->headerCellStyle = (new Style())
            ->setCellAlignment(CellAlignment::CENTER)
            ->setCellAlignment(CellAlignment::CENTER)
            ->setBackgroundColor('1e293b')
            ->setFontColor('f1f5f9');

        $this->defaultCellStyle = (new Style())
            ->setCellAlignment(CellAlignment::CENTER)
            ->setCellAlignment(CellAlignment::LEFT);
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        //
    }
}
