<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Sertifikat Magang - {{ $placement->siswa->name ?? 'Siswa' }}</title>
    <style>
        @page {
            margin: 0;
            size: A4 landscape;
        }

        * {
            box-sizing: border-box;
        }

        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
            font-family: 'Georgia', 'Times New Roman', serif;
            background-color: #faf8f5;
            color: #1e293b;
        }

        /* CONTAINER UTAMA MENERAPKAN FULL HEIGHT */
        .certificate-wrapper {
            padding: 25px;
            height: 100vh;
            width: 100vw;
        }

        .outer-border {
            border: 4px solid #0f172a; /* Navy Gelap */
            padding: 6px;
            height: 100%;
        }

        .inner-border {
            border: 2px solid #b45309; /* Emas Gold */
            padding: 30px 45px;
            height: 100%;
            position: relative;
            background: #fffdf9;
            text-align: center;
        }

        /* DEKORASI ACCENT SUDUT MEWAH */
        .corner-decoration {
            position: absolute;
            width: 40px;
            height: 40px;
            border-color: #b45309;
            border-style: solid;
        }
        .top-left { top: 12px; left: 12px; border-width: 4px 0 0 4px; }
        .top-right { top: 12px; right: 12px; border-width: 4px 4px 0 0; }
        .bottom-left { bottom: 12px; left: 12px; border-width: 0 0 4px 4px; }
        .bottom-right { bottom: 12px; right: 12px; border-width: 0 4px 4px 0; }

        /* HEADER TABLE LAYOUT BARU (PRESISI & SIMETRIS) */
        .header-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 5px;
        }

        .logo-cell {
            width: 110px;
            text-align: center;
            vertical-align: middle;
        }

        .logo-img {
            max-width: 95px;
            max-height: 95px;
            object-fit: contain;
        }

        .logo-placeholder {
            width: 80px;
            height: 80px;
            border: 1px dashed #b45309;
            border-radius: 50%;
            line-height: 80px;
            font-size: 11px;
            color: #b45309;
            margin: 0 auto;
            font-weight: bold;
        }

        .header-text {
            text-align: center;
            vertical-align: middle;
            /* Padding kanan dikompensasi dengan lebar logo agar teks berada tepat di tengah kertas */
            padding-right: 110px; 
        }

        .school-name {
            font-family: 'Helvetica', 'Arial', sans-serif;
            font-size: 19px;
            font-weight: bold;
            color: #0f172a;
            text-transform: uppercase;
            letter-spacing: 2px;
            margin: 0;
        }

        .school-address {
            font-family: 'Helvetica', 'Arial', sans-serif;
            font-size: 10px;
            color: #64748b;
            margin-top: 4px;
            line-height: 1.4;
        }

        .certificate-title {
            font-size: 32px;
            font-weight: bold;
            color: #0f172a;
            text-transform: uppercase;
            letter-spacing: 6px;
            margin: 15px 0 0 0;
        }

        .gold-divider {
            height: 3px;
            background: #b45309;
            margin: 18px auto 25px auto;
            width: 75%;
        }

        /* CONTENT UTAMA */
        .given-to {
            font-family: 'Helvetica', 'Arial', sans-serif;
            font-size: 13px;
            color: #64748b;
            text-transform: uppercase;
            letter-spacing: 3px;
            margin-top: 10px;
        }

        .student-name {
            font-size: 34px;
            font-weight: bold;
            color: #1e3a8a; /* Royal Blue */
            margin: 12px 0 15px 0;
            text-transform: uppercase;
            letter-spacing: 2px;
            border-bottom: 2px solid #cbd5e1;
            display: inline-block;
            padding-bottom: 4px;
        }

        .description {
            font-family: 'Helvetica', 'Arial', sans-serif;
            font-size: 14px;
            line-height: 1.6;
            color: #334155;
            max-width: 85%;
            margin: 10px auto 20px auto;
        }

        .industry-highlight {
            font-weight: bold;
            color: #0f172a;
        }

        .industry-address {
            font-size: 11px;
            color: #64748b;
            font-style: italic;
            display: inline-block;
            margin-top: 4px;
        }

        /* BADGE NILAI & PREDIKAT */
        .badge-container {
            margin: 20px auto 35px auto;
        }

        .score-badge {
            display: inline-block;
            background-color: #fef3c7; /* Soft Gold Tint */
            border: 2px solid #b45309;
            padding: 10px 35px;
            border-radius: 8px;
        }

        .score-number {
            font-family: 'Helvetica', 'Arial', sans-serif;
            font-size: 26px;
            font-weight: bold;
            color: #92400e;
        }

        .predicate-text {
            font-family: 'Helvetica', 'Arial', sans-serif;
            font-size: 12px;
            font-weight: bold;
            color: #1e3a8a;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-top: 4px;
        }

        /* TANDA TANGAN FOOTER */
        .footer-table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
        }

        .signature-cell {
            text-align: center;
            vertical-align: bottom;
            width: 50%;
        }

        .signature-title {
            font-family: 'Helvetica', 'Arial', sans-serif;
            font-size: 12px;
            color: #64748b;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            margin-bottom: 65px;
        }

        .signature-name {
            font-family: 'Helvetica', 'Arial', sans-serif;
            font-size: 14px;
            font-weight: bold;
            color: #0f172a;
            border-top: 1px solid #94a3b8;
            padding-top: 6px;
            display: inline-block;
            min-width: 220px;
        }
    </style>
