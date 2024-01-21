package com.example.studentbook.repositories;

import org.springframework.data.jpa.repository.JpaRepository;

import com.example.studentbook.models.Book;

public interface BookRepository extends JpaRepository<Book, Long>{

}
