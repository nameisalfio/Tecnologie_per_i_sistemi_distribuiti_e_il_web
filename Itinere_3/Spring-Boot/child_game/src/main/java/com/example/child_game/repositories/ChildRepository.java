package com.example.child_game.repositories;

import org.springframework.data.jpa.repository.JpaRepository;

import com.example.child_game.models.Child;

public interface ChildRepository extends JpaRepository<Child, Long>{
    
}
