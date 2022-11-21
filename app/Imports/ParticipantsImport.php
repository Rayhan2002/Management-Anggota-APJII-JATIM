<?php

namespace App\Imports;

use App\Models\{User,Participant};
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ParticipantsImport implements ToCollection, WithHEadingRow
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        foreach ($collection as $row) {
            $user = User::updateOrCreate(
                [
                'email'     => $row['email'],
                ],
                [
                'name'      => $row['name'],
                'password'  => bcrypt($row['password']),
                'level_id'  => 2,
                ]
            );

            $participant = Participant::updateOrCreate(
                [
                'phone'         => $row['phone'],
                'event_id'      => $row['event_id'],
                ],
                [
                'agency'        => $row['agency'],
                'user_id'       => $user->id,
                ]
            );
        }
    }

    public function startRow() : int
    {
        return 2;
    }
}
