<?php

namespace App\Http\Controllers;

use App\Mail\QrCodeEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class QrCodeController extends Controller
{
    public function generateQrCode(){
        // Path ke direktori QR Code
        $qrCodeDirectory = storage_path('app/public/qr-codes');

        // Periksa apakah direktori ada, jika tidak, buatlah
        if (!File::exists($qrCodeDirectory)) {
            File::makeDirectory($qrCodeDirectory, 0755, true);
        }

        // Path file QR Code
        $qrCodePath = $qrCodeDirectory . '/example.png';

        // Buat QR Code dan simpan di path tersebut
        QrCode::format('png')->size(300)->generate('https://www.example.com', $qrCodePath);

        // Mengirim email dengan QR Code terlampir
        Mail::to('adibrafli37@gmail.com')->send(new QrCodeEmail('qr-codes/example.png'));

        return 'QR Code telah dikirim ke email!';
    }
}
