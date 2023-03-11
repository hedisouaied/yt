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



class ListeParticipantExport implements FromArray, WithStyles
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

        $sheet->getColumnDimension('A')->setWidth(45);
        $sheet->getColumnDimension('B')->setWidth(25);
        $sheet->getColumnDimension('C')->setWidth(25);
        $sheet->getColumnDimension('D')->setWidth(25);
        $sheet->getColumnDimension('E')->setWidth(25);
        $sheet->getColumnDimension('F')->setWidth(25);




        $sheet->getStyle('A:F')->applyFromArray([
            'font' => [
                'bold' => true,
                'color' => [
                    'argb' => Color::COLOR_BLACK,
                ]
            ],

        ]);


        $sheet->getStyle('A:E')->applyFromArray([

            'alignment' => [
                'horizontal' => 'center',
            ],

        ]);

        $lastRow = $sheet->getHighestRow(); // get the last row of the worksheet
        $columnF = 'F'.($lastRow-7).':F'.($lastRow);
        $sheet->getStyle($columnF)->applyFromArray([

            'font' => [
                'bold' => true,
                'color' => [
                    'argb' => Color::COLOR_RED,
                ]
            ],

            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                ],
            ],


        ]);



        $sheet->getStyle('A1:A1')->applyFromArray([
            'font' => [
                'bold' => true,
                'color' => [
                    'argb' => Color::COLOR_BLACK,
                ]
            ],
            'alignment' => [
                'horizontal' => 'center',
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                ],
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
        ]);

        $sheet->getStyle('B1:B1')->applyFromArray([
            'font' => [
                'bold' => true,
                'color' => [
                    'argb' => Color::COLOR_BLACK,
                ]
            ],
            'alignment' => [
                'horizontal' => 'center',
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                ],
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
        ]);

        $sheet->getStyle('A3:E3')->applyFromArray([
            'font' => [
                'bold' => true,
                'color' => [
                    'argb' => Color::COLOR_BLACK,
                ]
            ],
            'alignment' => [
                'horizontal' => 'center',
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                ],
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
        ]);

        $sheet->getStyle('A4:E4')->applyFromArray([
            'font' => [
                'bold' => true,
                'color' => [
                    'argb' => Color::COLOR_BLACK,
                ]
            ],
            'alignment' => [
                'horizontal' => 'center',
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                ],
            ],
        ]);

        $sheet->getStyle('A6:D6')->applyFromArray([
            'font' => [
                'bold' => true,
                'color' => [
                    'argb' => Color::COLOR_BLACK,
                ]
            ],
            'alignment' => [
                'horizontal' => 'center',
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
