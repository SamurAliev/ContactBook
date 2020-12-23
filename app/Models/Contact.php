<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Kyslik\ColumnSortable\Sortable;

class Contact extends Model
{
    use HasFactory;
    use Sortable;

    protected $fillable = ['name'];
    public $sortable = ['name'];


    public function numbers()
    {
        return $this->hasMany(Number::class);
    }

    public function emails()
    {
        return $this->hasMany(Email::class);
    }

    function edit(Request $request, Contact $contact)
    {
        $numbers = $request->get('number');
        $numberKeys = array_keys($numbers);

        for ($i = 0; $i < count($numbers); $i++) {
            $contact->numbers()->updateOrCreate(
                ['id' => $numberKeys[$i]],
                ['number' => $numbers[$numberKeys[$i]]]
            );
        }
    }

    static function add($fields)
    {
        $contact = Contact::create($fields->only('name'));

        $numbers = [];
        foreach ($fields['number'] as $number) {

            $numbers[] = new Number([
                'number' => $number
            ]);
        }
        $contact->numbers()->saveMany($numbers);

        $emails = [];
        foreach ($fields['email'] as $email) {
            $emails[] = new Email([
                'email' => $email
            ]);
        }
        $contact->emails()->saveMany($emails);

        return $contact;

    }

    static function checkValues($request)
    {
        $numbers = array_values($request->get('number'));
        $emails = array_values($request->get('email'));

        for ($i = 0; $i < count($numbers) - 1; $i++) {
            for ($j = $i + 1; $j < count($numbers); $j++) {
                if ($numbers[$i] === $numbers[$j]) {
                    return false;
                }
            }
        }
        for ($i = 0; $i < count($emails) - 1; $i++) {
            for ($j = $i + 1; $j < count($emails); $j++) {
                if ($emails[$i] === $emails[$j]) {
                    return false;
                }
            }
        }
        return true;
    }




}
