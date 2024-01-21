package com.example.studentbook.repositories;

import org.springframework.data.jpa.repository.JpaRepository;

import com.example.studentbook.models.Student;

public interface StudentRepository extends JpaRepository<Student, Long>{
    
}
