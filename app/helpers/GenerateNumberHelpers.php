<?php

namespace App\Helpers;

use DateTime;
use App\Models\Pasien;
use App\Models\Obat;
use App\Models\Schedule;

class GenerateNumberHelpers
{


        public static function Pasien(): string
        {

            try {

                $current_date_time = new DateTime();

                $date_sequence = $current_date_time->format("dmy");


                //section generate the sequence of running number of trip sheet

                $lastTransactionId = Pasien::orderBy('id', 'desc')->first();


                if (!$lastTransactionId)
                    // We get here if there is no TripSheet at all
                    // If there is no Trip sheet number set it to 0, which will be 1 at the end.
                    $number = 0;
                else

                    $number = substr($lastTransactionId->code, 4);




                return "P-"  . sprintf('%04d', intval($number) + 1);
            } catch (\Exception $e) {
                dd($e);
            }
        }
        
        public static function Obat(): string
        {

            try {

                $current_date_time = new DateTime();

                $date_sequence = $current_date_time->format("dmy");


                //section generate the sequence of running number of trip sheet

                $lastTransactionId = Obat::orderBy('id', 'desc')->first();


                if (!$lastTransactionId)
                    // We get here if there is no TripSheet at all
                    // If there is no Trip sheet number set it to 0, which will be 1 at the end.
                    $number = 0;
                else

                    $number = substr($lastTransactionId->code, 4);




                return "O-"  . sprintf('%04d', intval($number) + 1);
            } catch (\Exception $e) {
                dd($e);
            }
        }

        public static function Schedule(): string
        {

            try {

                $current_date_time = new DateTime();

                $date_sequence = $current_date_time->format("dmy");


                //section generate the sequence of running number of trip sheet

                $lastTransactionId = Schedule::orderBy('id', 'desc')->first();


                if (!$lastTransactionId)
                    // We get here if there is no TripSheet at all
                    // If there is no Trip sheet number set it to 0, which will be 1 at the end.
                    $number = 0;
                else

                    $number = substr($lastTransactionId->transactionnumber, -4);


                return "T-"  . sprintf('%04d', intval($number) + 1);
            } catch (\Exception $e) {
                dd($e);
            }
        }
   }
