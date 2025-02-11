<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\PresensiModel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class RekapPresensi extends BaseController
{
    public function rekap_harian()
    {
        $presensi_model = new PresensiModel();
        $filter_tanggal = $this->request->getVar('filter_tanggal');

        if ($filter_tanggal) {
            if (isset($_GET['excel'])) {
                $rekap_harian = $presensi_model->rekap_harian_filter($filter_tanggal);
                $spreadsheet = new Spreadsheet();
                $activeWorksheet = $spreadsheet->getActiveSheet();

                // Menggabungkan sel untuk judul
                $activeWorksheet->mergeCells('A1:H1');
                $activeWorksheet->mergeCells('A3:B3');
                $activeWorksheet->mergeCells('C3:E3');

                // Mengatur gaya judul
                $styleArrayJudul = [
                    'font' => ['bold' => true, 'size' => 14],
                    'alignment' => ['horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER],
                    'fill' => [
                        'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                        'startColor' => ['rgb' => 'FFFF99'] // Warna kuning
                    ]
                ];
                $activeWorksheet->setCellValue('A1', 'REKAP PRESENSI HARIAN');
                $activeWorksheet->getStyle('A1:H1')->applyFromArray($styleArrayJudul);

                // Mengatur gaya header tabel
                $styleArrayHeader = [
                    'font' => ['bold' => true],
                    'alignment' => ['horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER],
                    'fill' => [
                        'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                        'startColor' => ['rgb' => 'CCCCCC'] // Warna abu-abu
                    ],
                    'borders' => [
                        'allBorders' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN]
                    ]
                ];

                // Menetapkan header tabel
                $headers = ['NO', 'NAMA PEGAWAI', 'TANGGAL MASUK', 'JAM MASUK', 'TANGGAL KELUAR', 'JAM KELUAR', 'TOTAL JAM KERJA', 'TOTAL TERLAMBAT'];
                foreach ($headers as $index => $header) {
                    $activeWorksheet->setCellValue(chr(65 + $index) . '4', $header);
                }
                $activeWorksheet->getStyle('A4:H4')->applyFromArray($styleArrayHeader);

                // Mengisi data
                $rows = 5;
                $no = 1;
                foreach ($rekap_harian as $rekap) {
                    $jam_masuk = strtotime($rekap['tanggal_masuk'] . ' ' . $rekap['jam_masuk']);
                    $jam_keluar = strtotime($rekap['tanggal_keluar'] . ' ' . $rekap['jam_keluar']);
                    $selisih = $jam_keluar - $jam_masuk;
                    $jam = floor($selisih / 3600);
                    $menit = floor(($selisih % 3600) / 60);

                    $jam_masuk_real = strtotime($rekap['jam_masuk']);
                    $jam_masuk_kantor = strtotime($rekap['jam_masuk_kantor']);
                    $selisih_terlambat = max(0, $jam_masuk_real - $jam_masuk_kantor);
                    $jam_terlambat = floor($selisih_terlambat / 3600);
                    $menit_terlambat = floor(($selisih_terlambat % 3600) / 60);

                    $dataRow = [
                        $no++,
                        $rekap['nama'],
                        $rekap['tanggal_masuk'],
                        $rekap['jam_masuk'],
                        $rekap['tanggal_keluar'],
                        $rekap['jam_keluar'],
                        "$jam jam $menit menit",
                        "$jam_terlambat jam $menit_terlambat menit"
                    ];

                    foreach ($dataRow as $index => $value) {
                        $activeWorksheet->setCellValue(chr(65 + $index) . $rows, $value);
                    }
                    
                    $activeWorksheet->getStyle('A' . $rows . ':H' . $rows)->applyFromArray([
                        'borders' => [
                            'allBorders' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN]
                        ]
                    ]);
                    $rows++;
                }

                // Mengatur ukuran kolom
                foreach (range('A', 'H') as $columnID) {
                    $activeWorksheet->getColumnDimension($columnID)->setAutoSize(true);
                }

                // Output ke browser
                header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
                header('Content-Disposition: attachment;filename="rekap_presensi_harian.xlsx"');
                header('Cache-Control: max-age=0');

                $writer = new Xlsx($spreadsheet);
                $writer->save('php://output');
                exit;
            }

            $rekap_harian = $presensi_model->rekap_harian_filter($filter_tanggal);
        } else {
            $rekap_harian = $presensi_model->rekap_harian();
        }

        return view('admin/rekap_presensi/rekap_harian', [
            'title' => 'Rekap Harian',
            'tanggal' => $filter_tanggal,
            'rekap_harian' => $rekap_harian
        ]);
    }
}
