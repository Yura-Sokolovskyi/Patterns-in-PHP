<?php

namespace App\Repositories;

use App\Models\Person;

class FileSystemPersonRepository implements PersonRepositoryInterface
{
    const FILE_PATH = __DIR__ . '/../../storage/local_file_storage.txt';

    public function savePerson(Person $person)
    {
        file_put_contents(self::FILE_PATH, json_encode($person) . ',', FILE_APPEND);
    }

    public function readPeople(): array
    {
        $people = [];
        $peopleData = [];

        try {
            $peopleData = explode(',', file_get_contents(self::FILE_PATH));
        } finally {
            foreach ($peopleData as $personData){
                $data = json_decode($personData, true);

                if($data){
                    $people[] = new Person(json_decode($personData, true));
                }
            }

            return $people;
        }
    }

    public function readPerson(string $name): ?Person
    {
        $person = null;
        $peopleData = [];

        try {
            $peopleData = explode(',', file_get_contents(self::FILE_PATH));
        } finally {
            foreach ($peopleData as $personData){
                $data = json_decode($personData, true);

                if($data && $data['name'] === $name){
                    $person = new Person(json_decode($personData, true));
                }
            }

            return $person;
        }
    }
}
