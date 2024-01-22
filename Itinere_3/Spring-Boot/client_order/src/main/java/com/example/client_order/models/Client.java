package com.example.client_order.models;

import jakarta.persistence.*;
import lombok.*;

@Entity
@Table(name="clients")
@Data
@NoArgsConstructor
public class Client {
    
    @Id
    @GeneratedValue(strategy = GenerationType.IDENTITY)

    Long id;
    String name;
    String lastname;
    Integer age;

    public Client(String name, String lastname, Integer age) {
        this.name = name;
        this.lastname = lastname;
        this.age = age;
    }
}
