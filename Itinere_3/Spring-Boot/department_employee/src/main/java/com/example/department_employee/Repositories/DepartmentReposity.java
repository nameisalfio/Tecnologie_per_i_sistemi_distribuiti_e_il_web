package com.example.department_employee.Repositories;

import org.springframework.data.jpa.repository.JpaRepository;

import com.example.department_employee.models.Department;

public interface DepartmentReposity extends JpaRepository<Department, Long>{}
