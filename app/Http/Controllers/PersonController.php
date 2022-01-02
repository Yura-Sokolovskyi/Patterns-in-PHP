<?php

namespace App\Http\Controllers;

use App\Models\Person;
use App\Repositories\PersonRepositoryFactory;
use App\Repositories\PersonRepositoryInterface;
use Illuminate\Http\Request;
use InvalidArgumentException;

class PersonController extends Controller
{
    public function getAll(Request $request): array
    {
       return $this->getStorage($request)->readPeople();
    }

    public function getByName(Request $request, string $name): string
    {
        $person = $this->getStorage($request)->readPerson($name);
        if($person){
            return $person->toJson();
        } else {
            return sprintf('Person with %s name is not exist', $name);
        }
    }

    public function store(Request $request)
    {
        $person = new Person(['name'=>$request->request->get('name')]);

        $this->getStorage($request)->savePerson($person);
    }

    private function getStorage(Request $request): PersonRepositoryInterface
    {
        $storageType = $request->query()['storage'];

        if($storageType) {
            if ($storageType === 'db') {
                return PersonRepositoryFactory::createUserDatabaseRepository();
            } elseif ($storageType === 'fs') {
                return PersonRepositoryFactory::createPersonFileSystemRepository();
            }
        }

        throw new InvalidArgumentException('Wrong storage type or storage type is not set');
    }
}
