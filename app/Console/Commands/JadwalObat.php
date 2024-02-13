<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use DateTime;
use DateTimeZone;
use App\Models\Pasien;
use App\Models\Obat;
use App\Models\sendwa;
use App\Models\Schedule;
use App\Models\ScheduleDetail;
use Illuminate\Support\Facades\DB;
use App\Traits\WablasTrait;
class JadwalObat extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:obatpasien';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $timezone = new DateTimeZone('Asia/Jakarta');
        $datetime = new DateTime('now', $timezone);
        $timenow = $datetime->format('H:i:00');
        $datenow = $datetime->format('Y-m-d H:i:00');
        $datadbe = DB::select("
        SELECT abc.* from (SELECT a.id,m_pasien.name as namapasien,a.transactionnumber,a.stardate,a.enddate,a.datepagi AS jam,
        obat.id AS id_obat,obat.name AS namaobat,a.Qty_hari as qty,users.email,a.aturanpakai,m_pasien.phone as nomortelepon FROM t_schedule_detail a
        LEFT JOIN t_schedule AS b ON a.transactionnumber  =b.transactionnumber
        LEFT JOIN m_obat AS obat ON a.id_obat  =obat.id
        LEFT JOIN m_pasien on b.id_pasien=m_pasien.id
        left JOIN users on users.code_pasien = m_pasien.code
        UNION ALL
        
        SELECT  a.id,m_pasien.name as namapasien, a.transactionnumber,a.stardate,a.enddate,a.datesiang AS jam,obat.id AS id_obat,obat.name AS namaobat,a.Qty_hari as qty,users.email,a.aturanpakai,m_pasien.phone as nomortelepon FROM t_schedule_detail a
        LEFT JOIN t_schedule AS b ON a.transactionnumber  =b.transactionnumber
        LEFT JOIN m_obat AS obat ON a.id_obat  =obat.id
        LEFT JOIN m_pasien on b.id_pasien=m_pasien.id
        left JOIN users on users.code_pasien = m_pasien.code
        UNION ALL
        
        SELECT  a.id,m_pasien.name as namapasien,a.transactionnumber,a.stardate,a.enddate,a.datemalam AS jam,obat.id AS id_obat,obat.name AS namaobat,a.Qty_hari as qty,users.email,a.aturanpakai,m_pasien.phone as nomortelepon FROM t_schedule_detail a
        LEFT JOIN t_schedule AS b ON a.transactionnumber  =b.transactionnumber
        LEFT JOIN m_obat AS obat ON a.id_obat  =obat.id
        LEFT JOIN m_pasien on b.id_pasien=m_pasien.id
        left JOIN users on users.code_pasien = m_pasien.code
        )
        abc 
        where cast(now() as date) BETWEEN stardate and enddate and concat(transactionnumber,'-',DATE_FORMAT(now(),'%Y-%m-%d %H:%i'),':00','-',id_obat) not in (select description from t_hisschedule)
        GROUP by  id,namapasien ,transactionnumber,stardate,enddate,jam,
        id_obat ,namaobat ,qty,email,aturanpakai,nomortelepon
        ");
        //dd($datadbe);
        // $limit = $datadbe->count();
     
        $kumpulan_data = [];
        $tanggalSekarang = $datetime->format('Y-m-d H:i');
        $hitung = 0;
        
        
        foreach ($datadbe as  $value) 
        {
                    // $jam = ($value->datepagi != "00:00") ? $value->datepagi : (($value->datesiang != "") ? $value->datesiang : (($value->datemalam != "") ? $value->datemalam : ""));
                     //dd($timenow);
                    // dd($value->datesiang);
                    if($timenow == $value->jam)
                    {
                        
                        $pesan = 'Kepada "'.$value->namapasien.'", pemberitahuan meminum obat "' . $value->namaobat . '" pada hari ini, Tanggal "'.$tanggalSekarang.'" , untuk aturan pakainya sebagai berikut: "' . $value->aturanpakai . '" silahkan upload bukti minum obat dengan link d bawah ini 
                        https://pengingatobat.com/public ,silahkan login dengan username :  "'.$value->email.'" dan password 123';
                        $data['phone'] = $value->nomortelepon;
                        $data['message'] = $pesan;
                        array_push($kumpulan_data, $data);
                        
                        WablasTrait::sendText($kumpulan_data);
                        $pesan2 = $value->transactionnumber . '-' . $datenow  . '-' . $value->id_obat ;
                        sendwa::create([
                            'description' => $pesan2,
        
                        ]);

                    }
        }
    }
}
