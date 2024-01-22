package com.example.client_order.models;

import jakarta.persistence.*;
import lombok.*;

@Entity
@Table(name="orders")
@Data
@NoArgsConstructor
public class Order {
    
    @Id
    @GeneratedValue(strategy = GenerationType.IDENTITY)

    Long id;
    String object;

    @ManyToOne
    @JoinColumn(name = "client_id")
    private Client client_id;

    public Order(String object, Client client_id) {
        this.object = object;
        this.client_id = client_id;
    }
}
