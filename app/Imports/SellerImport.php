<?php

namespace App\Imports;

use App\Models\Seller;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;

class SellerImport implements ToModel, WithBatchInserts, WithChunkReading
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Seller([
            'seller_id' => $row[11],
            'shop_name' => $row[12],
            'wean_wang_name' => $row[10]
        ]);
    }

    // 批量导入1000条
    public function batchSize(): int
    {
        return 1000;
    }

    // 以1000条数据基准切割数据
    public function chunkSize(): int
    {
        return 1000;
    }
}
