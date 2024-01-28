package com.example.child_game.models;

import jakarta.persistence.*;
import lombok.Data;

@Entity
@Table(name="games")
@Data
public class Game {

    @Id
    @GeneratedValue(strategy = GenerationType.IDENTITY)

    Long id;
    String name;
    Double price;

    @ManyToOne(cascade = CascadeType.ALL)
    @JoinColumn(name="child")
    Child child;
}
