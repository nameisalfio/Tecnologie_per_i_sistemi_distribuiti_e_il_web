package com.example.owner_dog.repositories;

import org.springframework.data.jpa.repository.JpaRepository;
import com.example.owner_dog.models.Owner;

public interface OwnerRepository extends JpaRepository<Owner, Long>{}
