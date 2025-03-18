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
$activeWorksheet->mergeCells('A1:I1');
$activeWorksheet->mergeCells('A3:B3');
$activeWorksheet->mergeCells('C3:E3');

// Mengatur teks judul (bold, rata tengah, warna latar belakang)
$styleArrayJudul = [
    'font' => ['bold' => true, 'size' => 14],
    'alignment' => ['horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER],
    'fill' => [
        'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
        'startColor' => ['rgb' => 'FFFF99'] // Warna kuning untuk judul
    ]
];
$activeWorksheet->setCellValue('A1', 'REKAP PRESENSI HARIAN');
$activeWorksheet->getStyle('A1:H1')->applyFromArray($styleArrayJudul);

// Mengatur teks header tabel (bold, rata tengah, warna latar belakang)
$styleArrayHeader = [
    'font' => ['bold' => true],
    'alignment' => ['horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER],
    'fill' => [
        'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
        'startColor' => ['rgb' => 'CCCCCC'] // Warna abu-abu untuk header tabel
    ],
    'borders' => [
        'allBorders' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN]
    ]
];

// Mengatur header tabel
$activeWorksheet->setCellValue('A3', 'TANGGAL');
$activeWorksheet->setCellValue('C3', $filter_tanggal);
$activeWorksheet->setCellValue('A4', 'NO');
$activeWorksheet->setCellValue('B4', 'NIP');
$activeWorksheet->setCellValue('C4', 'NAMA PEGAWAI');
$activeWorksheet->setCellValue('D4', 'TANGGAL MASUK');
$activeWorksheet->setCellValue('E4', 'JAM MASUK');
$activeWorksheet->setCellValue('F4', 'TANGGAL KELUAR');
$activeWorksheet->setCellValue('G4', 'JAM KELUAR');
$activeWorksheet->setCellValue('H4', 'TOTAL JAM KERJA');
$activeWorksheet->setCellValue('I4', 'TOTAL TERLAMBAT');
$activeWorksheet->getStyle('A4:I4')->applyFromArray($styleArrayHeader);

$rows = 5;
$no = 1;
foreach ($rekap_harian as $rekap) {
    // Menghitung durasi jam kerja
    $timestampmasuk_jam_masuk = strtotime($rekap['tanggal_masuk'] . ' ' . $rekap['jam_masuk']);
    $timestampmasuk_jam_keluar = strtotime($rekap['tanggal_keluar'] . ' ' . $rekap['jam_keluar']);
    $selisih = $timestampmasuk_jam_keluar - $timestampmasuk_jam_masuk;
    $jam = floor($selisih / 3600);
    $menit = floor(($selisih % 3600) / 60);

    // Menghitung keterlambatan
    $jam_masuk_real = strtotime($rekap['jam_masuk']);
    $jam_masuk_kantor = strtotime($rekap['jam_masuk_kantor']);
    $selisih_terlambat = max(0, $jam_masuk_real - $jam_masuk_kantor);
    $jam_terlambat = floor($selisih_terlambat / 3600);
    $menit_terlambat = floor(($selisih_terlambat % 3600) / 60);

    $activeWorksheet->setCellValue('A' . $rows, $no++);
    $activeWorksheet->setCellValue('B' . $rows, $rekap['nip']);
    $activeWorksheet->setCellValue('C' . $rows, $rekap['nama']);
    $activeWorksheet->setCellValue('D' . $rows, $rekap['tanggal_masuk']);
    $activeWorksheet->setCellValue('E' . $rows, $rekap['jam_masuk']);
    $activeWorksheet->setCellValue('F' . $rows, $rekap['tanggal_keluar']);
    $activeWorksheet->setCellValue('G' . $rows, $rekap['jam_keluar']);
    $activeWorksheet->setCellValue('H' . $rows, $jam . ' jam ' . $menit . ' menit');
    $activeWorksheet->setCellValue('I' . $rows, $jam_terlambat . ' jam ' . $menit_terlambat . ' menit');

    // Menambahkan border ke setiap baris
    $activeWorksheet->getStyle('A' . $rows . ':I' . $rows)->applyFromArray([
        'borders' => [
            'allBorders' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN]
        ]
    ]);
    $rows++;
}

// Mengatur ukuran kolom agar otomatis menyesuaikan
foreach (range('A', 'I') as $columnID) {
    $activeWorksheet->getColumnDimension($columnID)->setAutoSize(true);
}

// Redirect output ke browser
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="rekap_presensi_harian.xlsx"');
header('Cache-Control: max-age=0');