</head>
<body>

    <div class="certificate-wrapper">
        <div class="outer-border">
            <div class="inner-border">
                
                {{-- Ornamen Sudut --}}
                <div class="corner-decoration top-left"></div>
                <div class="corner-decoration top-right"></div>
                <div class="corner-decoration bottom-left"></div>
                <div class="corner-decoration bottom-right"></div>

                {{-- Header: Logo Sekolah, Nama Sekolah & Alamat --}}
                <table class="header-table">
                    <tr>
                        {{-- LOGO SEKOLAH (KIRI) --}}
                        <td class="logo-cell">
                            @if(file_exists(public_path('img/logo_smk.png')))
                                <img src="{{ public_path('img/logo_smk.png') }}" class="logo-img" alt="Logo Sekolah">
                            @else
                                <div class="logo-placeholder">LOGO SMK</div>
                            @endif
                        </td>

                        {{-- INFORMASI SEKOLAH & JUDUL SERTIFIKAT (RATA TENGAH PRESISI) --}}
                        <td class="header-text">
                            <div class="school-name">SMK Al Madani Kota Pontianak</div>
                            <div class="school-address">
                                Jalan Sungai Raya Dalam Komp. Mitra Utama III No. 16 B<br>
                                Telepon: 05618110048 | Website: www.smkalmadaniptk.sch.id | Email: smks.almadaniptk@gmail.com
                            </div>
                            <div class="certificate-title">SERTIFIKAT PRAKERIN</div>
                        </td>
                    </tr>
                </table>

                <div class="gold-divider"></div>

                {{-- PENERIMA --}}
                <div class="given-to">Diberikan Kepada Siswa:</div>
                <div class="student-name">{{ $placement->siswa->name ?? Auth::user()->name }}</div>

                {{-- DESKRIPSI & ALAMAT INDUSTRI --}}
                <div class="description">
                    Telah melaksanakan dan menyelesaikan Praktik Kerja Industri (Prakerin) di 
                    <span class="industry-highlight">{{ $placement->instansi->nama_perusahaan ?? 'Instansi / Perusahaan' }}</span><br>
                    <span class="industry-address">Alamat: {{ $placement->instansi->alamat ?? 'Jl. Perusahaan No. 1, Kawasan Industri' }}</span><br>
                    dengan capaian hasil penilaian akumulatif sebagai berikut:
                </div>

                {{-- KALKULASI PREDIKAT --}}
                @php
                    $score = $placement->nilai_akhir_total ?? 0;
                    $predikat = 'CUKUP (C)';
                    if ($score >= 90) $predikat = 'SANGAT BAIK (A)';
                    elseif ($score >= 80) $predikat = 'BAIK (B)';
                    elseif ($score >= 70) $predikat = 'CUKUP (C)';
                    else $predikat = 'KURANG (D)';
                @endphp

                {{-- BADGE NILAI --}}
                <div class="badge-container">
                    <div class="score-badge">
                        <div class="score-number">{{ number_format((float)$score, 2, '.', '') }}</div>
                        <div class="predicate-text">PREDIKAT: {{ $predikat }}</div>
                    </div>
                </div>

                {{-- TANDA TANGAN FOOTER --}}
                <table class="footer-table">
                    <tr>
                        <td class="signature-cell">
                            <div class="signature-title">Pembimbing Sekolah</div>
                            <div class="signature-name">{{ $placement->guru->name ?? 'Pembimbing Sekolah' }}</div>
                        </td>
                        <td class="signature-cell">
                            <div class="signature-title">Pembimbing Industri</div>
                            <div class="signature-name">{{ $placement->mentor->name ?? 'Pembimbing Industri' }}</div>
                        </td>
                    </tr>
                </table>

            </div>
        </div>
    </div>

</body>
</html>