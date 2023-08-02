<?php

namespace Database\Seeders;

use App\Models\Question;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class QuestionSeeder extends Seeder
{
    public function run(): void
    {
        Question::create([
            'title' => 'Produk-produk di Mall UKM Kota Cirebon berkualitas',
            'status' => 1
        ]);

        Question::create([
            'title' => 'Variasi produk yang ditawarkan di Mall UKM Kota Cirebon sangat memuaskan',
            'status' => 1
        ]);

        Question::create([
            'title' => 'Mudah menemukan produk yang dicari',
            'status' => 1
        ]);

        Question::create([
            'title' => 'Suasana dan tata letak Mall UKM Kota Cirebon sangat nyaman',
            'status' => 1
        ]);

        Question::create([
            'title' => 'Mall UKM Kota Cirebon memberikan nilai tambah yang besar bagi komunitas lokal',
            'status' => 1
        ]);

        Question::create([
            'title' => 'Mall UKM Kota Cirebon memberikan dukungan yang signifikan kepada UMKM lokal',
            'status' => 1
        ]);

        Question::create([
            'title' => 'Harga produk di Mall UKM Kota Cirebon sangat terjangkau',
            'status' => 1
        ]);

        Question::create([
            'title' => 'Promosi diadakan Mall UKM Kota Cirebon sangat menarik',
            'status' => 1
        ]);

        Question::create([
            'title' => 'Kebersihan dan keamanan di Mall UKM Kota Cirebon selalu terjaga dengan baik',
            'status' => 1
        ]);

        Question::create([
            'title' => 'Mall UKM Kota Cirebon memberikan kesempatan kepada pengusaha lokal untuk berkembang dan memasarkan produk mereka',
            'status' => 1
        ]);

        Question::create([
            'title' => 'Pelayanan yang diberikan Mall UKM Kota Cirebon selalu ramah dan profesional',
            'status' => 1
        ]);

        Question::create([
            'title' => 'Mall UKM Kota Cirebon memberikan bantuan dan informasi yang jelas tentang produk',
            'status' => 1
        ]);

        Question::create([
            'title' => 'Kemudahan pembayaran dan transaksi',
            'status' => 1
        ]);

        Question::create([
            'title' => 'Tim pelayanan di Mall UKM Kota Cirebon selalu siap membantu dan menjawab pertanyaan dengan baik',
            'status' => 1
        ]);

        Question::create([
            'title' => 'Aksesibilitas ke Mall UKM Kota Cirebon sangat mudah',
            'status' => 1
        ]);

        Question::create([
            'title' => 'Mall UKM Kota Cirebon memenuhi semua harapan konsumen',
            'status' => 1
        ]);
    }
}