$writer = new Xlsx($spreadsheet);
$writer->save('php://output');
exit();

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

    public function rekap_bulanan()
{
    $presensi_model = new PresensiModel();
    $filter_bulan = $this->request->getVar('filter_bulan');
    $filter_tahun = $this->request->getVar('filter_tahun');

    if ($filter_bulan) {
        if (isset($_GET['excel'])) {
            $rekap_bulanan = $presensi_model->rekap_bulanan_filter($filter_bulan, $filter_tahun);
            
            $spreadsheet = new Spreadsheet();
            $activeWorksheet = $spreadsheet->getActiveSheet();

            // Menggabungkan sel untuk judul
            $activeWorksheet->mergeCells('A1:I1');
            $activeWorksheet->mergeCells('A3:B3');
            $activeWorksheet->mergeCells('C3:E3');

            // Mengatur teks judul
            $styleArrayJudul = [
                'font' => ['bold' => true, 'size' => 14],
                'alignment' => ['horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER],
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'startColor' => ['rgb' => 'FFFF99']
                ]
            ];
            
            $activeWorksheet->setCellValue('A1', 'REKAP PRESENSI BULANAN');
            $activeWorksheet->getStyle('A1:I1')->applyFromArray($styleArrayJudul);

            // Mengatur teks header tabel
            $styleArrayHeader = [
                'font' => ['bold' => true],
                'alignment' => ['horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER],
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'startColor' => ['rgb' => 'CCCCCC']
                ],
                'borders' => [
                    'allBorders' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN]
                ]
            ];

            // Mengatur header tabel
            $activeWorksheet->setCellValue('A3', 'BULAN');
            $activeWorksheet->setCellValue('C3',date('F Y', strtotime($filter_tahun . '-' . $filter_bulan)));
            $activeWorksheet->setCellValue('A4', 'NO');
            $activeWorksheet->setCellValue('B4', 'NIP');
            $activeWorksheet->setCellValue('C4', 'NAMA PEGAWAI');
            $activeWorksheet->setCellValue('D4', 'TANGGAL MASUK');
            $activeWorksheet->setCellValue('E4', 'JAM MASUK');
            $activeWorksheet->setCellValue('F4', 'TANGGAL KELUAR');
            $activeWorksheet->setCellValue('G4', 'JAM KELUAR');
            $activeWorksheet->setCellValue('H4', 'TOTAL JAM KERJA');
            $activeWorksheet->setCellValue('I4', 'TOTAL TERLAMBAT');
            $activeWorksheet->getStyle('A4:I4')->applyFromArray($styleArrayHeader);

            $rows = 5;
            $no = 1;
            foreach ($rekap_bulanan as $rekap) {
                $timestampmasuk_jam_masuk = strtotime($rekap['tanggal_masuk'] . ' ' . $rekap['jam_masuk']);
                $timestampmasuk_jam_keluar = strtotime($rekap['tanggal_keluar'] . ' ' . $rekap['jam_keluar']);
                $selisih = $timestampmasuk_jam_keluar - $timestampmasuk_jam_masuk;
                $jam = floor($selisih / 3600);
                $menit = floor(($selisih % 3600) / 60);

                $jam_masuk_real = strtotime($rekap['jam_masuk']);
                $jam_masuk_kantor = strtotime($rekap['jam_masuk_kantor']);
                $selisih_terlambat = max(0, $jam_masuk_real - $jam_masuk_kantor);
                $jam_terlambat = floor($selisih_terlambat / 3600);
                $menit_terlambat = floor(($selisih_terlambat % 3600) / 60);

                $activeWorksheet->setCellValue('A' . $rows, $no++);
                $activeWorksheet->setCellValue('B' . $rows, $rekap['nip']);
                $activeWorksheet->setCellValue('C' . $rows, $rekap['nama']);
                $activeWorksheet->setCellValue('D' . $rows, $rekap['tanggal_masuk']);
                $activeWorksheet->setCellValue('E' . $rows, $rekap['jam_masuk']);
                $activeWorksheet->setCellValue('F' . $rows, $rekap['tanggal_keluar']);
                $activeWorksheet->setCellValue('G' . $rows, $rekap['jam_keluar']);
                $activeWorksheet->setCellValue('H' . $rows, $jam . ' jam ' . $menit . ' menit');
                $activeWorksheet->setCellValue('I' . $rows, $jam_terlambat . ' jam ' . $menit_terlambat . ' menit');
                
                $activeWorksheet->getStyle('A' . $rows . ':I' . $rows)->applyFromArray([
                    'borders' => [
                        'allBorders' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN]
                    ]
                ]);
                $rows++;
            }

            // Mengatur ukuran kolom
            foreach (range('A', 'I') as $columnID) {
                $activeWorksheet->getColumnDimension($columnID)->setAutoSize(true);
            }

            // Redirect output ke browser
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment;filename="rekap_presensi_bulanan.xlsx"');
            header('Cache-Control: max-age=0');
            
            $writer = new Xlsx($spreadsheet);
            $writer->save('php://output');
            exit();
        }
        $rekap_bulanan = $presensi_model->rekap_bulanan_filter($filter_bulan, $filter_tahun);
    } else {
        $rekap_bulanan = $presensi_model->rekap_bulanan();
    }
    
    $data = [
        'title' => 'Rekap Bulanan',
        'bulan' => $filter_bulan,
        'tahun' => $filter_tahun,
        'rekap_bulanan' => $rekap_bulanan
    ];

    return view('admin/rekap_presensi/rekap_bulanan', $data);
}

}
