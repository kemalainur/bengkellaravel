<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice #{{ $transaksi->nostruk }} - AHASS</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">
    <style>
        @media print {
            .no-print { display: none !important; }
            body { background: #fff !important; }
            .invoice-container { 
                box-shadow: none !important; 
                border: none !important;
                max-width: 100% !important;
            }
        }
        
        .invoice-container {
            max-width: 800px;
            margin: 2rem auto;
            background: #fff;
            padding: 2rem;
            border-radius: 12px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.3);
            color: #333;
        }
        
        .invoice-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            border-bottom: 3px solid #d4af37;
            padding-bottom: 1.5rem;
            margin-bottom: 1.5rem;
        }
        
        .company-info h2 {
            color: #1a1a2e;
            margin: 0;
            font-size: 1.75rem;
        }
        
        .company-info p {
            color: #666;
            margin: 0.25rem 0;
        }
        
        .invoice-info {
            text-align: right;
        }
        
        .invoice-info h3 {
            color: #d4af37;
            margin: 0 0 0.5rem 0;
            font-size: 1.5rem;
        }
        
        .customer-info {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 1rem;
            margin-bottom: 1.5rem;
            padding: 1rem;
            background: #f8f9fa;
            border-radius: 8px;
        }
        
        .customer-info div {
            padding: 0.5rem;
        }
        
        .customer-info label {
            font-size: 0.875rem;
            color: #666;
            display: block;
        }
        
        .customer-info strong {
            font-size: 1rem;
            color: #333;
        }
        
        .invoice-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 1.5rem;
        }
        
        .invoice-table th {
            background: #1a1a2e;
            color: #d4af37;
            padding: 12px;
            text-align: left;
        }
        
        .invoice-table td {
            padding: 12px;
            border-bottom: 1px solid #eee;
        }
        
        .invoice-table tfoot td {
            background: #f8f9fa;
            font-weight: bold;
        }
        
        .total-row td {
            background: #1a1a2e !important;
            color: #d4af37 !important;
            font-size: 1.25rem;
        }
        
        .terbilang {
            background: #f8f9fa;
            padding: 1rem;
            border-radius: 8px;
            font-style: italic;
            margin-bottom: 1.5rem;
        }
        
        .signatures {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 2rem;
            margin-top: 3rem;
            text-align: center;
        }
        
        .signature-box {
            padding-top: 80px;
            border-top: 1px solid #333;
        }
        
        .status-badge {
            display: inline-block;
            padding: 6px 16px;
            border-radius: 20px;
            font-weight: bold;
            font-size: 0.875rem;
        }
        
        .status-pending { background: #f59e0b; color: #000; }
        .status-proses { background: #3b82f6; color: #fff; }
        .status-selesai { background: #10b981; color: #fff; }

        .action-buttons {
            display: flex;
            gap: 1rem;
            justify-content: center;
            margin-bottom: 2rem;
        }
        
        .btn {
            padding: 12px 24px;
            border-radius: 8px;
            border: none;
            cursor: pointer;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            text-decoration: none;
        }
        
        .btn-print {
            background: #d4af37;
            color: #1a1a2e;
        }
        
        .btn-back {
            background: #6c757d;
            color: #fff;
        }
    </style>
</head>
<body style="background: #1a1a2e; padding: 2rem;">
    <!-- Action Buttons -->
    <div class="action-buttons no-print">
        <a href="{{ route('transaksi.show', $transaksi->nostruk) }}" class="btn btn-back">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
        @if($transaksi->status != 'selesai')
        <form action="{{ route('transaksi.cetak', $transaksi->nostruk) }}" method="POST" style="display: inline;">
            @csrf
            <button type="submit" class="btn btn-print" onclick="setTimeout(() => window.print(), 500)">
                <i class="fas fa-print"></i> Cetak & Selesaikan
            </button>
        </form>
        @else
        <button onclick="window.print()" class="btn btn-print">
            <i class="fas fa-print"></i> Cetak Ulang
        </button>
        @endif
    </div>

    @if(session('success'))
    <div class="no-print" style="max-width: 800px; margin: 0 auto 1rem; padding: 1rem; background: #10b981; color: #fff; border-radius: 8px; text-align: center;">
        <i class="fas fa-check-circle"></i> {{ session('success') }}
    </div>
    @endif

    <div class="invoice-container">
        <!-- Header -->
        <div class="invoice-header">
            <div class="company-info">
                <h2><i class="fas fa-motorcycle" style="color: #d4af37;"></i> AHASS Sinar Abadi Motor</h2>
                <p>Jl. Contoh No. 123, Kota</p>
                <p>Telp: (021) 1234567</p>
            </div>
            <div class="invoice-info">
                <h3>INVOICE</h3>
                <p><strong>No: {{ $transaksi->nostruk }}</strong></p>
                <p>Tanggal: {{ $transaksi->tanggal ? $transaksi->tanggal->format('d/m/Y') : '-' }}</p>
                <span class="status-badge status-{{ $transaksi->status ?? 'pending' }}">
                    {{ ucfirst($transaksi->status ?? 'Pending') }}
                </span>
            </div>
        </div>

        <!-- Customer Info -->
        <div class="customer-info">
            <div>
                <label>Nama Pelanggan</label>
                <strong>{{ $transaksi->motor->pelanggan->nama ?? '-' }}</strong>
            </div>
            <div>
                <label>No Polisi</label>
                <strong>{{ $transaksi->nopolisi }}</strong>
            </div>
            <div>
                <label>Alamat</label>
                <strong>{{ $transaksi->motor->pelanggan->alamat ?? '-' }}</strong>
            </div>
            <div>
                <label>No HP</label>
                <strong>{{ $transaksi->motor->pelanggan->nohp ?? '-' }}</strong>
            </div>
        </div>

        <!-- Items Table -->
        <table class="invoice-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Item/Jasa</th>
                    <th>Jenis</th>
                    <th style="text-align: right;">Harga</th>
                    <th style="text-align: center;">Qty</th>
                    <th style="text-align: right;">Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @forelse($transaksi->details as $index => $d)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $d->item->namaitem ?? '-' }}</td>
                    <td>{{ $d->item->jenis ?? '-' }}</td>
                    <td style="text-align: right;">Rp {{ number_format((float)str_replace('.', '', $d->item->harga ?? 0), 0, ',', '.') }}</td>
                    <td style="text-align: center;">{{ $d->banyaknya }}</td>
                    <td style="text-align: right;">Rp {{ number_format((float)str_replace('.', '', $d->hargatotal), 0, ',', '.') }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" style="text-align: center;">Tidak ada item</td>
                </tr>
                @endforelse
            </tbody>
            <tfoot>
                <tr class="total-row">
                    <td colspan="5" style="text-align: right;">TOTAL</td>
                    <td style="text-align: right;">Rp {{ number_format((float)str_replace('.', '', $transaksi->totalbiaya), 0, ',', '.') }}</td>
                </tr>
            </tfoot>
        </table>

        <!-- Terbilang -->
        @if($transaksi->terbilang)
        <div class="terbilang">
            <strong>Terbilang:</strong> {{ $transaksi->terbilang }}
        </div>
        @endif

        <!-- Signatures -->
        <div class="signatures">
            <div>
                <div class="signature-box">Pelanggan</div>
            </div>
            <div>
                <div class="signature-box">AHASS Sinar Abadi Motor</div>
            </div>
        </div>

        <!-- Footer -->
        <div style="text-align: center; margin-top: 2rem; padding-top: 1rem; border-top: 1px solid #eee; color: #666; font-size: 0.875rem;">
            <p>Terima kasih atas kepercayaan Anda!</p>
            <p>Garansi servis berlaku sesuai ketentuan yang berlaku.</p>
        </div>
    </div>
</body>
</html>
