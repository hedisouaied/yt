<?php

namespace App\Exports;

use App\Models\Participation;
use App\Invoice;
use Maatwebsite\Excel\Concerns\FromCollection;

use PhpOffice\PhpSpreadsheet\Worksheet\ColumnDimension;
use Maatwebsite\Excel\Concerns\FromArray;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Color;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

use PhpOffice\PhpSpreadsheet\Style\Fill;


class TousParticipantExport implements FromArray, WithStyles
{
    protected $invoices;

    public function __construct(array $invoices)
    {
        $this->invoices = $invoices;
    }




    public function array(): array
    {
        return $this->invoices;
    }
/*
    public function styles(Worksheet $sheet)
    {
        $sheet->getColumnDimension('A')->setWidth(25);
        $sheet->getColumnDimension('B')->setWidth(15);
        $sheet->getColumnDimension('C')->setWidth(25);

        return [    ];
    }
*/

    public function styles(Worksheet $sheet)
    {
        $highestColumn = $sheet->getHighestColumn();

        // Convert the highest column letter to a column index
        $maxCol = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::columnIndexFromString($highestColumn);

        // Loop through all columns from A to the maximum column index
        for ($col = 1; $col <= $maxCol; $col++) {

            $sheet->getColumnDimensionByColumn($col)->setWidth(45);
            $sheet->getStyle($col)->applyFromArray([
                'font' => [
                    'bold' => true,
                    'color' => [
                        'argb' => Color::COLOR_BLACK,
                    ]
                ],
            ]);

        }



        $sheet->getStyle('A1:I1')->applyFromArray([
            'font' => [
                'bold' => true,
                'color' => [
                    'argb' => Color::COLOR_BLACK,
                ]
            ],
            'fill' => [
                'fillType' => Fill::FILL_GRADIENT_LINEAR,
                'rotation' => 90,
                'startColor' => [
                    'argb' => 'FFA0A0A0',
                ],
                'endColor' => [
                    'argb' => 'FFFFFFFF',
                ],
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                ],
            ],

        ]);




        $sheet->getStyle('A:E')->getAlignment()->setWrapText(true);
    }
}
