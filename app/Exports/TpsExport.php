<?php
namespace App\Exports;

use App\Models\Tps;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;

class TpsExport implements FromCollection, WithHeadings, WithTitle, WithEvents
{
    public function collection()
    {
        return Tps::with('location')->get()->map(function ($tp) {
            return [
                $tp->location->name ?? '-',
                $tp->jumlah_pekerja,
                $tp->luas,
                $tp->jam_operasional ?? '-',
                $tp->kapasitas_tps ?? '-',
                $tp->fasilitas ?? '-',
            ];
        });
    }

    public function headings(): array
    {
        return [
            'Nama TPS',
            'Jumlah Pekerja',
            'Luas TPS (m²)',
            'Jam Operasional',
            'Kapasitas TPS',
            'Fasilitas',
        ];
    }

    public function title(): string
    {
        return 'Daftar TPS';
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                // Tambah judul besar di atas (baris 1)
                $event->sheet->insertNewRowBefore(1, 1);
                $event->sheet->mergeCells('A1:F1');
                $event->sheet->setCellValue('A1', 'DAFTAR TEMPAT PEMILAHAN SAMPAH (TPS)');

                // Style judul utama
                $event->sheet->getStyle('A1')->applyFromArray([
                    'font' => [
                        'bold' => true,
                        'size' => 16,
                    ],
                    'alignment' => [
                        'horizontal' => Alignment::HORIZONTAL_CENTER,
                    ],
                ]);
                $event->sheet->getStyle('A2:F2')->applyFromArray([
                    'font' => ['bold' => true],
                ]);
                foreach (range('A', 'F') as $col) {
                    $event->sheet->getDelegate()->getColumnDimension($col)->setAutoSize(true);
                }
            },
        ];
    }
}
