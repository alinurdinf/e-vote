<?php

namespace Database\Seeders;

use App\Models\Candidate;
use App\Models\Misi;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CandidateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'name'          => 'Jihan - Michael',
                'no_urut'       => '1',
                'tagline'       => 'Paslon 1',
                'description'   => null,
                'image'         => 'https://via.placeholder.com/150',
                'visi' => 'Mewujudkan HIMABO sebagai himpunan yang jujur dan adil, menampung aspirasi, kreatifitas
                            dan inovatif seluruh mahasiswa ABO, dapat memberikan sumbangsih kepada almamater dan
                            masyarakat serta menjunjung tinggi rasa kekeluargaan sesama mahasiswa ABO.',
                'created_at'    => now(),
            ],
            [
                'name'          => 'Rizky - Josua',
                'no_urut'       => '2',
                'tagline'       => 'Paslon 2',
                'description'   => null,
                'image'         => 'https://via.placeholder.com/150',
                'visi' => 'IMewujudkan HIMABO sebagai rumah bagi rakyat Abo yang saling terintegrasi dengan solidaritas tinggi dengan menerapkan program CINTAKU yang berlandaskan dalam pelayanan terhadap masyarakat ABO.',
                'created_at'    => now(),
            ],
            [
                'name'          => 'Salsabila - Ajeng',
                'no_urut'       => '3',
                'tagline'       => 'Paslon 3',
                'description'   => null,
                'image'         => 'https://via.placeholder.com/150',
                'visi' => 'Menjadikan HIMABO POLITEKNIK STMI sebagai himpunan yang komunikatif, responsif, solidaritas tinggi bagi seluruh mahasiswa/i ABO serta meningkatkan citra Himpunan lebih baik di periode selanjutnya.',
                'created_at'    => now(),
            ]

        ];
        foreach ($data as $item) {
            Candidate::create($item);
        }
        $misi = [
            [
                'candidate_id' => 1,
                'misi' => 'Beriman kepada Tuhan Yang Maha Esa',
            ],
            [
                'candidate_id' => 1,
                'misi' => 'Melaksanakan Tri Dharma Perguruan Tinggi',
            ],
            [
                'candidate_id' => 1,
                'misi' => 'Memfasilitasi ruang inspirasi bagi Mahasiswa ABO dengan menyelenggarakan acara yang dapat menciptakan ide-ide kreatif serta meningkatkan kontribusi Mahasiswa ABO dalam mengembangkan program studi ABO.',
            ],
            [
                'candidate_id' => 1,
                'misi' => 'Mengoptimalkan minat bakat mahasiswa ABO melalui kegiatan kerja atau program kerja HIMABO.',
            ],
            [
                'candidate_id' => 1,
                'misi' => 'Menjadi wadah untuk menggali aspirasi mahasiswa ABO melalui mekanisme forum diskusi dan survey.',
            ],
            [
                'candidate_id' => 1,
                'misi' => 'Menjalin kerjasama dan membangun relasi yang baik dengan berbagai pihak, baik internal maupun eksternal HIMABO.',
            ],
            [
                'candidate_id' => 1,
                'misi' => 'Membangun rasa kekeluargaan dengan mengadakan pertemuan rutin antar pengurus atau antar mahasiswa ABO yang bertujuan untuk memperkuat rasa kekeluargaan sesama pengurus maupun sesama mahasiswa ABO.',
            ],
            [
                'candidate_id' => 2,
                'misi' => 'Ciptakan insan yang terampil',
            ],
            [
                'candidate_id' => 2,
                'misi' => 'Integritas berdasarkan Pancasila dan keagamaan',
            ],
            [
                'candidate_id' => 2,
                'misi' => 'Tanamkan budaya sehat dan saling mendukung dengan menerapkan 3 Kata ajaib yaitu maaf, tolong, dan terimakasih',
            ],
            [
                'candidate_id' => 2,
                'misi' => 'Amanah dalam mengumpulkan juga menyampaikan aspirasi-aspirasi mahasiswa ABO',
            ],
            [
                'candidate_id' => 2,
                'misi' => 'Kerjasama dalam membuat kemajuan Himabo dengan kreatif dan inovatif',
            ],
            [
                'candidate_id' => 2,
                'misi' => 'Utamakan sifat toleransi demi tercapainya solidaritas',
            ],
            [
                'candidate_id' => 3,
                'misi' => 'Menjadikan HIMABO sebagai wadah bagi mahasiswa/i ABO untuk menyalurkan ketrampilan, minat dan bakat.',
            ],
            [
                'candidate_id' => 3,
                'misi' => 'Meningkatkan sistem komunikasi yang baik dalam lingkup internal maupun eksternal.',
            ],
            [
                'candidate_id' => 3,
                'misi' => 'Membangun kebersamaan antara pengurus HIMABO dan mahasiswa/i ABO agar menjadikan prodi yang mempunyai rasa kekeluargaan yang erat tanpa adanya kesenjangan.',
            ],
        ];

        foreach ($misi as $item) {
            Misi::create($item);
        }
    }
}
