<?php

namespace App\Repositories;

class PersonRepositoryFactory
{
    public static function createPersonFileSystemRepository(): PersonRepositoryInterface
    {
        return new FileSystemPersonRepository();
    }

    public static function createUserDatabaseRepository(): PersonRepositoryInterface
    {
        return new DatabasePersonRepository();
    }
}
