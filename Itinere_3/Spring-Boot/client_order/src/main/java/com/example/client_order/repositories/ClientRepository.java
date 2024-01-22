package com.example.client_order.repositories;

import org.springframework.data.jpa.repository.JpaRepository;

import com.example.client_order.models.Client;

public interface ClientRepository extends JpaRepository<Client, Long>{
    
}
