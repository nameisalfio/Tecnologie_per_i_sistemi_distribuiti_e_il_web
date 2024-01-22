package com.example.client_order.repositories;

import org.springframework.data.jpa.repository.JpaRepository;

import com.example.client_order.models.Order;

public interface OrderRepository extends JpaRepository<Order, Long>{
    
}
