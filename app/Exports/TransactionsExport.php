<?php

namespace App\Exports;

use App\Models\Transaction;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class TransactionsExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */

    public function collection()
    {
        $transactions = Transaction::all();
        $formatTransactions = [];
       
        foreach($transactions as $key => $item)
        {
            $formatTransactions[] = [
                'id'         => $item->id,
                'total'      => number_format($item->t_total_money, 0, ',', '.'),
                'name'       => $item->t_name,
                'email'      => $item->t_email,
                'phone'      => $item->t_phone,
                'address'    => $item->t_address,
                'note'       => $item->t_note,
                'status'     => $item->getStatus($item->t_status)['name'],
                'created_at' => $item->created_at
            ];
        }

        return collect($formatTransactions);
    }

    public function headings(): array
    {
        return [
            '#',
            'Total',
            'Name',
            'Email',
            'Phone',
            'Address',
            'Note',
            'Status',
            'Created_at'
        ];
    }
}
