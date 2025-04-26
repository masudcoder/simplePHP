<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class GeneralData extends Model
{
    public function getBidinfo($id)
    {
        $result = DB::table('bids')->where('id', $id)->first();
        if (!empty($result->id)) {
            $result->ref_id = str_pad($result->id, 6, '0', STR_PAD_LEFT);
        }
        return $result;
    }

    public function getNextRefID()
    {
        $max_id = DB::table('bids')->orderBy('id', 'DESC')->first()->id;
        return str_pad(++$max_id, 6, '0', STR_PAD_LEFT);
    }
}
