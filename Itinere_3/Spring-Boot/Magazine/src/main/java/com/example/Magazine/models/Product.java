package com.example.Magazine.models;

import jakarta.persistence.*;


@Entity
@Table(name="prodotti")

public class Product {
    
    @Id
    @GeneratedValue(strategy = GenerationType.IDENTITY)
    private Long id;

    String nome_prodotto;
    Integer giacenza;
    Double prezzo;

    public Product(String nome_prodotto, Integer giacenza, Double prezzo) {
        this.nome_prodotto = nome_prodotto;
        this.giacenza = giacenza;
        this.prezzo = prezzo;
    }

    public Product(){}

    public Long getId() {
        return id;
    }

    public void setId(Long id) {
        this.id = id;
    }

    public String getNome_prodotto() {
        return nome_prodotto;
    }

    public void setNome_prodotto(String nome_prodotto) {
        this.nome_prodotto = nome_prodotto;
    }

    public Integer getGiacenza() {
        return giacenza;
    }

    public void setGiacenza(Integer giacenza) {
        this.giacenza = giacenza;
    }

    public Double getPrezzo() {
        return prezzo;
    }

    public void setPrezzo(Double prezzo) {
        this.prezzo = prezzo;
    }
}
