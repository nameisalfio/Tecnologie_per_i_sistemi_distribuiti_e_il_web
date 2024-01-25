package com.example.department_employee.Repositories;

import org.springframework.data.jpa.repository.JpaRepository;

import com.example.department_employee.models.Employee;

public interface EmployeeRepository extends JpaRepository<Employee, Long>{

    default void increaseSalary(Long id, Integer percentage) {
        Employee e = findById(id).orElse(null);
        e.setSalary(e.getSalary() * (1+percentage/100.0));
        this.save(e);
    }
}
