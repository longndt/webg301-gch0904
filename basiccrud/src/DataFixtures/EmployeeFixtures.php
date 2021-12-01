<?php

namespace App\DataFixtures;

use App\Entity\Employee;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class EmployeeFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
          for ($i=1; $i<=10; $i++) {
            $employee = new Employee();
            $employee->setEmployeeName("Employee " . $i);
            //rand(min, max): int
            $employee->setEmployeeAge(rand(25,35)); 
            $employee->setEmployeeSalary(1000.123);
            $employee->setEmployeeMobile("0912345678");
            $employee->setEmployeeAddress("Ha Noi");
            //date format: YYYY-mm-dd (MySQL default)
            $employee->setEmployeeBirthday(\DateTime::createFromFormat('Y-m-d', '1990-05-10'));
            $manager->persist($employee);
        }

        $manager->flush();
    }
}
