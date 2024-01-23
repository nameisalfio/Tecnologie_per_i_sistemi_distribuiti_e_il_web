package com.example.owner_dog.repositories;

import org.springframework.data.jpa.repository.JpaRepository;

import com.example.owner_dog.models.Dog;

public interface DogRepository extends JpaRepository<Dog, Long>{}
