<?php

namespace App\Repositories;

use App\Models\Person;

interface PersonRepositoryInterface
{
    public function savePerson(Person $person);
    public function readPeople(): array;
    public function readPerson(string $name): ?Person;
}
