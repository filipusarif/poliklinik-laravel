<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class JadwalPraktikSeeder extends Seeder
{
    public function run()
    {
        // Data referensi untuk hari
        $days = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'];

        // Data jadwal yang sudah dibuat untuk memastikan tidak ada yang bertabrakan
        $existingSchedules = [];

        // Buat data dummy untuk 25 jadwal praktik
        for ($i = 1; $i <= 25; $i++) {
            $id_dokter = rand(1, 15); // Asumsikan ada 15 dokter
            $hari = $days[array_rand($days)]; // Pilih hari secara acak
            $jadwal = $this->generateUniqueSchedule($existingSchedules, $id_dokter, $hari);

            // Sebelum menyisipkan jadwal baru, nonaktifkan jadwal aktif sebelumnya untuk dokter yang sama
            $existingActiveSchedule = DB::table('jadwal_praktik')
                ->where('id_dokter', $id_dokter)
                ->where('is_active', 1)
                ->first();

            if ($existingActiveSchedule) {
                // Nonaktifkan jadwal aktif sebelumnya
                DB::table('jadwal_praktik')
                    ->where('id', $existingActiveSchedule->id)
                    ->update(['is_active' => 0]);
            }

            // Sisipkan jadwal baru dengan is_active = 1
            DB::table('jadwal_praktik')->insert([
                'id_dokter' => $id_dokter,
                'hari' => $hari,
                'jam_mulai' => $jadwal['jam_mulai'],
                'jam_selesai' => $jadwal['jam_selesai'],
                'is_active' => 1, // Jadwal aktif
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);

            // Tambahkan jadwal ke array existingSchedules
            $existingSchedules[] = [
                'id_dokter' => $id_dokter,
                'hari' => $hari,
                'jam_mulai' => $jadwal['jam_mulai'],
                'jam_selesai' => $jadwal['jam_selesai'],
            ];
        }
    }

    /**
     * Fungsi untuk menghasilkan jadwal unik yang tidak bertabrakan.
     *
     * @param array $existingSchedules Jadwal yang sudah dibuat
     * @param int $id_dokter ID Dokter
     * @param string $hari Hari
     * @return array Jadwal dengan jam mulai dan selesai
     */
    private function generateUniqueSchedule($existingSchedules, $id_dokter, $hari)
    {
        do {
            $jam_mulai = $this->randomTime();
            $jam_selesai = $this->randomTimeAfter($jam_mulai);
            $isOverlapping = $this->checkOverlap($existingSchedules, $id_dokter, $hari, $jam_mulai, $jam_selesai);
        } while ($isOverlapping);

        return [
            'jam_mulai' => $jam_mulai,
            'jam_selesai' => $jam_selesai,
        ];
    }

    /**
     * Fungsi untuk mengecek apakah jadwal bertabrakan.
     *
     * @param array $existingSchedules Jadwal yang sudah dibuat
     * @param int $id_dokter ID Dokter
     * @param string $hari Hari
     * @param string $jam_mulai Jam Mulai
     * @param string $jam_selesai Jam Selesai
     * @return bool
     */
    private function checkOverlap($existingSchedules, $id_dokter, $hari, $jam_mulai, $jam_selesai)
    {
        foreach ($existingSchedules as $schedule) {
            if ($schedule['id_dokter'] == $id_dokter && $schedule['hari'] == $hari) {
                if (
                    ($jam_mulai >= $schedule['jam_mulai'] && $jam_mulai < $schedule['jam_selesai']) ||
                    ($jam_selesai > $schedule['jam_mulai'] && $jam_selesai <= $schedule['jam_selesai']) ||
                    ($jam_mulai <= $schedule['jam_mulai'] && $jam_selesai >= $schedule['jam_selesai'])
                ) {
                    return true;
                }
            }
        }

        return false;
    }

    /**
     * Fungsi untuk membuat waktu mulai acak dengan kelipatan 10 menit.
     *
     * @return string
     */
    private function randomTime()
    {
        $hour = rand(8, 17); // Jam kerja 08:00 - 17:00
        $minute = rand(0, 5) * 10; // Menit dengan kelipatan 10

        return sprintf('%02d:%02d:00', $hour, $minute);
    }

    /**
     * Fungsi untuk membuat waktu selesai yang lebih besar dari waktu mulai.
     *
     * @param string $jam_mulai Waktu mulai dalam format "HH:MM:SS".
     * @return string
     */
    private function randomTimeAfter($jam_mulai)
    {
        $startHour = (int)substr($jam_mulai, 0, 2); // Ambil jam dari waktu mulai
        $startMinute = (int)substr($jam_mulai, 3, 2); // Ambil menit dari waktu mulai

        // Tetapkan waktu selesai dengan jarak acak 1-3 jam setelah jam_mulai
        $endHour = rand($startHour + 1, $startHour + 3);
        if ($endHour > 20) { // Maksimal jam kerja hingga 20:00
            $endHour = 20;
        }

        // Tetapkan menit selesai dengan kelipatan 10
        $endMinute = rand(0, 5) * 10;

        // Jika menit selesai melebihi 60, tambahkan 1 jam dan kurangi 60 menit
        if ($endMinute >= 60) {
            $endHour += 1;
            $endMinute -= 60;
        }

        return sprintf('%02d:%02d:00', $endHour, $endMinute);
    }
}
