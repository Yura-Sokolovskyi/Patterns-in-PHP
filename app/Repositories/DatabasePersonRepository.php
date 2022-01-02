<?php

namespace App\Repositories;

use App\Models\Person;

class DatabasePersonRepository implements PersonRepositoryInterface
{
    public function savePerson(Person $person)
    {
        $person->save();
    }

    public function readPeople(): array
    {
        return Person::all()->toArray();
    }

    public function readPerson(string $name): ?Person
    {
        return Person::query()->firstWhere('name', $name);
    }
}
