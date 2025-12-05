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
            ->setCellAlignment('center')
            ->setCellAlignment('center')
            ->setBackgroundColor('1e293b')
            ->setFontColor('f1f5f9');

        $this->defaultCellStyle = (new Style())
            ->setCellAlignment('center')
            ->setCellAlignment('center')
            ->setBorder(new Border(
                new BorderPart(Border::BOTTOM, '666666', Border::WIDTH_THIN, Border::STYLE_SOLID),
                new BorderPart(Border::LEFT, '666666', Border::WIDTH_THIN, Border::STYLE_SOLID),
                new BorderPart(Border::RIGHT, '666666', Border::WIDTH_THIN, Border::STYLE_SOLID),
                new BorderPart(Border::TOP, '666666', Border::WIDTH_THIN, Border::STYLE_SOLID)
            ));
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        //
    }
}
